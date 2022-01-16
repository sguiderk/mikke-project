<?php

namespace SalesPayrollApp\Controllers;

use SalesPayrollApp\Db\FactoryDB;
use SalesPayrollApp\Services\ProcessFile;
use SalesPayrollApp\Services\ProcessPayslip;
use SalesPayrollApp\Services\ProcessUser;

/**
 * The Controllers
 *
 * @category   Controllers
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class Controller
{
    /**
     * Response.
     *
     * @var
     */
    protected ProcessFile $processFile;

    public function invoke()
    {
        $factoryDB = new FactoryDB();
        $processPayslip = new ProcessPayslip($factoryDB);
        $processUser = new ProcessUser($factoryDB);
        $this->processFile = new ProcessFile($processUser, $processPayslip);
    }

}
