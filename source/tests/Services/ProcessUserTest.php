<?php

namespace SalesPayrollAppTest\Services;

use SalesPayrollApp\Db\FactoryDB;
use SalesPayrollApp\Models\User;
use SalesPayrollApp\Services\processPayslip;
use SalesPayrollApp\Services\ProcessUser;
use SalesPayrollAppTest\UnitTest;


/**
 * The processUserTest
 *
 * @category  Services
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class ProcessUserTest extends UnitTest
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
        $this->processUser = new processUser($FactoryDB);
    }

    /**
     * testImportFile
     */
    public function testUSer()
    {
        $user = new User();
        $user->setFirstName('samir');
        $user->setSalary(3000);
        $result = $this->processUser->execute($user);
        $expectedResult = [
            'grossSalary' => 4500,
            'netSalary' => 3000,
            'salary' => 3000,
            'createdDate' => date("Y/m/d")
        ];
        $this->assertEquals($result, $expectedResult);
    }

}
