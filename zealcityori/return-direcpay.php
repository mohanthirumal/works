<?php
ini_set('session.gc_maxlifetime', 30);
require('include/config.php');
ControllerFactory::getController('PaypalReturnController')->run();