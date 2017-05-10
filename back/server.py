from flask import Flask, send_from_directory, request, send_file, Response, jsonify
from flask_sqlalchemy import SQLAlchemy
from models import Base, Person, Registration
from werkzeug.routing import Rule
import configparser
import os

# create the flask app
app = Flask(__name__)

# shutting up SQLAlchemy
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

# we are going to create a configuration parser, which is nicer
# for real server environments
config = configparser.SafeConfigParser()

# now we read the config file
config.read(os.path.join(app.root_path, 'config.ini'))

# we want a local database
app.config['SQLALCHEMY_DATABASE_URI'] = config.get(
    "server", "database", fallback='sqlite:///' + os.path.abspath(os.path.join(app.root_path, 'db.sqlite')))

# check our ini if we are in debug mode
app.debug = config.getboolean("server", "debug", fallback=True)

# we check that both values are set and there are enough regular tickets
# to support the vips
assert config.getint("server", "tickets", fallback=0), "Zero tickets in config"
assert config.getint("server", "vips", fallback=0) <= config.getint(
    "server", "tickets"), "Not enough tickets for VIPs"

# we create the database
db = SQLAlchemy(app)

# we may be in debug mode, in which case we add a debug endpoint for files!
if app.debug:
    app.url_map.add(Rule('/<path:path>', endpoint='static_debug'))


@app.endpoint('static_debug')
def serve_static_debug(path):
    # this is as UNSAFE AS IT COMES! luckily we have some trust in ourselves, but this should NEVER
    # be enabled in production
    return send_file(os.path.normpath(os.path.join('../www/', path)))


class Status():

    @staticmethod
    def sold():
        return db.session.query(Person).count()

    @staticmethod
    def vips_sold():
        return db.session.query(Person).filter(Person.vip == True).count()

    @staticmethod
    def open():
        return config.getint("server", "tickets") - Status.sold()

    @staticmethod
    def open_vips():
        return min(config.getint("server", "vips", fallback=0) - Status.vips_sold(), Status.open())


@app.route('/status/')
def status():
    """
    View for the current status, which supplies the amount of tickets
    that are still available, along with the amount of VIP tickets
    available.
    """
    # all we really do is use the open_tickets and open_vips function
    return jsonify({
        'tickets': Status.open(),
        'vips': Status.open_vips()
    })


@app.route('/registration/locks/<string:uid>/', methods=['DELETE'])
def unlock(uid):
    return 'not implemented'


@app.route('/registration/locks/', methods=['POST'])
def lock():
    """
    Lock a certain amount of tickets, but we're going to be cautious. There
    may be Dirks trying to exploit this system and locking anybody else out
    of tickets, but we want people on the same network to be able to actually
    register some tickets.

    Therefor, a lock timout of 15 minutes will suffice, with a maximum of 5
    locks per IP and 10 tickets per lock. Yes, in theory this could still lock
    50 tickets from a single IP, but once we reach that point we should just
    block the associated IP or move it down.
    """
    # the uid
    return 'not implemented'


if __name__ == "__main__":
    # run the app
    app.run()
