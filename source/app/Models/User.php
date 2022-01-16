<?php

namespace SalesPayrollApp\Models;
use SalesPayrollApp\Contracts\BaseContract;


/**
 * The User
 *
 * @category   Models
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class User implements BaseContract
{
    /**
     * @var int
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $firstName;

    /**
     * @var string
     */
    protected string $email;

    /**
     * @var int
     */
    protected int $salary;

    /**
     * @var string
     */
    protected string $createdDate;

    /**
     * @var string
     */
    protected string $updatedDate;

    /**
     * @return string
     */
    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    /**
     * @param string $createdDate
     */
    public function setCreatedDate(string $createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return string
     */
    public function getUpdatedDate(): string
    {
        return $this->updatedDate;
    }

    /**
     * @param string $updatedDate
     */
    public function setUpdatedDate(string $updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }



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
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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

}
