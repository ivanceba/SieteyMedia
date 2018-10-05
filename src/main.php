<?php

define('CLASSES_ROUTE', 'classes/');

require_once CLASSES_ROUTE . 'Controller.php';

(Controller::getController())->run(); // Start game loop.
