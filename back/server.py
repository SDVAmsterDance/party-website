from flask import Flask, send_from_directory, request, send_file
from flask_sqlalchemy import SQLAlchemy
import os

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///data.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False  # shut up the warning
db = SQLAlchemy(app)


class Person(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    first_name = db.Column(db.String(128))
    last_name = db.Column(db.String(128))

    def __init__(self, first_name, last_name):
        self.first_name = first_name
        self.last_name = last_name

    def __repr__(self):
        return '<User %r %r>' % (self.first_name, self.last_name)


@app.route('/<path:path>')
def send_static(path):
    print(path)
    # this is as UNSAFE AS IT COMES! luckily we have some trust in ourselves, but this should NEVER
    # be enabled in production
    return send_file(os.path.normpath(os.path.join('front', path)))


@app.route('/0')
def hello_world():
    return 'hello_world!'
