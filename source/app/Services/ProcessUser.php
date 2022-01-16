<?php

namespace SalesPayrollApp\Services;

use SalesPayrollApp\Constants\Date;
use SalesPayrollApp\Db\FactoryDB;

/**
 * The ProcessUser
 *
 * @category   Services
 * @author  Samir GUIDERK <samir.guiderk@gmail.com>
 * @copyright  2021 Mikke Project
 * @since      1.0.0
 *
 */
class ProcessUser
{

    /**
     * @param FactoryDB $factoryDB
     */
    public function __construct(public FactoryDB $factoryDB)
    {
    }

    /**
     * @param $payload
     * @return array
     */
    public function execute($payload): array
    {
        $payload = explode("','",$payload);

        $user = $this->factoryDB->find($payload[0], 'user');

        $paymentSalary = $user->salary;
        $bonusSalary = $user->bonus_percentage * $paymentSalary / 100;

        $user->month = date('M');
        $user->bonus_payment_day = $this->calculateBonusSalary();
        $user->salaries_payment_day = $this->calculatePaymentSalary();
        $user->payment_total = $bonusSalary + $paymentSalary;
        $user->bonus_total = $bonusSalary;

        $this->factoryDB->update((array) $user, 'user');

        return json_decode(json_encode($user), true);;
    }

    /**
     * @return int
     */
    public function calculatePaymentSalary(): int
    {
        $lastDayOfCurrentMonth = date('t');
        $dateToday = new \DateTime ();
        $dateToday->setDate(
            intval($dateToday->format('Y')),
            intval($dateToday->format('m')),
            intval($lastDayOfCurrentMonth)
        );
        // We check if the base salaries are paid on the last day of the month unless that day is a
        // Saturday or a Sunday (weekend).
        $paymentSalaryPerDa = $dateToday->format('D');
        if ($paymentSalaryPerDa === Date::SATURDAY) {

            $result = intval($dateToday->format('d')) - 2;
        } else {
            if ($paymentSalaryPerDa === Date::FRIDAY) {

                $result = intval($dateToday->format('d')) - 1;
            } else {

                $result = intval($dateToday->format('d'));
            }
        }

        return $result;
    }

    /**
     * @return float
     */
    public function calculateBonusSalary(): float
    {
        $dateToday = new \DateTime ();

        $dateToday->setDate(
            intval($dateToday->format('Y')),
            intval($dateToday->format('m')),
            15
        );

        $bonusSalary = $dateToday->format('D');
        // We check if the 15th of every month bonuses are paid for the previous month, unless
        // that day is a weekend. In that case, they are paid the first Wednesday after
        // the 15th.
        if ($bonusSalary == Date::SATURDAY) {
            $result = intval($dateToday->format('d')) + 6;
        } else {
            if ($bonusSalary == Date::FRIDAY) {
                $result = intval($dateToday->format('d')) + 5;
            } else {
                $result = intval($dateToday->format('d'));
            }
        }

        return $result;
    }

}
