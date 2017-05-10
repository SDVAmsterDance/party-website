from sqlalchemy import Column, Integer, String, Boolean, ForeignKey, DateTime
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import relationship

Base = declarative_base()


class Person(Base):
    """
    Class for a person that is registered. The buyer of a ticket is 
    also defined as a person within the ticket.
    """
    __tablename__ = 'people'
    id = Column(Integer, primary_key=True)
    first_name = Column(String(128))
    last_name = Column(String(128))
    amsterdance = Column(Boolean, default=False)
    vip = Column(Boolean, default=False)
    registration = Column(Integer, ForeignKey('registrations.id'))
    registered = Column(Boolean, default=False)

    def __init__(self, **kwargs):
        """
        Initializes a person to add to the shit.
        """
        for kwarg, value in kwargs.items():
            setattr(self, kwarg, value)

    def __repr__(self):
        return '<User %r %r>' % (self.first_name, self.last_name)


# this is for a registration
class Registration(Base):
    """
    Class for a registration.
    """
    __tablename__ = 'registrations'
    id = Column(Integer, primary_key=True)

    # this is simply a backwards accessor for all the people that are
    # associated with this registration
    people = relationship('Person')

    # we just use a non-unique string,
    email = Column(String(256))

    # this is a unique (public) token to manage a registration by
    token = Column(String(32))

    def __init__(self, **kwargs):
        for kwarg, value in kwargs.items():
            setattr(self, kwarg, value)

    def __repr__(self):
        print("%r" % self.people)
        return '<Registration %r>' % self.email


class Action(Base):
    __tablename__ = 'interactions'
    id = Column(Integer, primary_key=True)

    # identifier for the action that was actually performed
    action = Column(Integer)  # this is an integer for the action
