<?php

namespace SalesPayrollApp\Contracts;

/**
 * The baseContract
 *
 * @category   Contracts
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
interface baseContract
{
    /**
     * @return string
     */
    public function getCreatedDate(): string;

    /**
     * @param string $createdDate
     */
    public function setCreatedDate(string $createdDate): void;

    /**
     * @return string
     */
    public function getUpdatedDate(): string;

    /**
     * @param string $updatedDate
     */
    public function setUpdatedDate(string $updatedDate): void;
}
