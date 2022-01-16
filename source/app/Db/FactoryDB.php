<?php

namespace SalesPayrollApp\Db;

use mysqli;
use SalesPayrollApp\Constants\Config;
use SalesPayrollApp\Constants\Errors;

/**
 * The Db
 *
 * @category   Constants
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class FactoryDB
{
    public $con;
    public $mysqliKey;
    public $mysqliValue;
    public $sql;
    public $id;
    public $table;

    /**
     * FactoryDB constructor.
     */
    public function __construct()
    {
        if (Config::DB_HOST == "" or Config::DB_USER == "" or Config::DB_PASS == "" or Config::DB_NAME == "") {
            die(Errors::DB_DETAIL_ERROR);
        }
        $this->con = new \mysqli(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_NAME);
        if ($this->con->connect_errno > 0) {
            die(Errors::DB_UNABLE_TO_CONNECT.' :'.$this->con->connect_error);
        }
    }

    /**
     * @return false|\mysqli|null
     */
    public function connect()
    {
        return \mysqli_connect(Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_NAME);
    }

    /**
     * @param $conn
     */
    public function deconnect($conn)
    {
        $conn->close();
    }

    /**
     * @param $sql
     * @return bool|\mysqli_result|object|string|null
     */
    public function query($sql)
    {
        $result = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));

        if ($result->num_rows < 1) {
            return Errors::DB_NO_ROW_FOUND;
        }

        return mysqli_fetch_object($result);
    }

    /**
     * @param $sql
     * @return bool|\mysqli_result
     */
    public function delete($sql)
    {
        $result = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));

        return $result;
    }

    /**
     * @param $sql
     * @return bool|\mysqli_result
     */
    public function update($data, $table)
    {
        $con = $this->con;
        $mysqliValue = '';
        $toEnd = count($data);

        foreach ($data as $key => $sqlValue) {
            if (0 === --$toEnd) {
                $mysqliValue .= $key.' = \'' . mysqli_real_escape_string($con, $sqlValue) . '\'';
            } else {
                $mysqliValue .= $key.' = \'' . mysqli_real_escape_string($con, $sqlValue) . '\', ';
            }
        }
        $id = $data['id'];
        $sql = "UPDATE $table SET $mysqliValue WHERE id=$id;";
        $result = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));

        return $result;
    }

    /**
     * @param $arraySql
     * @param $tbl
     */
    public function insert($arraySql, $tbl)
    {
        $con = $this->con;
        $mysqliKey = "";
        $mysqliValue = "";
        foreach ($arraySql as $key => $sql_value) {
            $mysqliValue .= '\'' . mysqli_real_escape_string($con, $sql_value) . '\'';
            $mysqliValue .= ",";
            $mysqliKey .= '' . $key . '';
            $mysqliKey .= ",";
        }
        $mysqliValue = rtrim($mysqliValue, ",");
        $mysqliKey = rtrim($mysqliKey, ",");
        $sql = 'INSERT INTO ' . $tbl . ' (' . $mysqliKey . ') VALUES(' . $mysqliValue . ')';
        $result = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
    }

    /**
     * @param $id
     * @param $table
     * @return bool|\mysqli_result|object|string|null
     */
    public function find($id, $table)
    {
        $sql = "SELECT * FROM $table WHERE id = $id";
        $result = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
        if ($result->num_rows < 1) {
            return Errors::DB_NO_ROW_FOUND;
        }

        return mysqli_fetch_object($result);
    }

    /**
     * @param $table
     * @param $condition
     * @param $select
     * @param null $groupBy
     * @param null $orderBy
     * @param null $limit
     * @return array|bool|\mysqli_result|string|null
     */
    public function findByCondition($table, $condition, $select, $groupBy = null, $orderBy = null, $limit = null)
    {
        $sql = "SELECT $select FROM $table WHERE $condition";
        $sql .= $groupBy ?? '';
        $sql .= $orderBy ?? '';
        $sql .= $limit ?? '';

        $result = mysqli_query($this->con, $sql) or die(mysqli_error($this->con));
        if ($result->num_rows < 1) {
            return Errors::DB_NO_ROW_FOUND;
        }

        return mysqli_fetch_all($result);
    }

    /**
     * @return bool
     */
    public function close()
    {
        return $this->con->close();
    }

    /**
     * @return \mysqli
     */
    public function con()
    {
        return $this->con;
    }
}
