<?php

namespace SalesPayrollApp\Contracts;

/**
 * The FileContract
 *
 * @category   Contracts
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
interface FileContract
{
    /**
     * @param $file
     * @return array
     */
    public function parseFileCvs($file): array;

    /**
     * @param $payload
     * @return array
     */
    public function importFile($payload): array;

    /**
     * @param $data
     * @param $nameFile
     * @return void
     */
    public function exportFile(array $data, string $nameFile): void;

}
