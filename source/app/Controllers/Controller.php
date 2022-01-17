<?php

namespace SalesPayrollApp\Controllers;

use SalesPayrollApp\Constants\Errors;
use SalesPayrollApp\Constants\Status;
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

    /**
     * @throws \Exception
     */
    public function invoke()
    {
        $path = __DIR__ . "input/input.csv";
        $fileToRead = fopen($path, "r");

        // Checking whether file is readable or not
        if (is_readable($fileToRead)) {
            $factoryDB = new FactoryDB();
            $processPayslip = new ProcessPayslip($factoryDB);
            $processUser = new ProcessUser($factoryDB);
            $this->processFile = new ProcessFile($processUser, $processPayslip);
            $data = $this->processFile->parseFileCvs($fileToRead);
            $this->processFile->execute($data);

            echo Status::TEXT_SUCCESS;
        } else {
            echo Errors::FILE_NOT_READABLE;
        }
    }

}
