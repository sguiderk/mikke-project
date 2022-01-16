<?php

namespace SalesPayrollApp\Services;

use SalesPayrollApp\Db\FactoryDB;
use SalesPayrollApp\Models\Payslip;

/**
 * The ProcessPayslip
 *
 * @category   Services
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class ProcessPayslip
{

    /**
     * @param FactoryDB $factoryDB
     */
    public function __construct(public FactoryDB $factoryDB)
    {
    }

    /**
     * @param $payload
     * @return array
     */
    public function execute($payload): array
    {
        $payload = explode("','",$payload);
        $payslip = new Payslip();

        $payslip->setGrossSalary($payload[4] * 0.4);
        $payslip->setNetSalary($payload[4]);
        $payslip->setCreatedDate(date("Y/m/d"));
        $payslip->setPayedDate(date("m"));

        $this->factoryDB->insert($payslip, 'payslip');

        return (array) $payslip;
    }

}
