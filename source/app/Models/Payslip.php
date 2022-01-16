<?php

namespace SalesPayrollApp\Models;
use SalesPayrollApp\Contracts\BaseContract;

/**
 * The Payslip
 *
 * @category   Models
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class Payslip implements BaseContract
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var int
     */
    protected int $grossSalary;

    /**
     * @var int
     */
    protected int $netSalary;

    /**
     * @var int
     */
    protected int $salary;

    /**
     * @var string
     */
    protected string $createdDate;

    /**
     * @var int
     */
    protected int $payedDate;

    /**
     * @var string
     */
    protected string $updatedDate;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getGrossSalary(): int
    {
        return $this->grossSalary;
    }

    /**
     * @param int $grossSalary
     */
    public function setGrossSalary(int $grossSalary): void
    {
        $this->grossSalary = $grossSalary;
    }

    /**
     * @return int
     */
    public function getNetSalary(): int
    {
        return $this->netSalary;
    }

    /**
     * @param int $netSalary
     */
    public function setNetSalary(int $netSalary): void
    {
        $this->netSalary = $netSalary;
    }

    /**
     * @return int
     */
    public function getSalary(): int
    {
        return $this->salary;
    }

    /**
     * @param int $salary
     */
    public function setSalary(int $salary): void
    {
        $this->salary = $salary;
    }

    /**
     * @return int
     */
    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    /**
     * @param int $createdDate
     */
    public function setCreatedDate(string $createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return int
     */
    public function getPayedDate(): int
    {
        return $this->payedDate;
    }

    /**
     * @param int $payedDate
     */
    public function setPayedDate(int $payedDate): void
    {
        $this->payedDate = $payedDate;
    }

    /**
     * @return int
     */
    public function getUpdatedDate(): string
    {
        return $this->updatedDate;
    }

    /**
     * @param int $updatedDate
     */
    public function setUpdatedDate(string $updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }

}
