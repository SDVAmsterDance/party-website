from django.db import models

# Create your models here.


class Person():
    """
    Class representing a single person. This person should
    be associated with a given registration.
    """
    pass
    # fk to registration
    # first name
    # last name
    # amsterdance
    # vip


class Registration():
    pass
    # registrating member
    # email
    # uuid

# getting the current status is as easy as getting the last interaction


class Interaction():
    pass
    # registration
    # status
    # following steps each have a 15 minute grace period, in which tickets are locked down.
    # - 0 created
    # - 1 ready
    # - 2 confirmation mail sent

    # if the confirmation email is sent outside of the grace period, we're still going to _try_
    # but we may inevitably fail
    # - 3 confirmed (from this point forward, the tickets are SET IN STONE)
    # - 4 awaiting payment / payment email sent
    # - 5 payment received
    # - 6 locked_in

    # time = auto_add_now()
