<?php

/**
 *  status.php
 *
 *  This will serve as a simple counter - how many possible normal and VIP tickets are left.
 *
 *  @author Michael van der Werve
 */

require_once 'class.Status.php';

// return the amount of tickets left
echo json_encode(new Status());
