from flask import Flask, send_from_directory, request, send_file, Response, jsonify, render_template
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


# possible prefix
prefix = '/api' if app.debug else ''

# we add our endpoints here
app.url_map.add(
    Rule(prefix + '/registration/', endpoint='registration', methods=['POST']))
app.url_map.add(Rule(prefix + '/status/', endpoint='status'))

# we import everything from the debug as well, if needed
if app.debug:
    from debug import *


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


@app.endpoint('status')
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


@app.endpoint('registration')
def register():
    pass


@app.endpoint('webversion')
def webversion(token):
    pass

if __name__ == "__main__":
    # run the app
    app.run()
