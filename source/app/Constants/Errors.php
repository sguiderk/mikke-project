<?php

namespace SalesPayrollApp\Constants;

/**
 * The centralized error constants
 *
 * @category   Constants
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class Errors
{
    public const DB_DETAIL_ERROR        = 'Please Enter DATABASE details in config.php file';
    public const DB_UNABLE_TO_CONNECT   = 'Unable to connect to database';
    public const DB_NO_ROW_FOUND        = 'No Row Found by This Query';
    public const FILE_NOT_VALID         = 'The file is not valid';
    public const FILE_NUMBER_COLUMN     = 'The number of column should be 8';
}
