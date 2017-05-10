from server import app, db
from flask import send_file
from models import Registration
from premailer import Premailer
from werkzeug.routing import Rule

import os
import jinja2

app.url_map.add(Rule('/<path:path>', endpoint='debug_static'))
app.url_map.add(Rule('/email/<path:path>', endpoint='debug_emails'))
app.url_map.add(
    Rule('/email/<path:path>/<string:token>', endpoint='debug_emails'))


@app.endpoint('debug_static')
def serve_static_debug(path):
    # this is as UNSAFE AS IT COMES! luckily we have some trust in ourselves, but this should NEVER
    # be enabled in production
    return send_file(os.path.normpath(os.path.join('../www/', path)))


@app.endpoint('debug_emails')
def serve_debug_emails(path, token=None):
    # this is as UNSAFE AS IT COMES! luckily we have some trust in ourselves, but this should NEVER
    # be enabled in production
    # first we get the registration
    registration = db.session.query(Registration).filter(
        Registration.token == token if token else Registration.id == 1).first()

    # render the email
    email = jinja2.Environment(
        loader=jinja2.FileSystemLoader(
            os.path.join(app.root_path, '../email/'))
    ).get_template(path).render({
        'registration': registration
    })

    # now we do some emogrification if needed (currently the link rel is not
    # taken into account!!!)
    if '.html' in path:
        email = Premailer(email, base_path=os.path.join(
            app.root_path, os.path.normpath("../email/css"))).transform()

    # we're done with the email
    return email
