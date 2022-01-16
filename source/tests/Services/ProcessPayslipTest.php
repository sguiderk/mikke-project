<?php

namespace SalesPayrollAppTest\Services;

use SalesPayrollApp\Db\FactoryDB;
use SalesPayrollApp\Models\User;
use SalesPayrollApp\Services\processPayslip;
use SalesPayrollAppTest\UnitTest;

/**
 * The processPayslipTest
 *
 * @category  Services
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class ProcessPayslipTest extends UnitTest
{
    /**
     * Response.
     *
     * @var
     */
    protected processPayslip $processPayslipTest;

    /**
     * setUp.
     */
    public function setUp()
    {
        $FactoryDB = new FactoryDB();
        $this->processPayslip = new processPayslip($FactoryDB);
    }

    /**
     * testImportFile
     */
    public function testPayslip()
    {
        $user = "1',' samir',' samir@gmail.com','3000-01-16',' 3000',' software engineer',' male',' 88 Zaandam";
        $result = $this->processPayslip->execute($user);

        $expectedResult = [
            "*grossSalary" => 1200,
            "*netSalary" => 3000,
            "*createdDate" => 3000,
            "*payedDate" => date("Y/m/d")
        ];
        $this->assertEquals($result, $expectedResult);
    }

}
