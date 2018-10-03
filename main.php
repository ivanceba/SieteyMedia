<?php

define('CLASSES_ROUTE', 'classes/');

require_once CLASSES_ROUTE . 'Controller.php';

/**
 * Lunes diseño. HECHO
 * Martes implementación base. HECHO
 * @TODO Para el miércoles implementar memoria y dotar a la máquina de inteligencia.
 * Jueves testear.
 * Viernes escribir documentación.
 */

(Controller::getController())->run();
