<?php

namespace SalesPayrollAppTest\Services;

use SalesPayrollApp\Db\FactoryDB;
use SalesPayrollApp\Models\File;
use SalesPayrollApp\Services\ProcessFile;
use SalesPayrollApp\Services\ProcessPayslip;
use SalesPayrollApp\Services\ProcessUser;
use SalesPayrollAppTest\UnitTest;

/**
 * The processFileTest
 *
 * @category  Services
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class ProcessFileTest extends UnitTest
{

    /**
     * Response.
     *
     * @var
     */
    protected ProcessFile $processFile;

    /**
     * setUp.
     */
    public function setUp()
    {
        $factoryDB = new FactoryDB();
        $processPayslip = new ProcessPayslip($factoryDB);
        $processUser = new ProcessUser($factoryDB);
        $this->processFile = new ProcessFile($processUser, $processPayslip);
    }

    /**
     * testImportFile
     */
    public function testImportFile()
    {
        $result = $this->processFile->parseFileCvs(__DIR__ . '/../FileToTest/list_employees_for_test.csv');
        $this->assertEquals($result, true);
    }

    /**
     * testImportFile
     */
    public function testInsertToDb()
    {
        $result = $this->processFile->parseFileCvs(__DIR__ . '/../FileToTest/list_employees_for_test.csv');
        $this->assertEquals($this->processFile->execute($result), true);
    }

    /**
     * testImportFile
     */
    public function testIfFileExists()
    {
        $result = $this->processFile->parseFileCvs(__DIR__ . '/../FileToTest/list_employees_for_test.csv');
        $this->processFile->execute($result);
        $this->assertFileNotExists('employees-file.csv');
        $this->assertFileNotExists('payslip-file.csv');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage the number of column should be 8
     */
    public function testImportFileLessThan6Col()
    {
        $result = $this->processFile->parseFileCvs(
            __DIR__ . '/../FileToTest/list_employees_for_test_less_than_8_col.csv'
        );
        $this->assertEquals($result, true);
    }

    public function testConvertDataToArrayFunction()
    {
        $arrayToTest = array(0 => 1,
            1 => 'samir',
            2 => 'samir@gmail.com',
            3 => 'software engineer',
            4 =>  30,
            5 =>  3000,
            6 => 'male',
            7 => '88 Zaandam');

        $result = $this->processFile->convertDataToArray($arrayToTest);

        $expectedResult = "1','samir','samir@gmail.com','1970-01-01','30','3000','male','88 Zaandam";

        $this->assertEquals($result,$expectedResult);

    }

}
