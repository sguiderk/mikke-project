<?php

namespace SalesPayrollApp\Services;

use phpDocumentor\Parser\Exception;
use SalesPayrollApp\Constants\Errors;
use SalesPayrollApp\Contracts\FileContract;

/**
 * The ProcessFile
 *
 * @category  Services
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class ProcessFile implements FileContract
{

    /**
     * @param processUser $processUser
     * @param processPayslip $processPayslip
     */
    public function __construct(
        public processUser $processUser,
        public processPayslip $processPayslip)
    {
    }

    /**
     * @param $data
     * @return bool
     */
    public function execute($data): bool
    {
        $dataToExportEmployees = [];
        $dataToExportPayslip = [];

        try {

            foreach ($data as $user) {
                $dataToExportEmployees[] = $this->processUser->execute($user);
                $dataToExportPayslip[]   = $this->processPayslip->execute($user);
            }

            $this->exportFile($dataToExportEmployees,'employees');
            $this->exportFile($dataToExportPayslip,'payslip');

            return true;
        }
        catch (Exception $e) {

            echo 'Caught exception: ',  $e->getMessage(), "\n";

            return false;
        }

    }

    /**
     * @param $file
     * @return bool
     */
    public function parseFileCvs($file): array
    {
        if ($file != null) {
            $row = 1;
            $arrayData = array();
            if (($handle = fopen($file, "r")) !== false) {
                while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                    if (count($data) < 7) {
                        throw new \Exception(Errors::FILE_NUMBER_COLUMN);
                    }
                    $row++;
                    if ($row > 2) {
                        $arrayData[$row] = $this->convertDataToArray($data, $row);
                    }
                }
                fclose($handle);
            }

            return $arrayData;
        } else {
            throw new \Exception(Errors::FILE_NOT_VALID);
        }
    }

    /**
     * @param array $data
     * @return string
     */
    public function convertDataToArray(array $data): string
    {
        $num = count($data);
        for ($c = 0; $c < $num; $c++) {
            if ($c == 3) {
                $data[$c] = date('Y-m-d', strtotime(str_replace('/', '-', $data[$c])));
            }
            if ($c == 7) {
                $data[$c] = addslashes($data[$c]);
            }
        }

        return implode("','", $data);
    }


    /**
     * @param $payload
     * @return array
     * @throws \Exception
     */
    public function importFile($payload): array {
        return $this->parseFileCvs($payload);
    }

    /**
     * @param $data
     * @param $nameFile
     * @return void
     */
    public function exportFile(array $data, string $nameFile): void{

        $fp = fopen($nameFile.'-file.csv', 'w');

        foreach ($data as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);
    }
}
