<?php

namespace SalesPayrollApp\Models;
use SalesPayrollApp\Contracts\BaseContract;

/**
 * The File
 *
 * @category   Models
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class File implements BaseContract
{

    /**
     * @var int
     */
    protected int $id;

    /**
     * @var int
     */
    protected string $fileName;

    /**
     * @var string
     */
    protected string $createdDate;

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
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

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

}
