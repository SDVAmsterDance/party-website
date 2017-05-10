#
#   initialize.py
#
#   Python script to populate the database with test data.
#
#   @author Michael van der Werve
#   @copyright 2017
#

from server import db, app, Base, Registration, Person

if __name__ == '__main__':
    # test fixtures for the registrations
    registration_fixtures = [
        {
            'id': 1,
            'email': 'debug@test.com',
            'token': 'test'
        }
    ]

    # test fixtures for the people in the registrations
    person_fixtures = [
        {
            'first_name': 'Bob',
            'last_name': 'Jones',
            'amsterdance': True,
            'vip': False,
            'registration': 1
        },
        {
            'first_name': 'Joe',
            'last_name': 'Quimby',
            'amsterdance': True,
            'vip': False,
            'registration': 1,
            'registered': True
        }
    ]

    # first we drop the old db and then we create the new
    Base.metadata.drop_all(bind=db.engine)
    Base.metadata.create_all(bind=db.engine)

    # load the testing registrations
    for registration in registration_fixtures:
        db.session.add(Registration(**registration))

    # load the person registrations
    for person in person_fixtures:
        db.session.add(Person(**person))

    # commit these fixtures to the database
    db.session.commit()
