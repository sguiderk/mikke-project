<?php

use SalesPayrollApp\Controllers\Controller;

require dirname(__DIR__).'/app/Controllers/Controller.php';

$controller = new Controller();

$controller->invoke();