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
        $currentDate = new \DateTime ();
        $currentDate->setDate(
            intval($currentDate->format('Y')),
            intval($currentDate->format('m')),
            intval($lastDayOfCurrentMonth)
        );

        $paymentSalariesDay = $currentDate->format('D');
        if ($paymentSalariesDay === Date::SATURDAY) {

            return intval($currentDate->format('d')) - 2;
        } else {
            if ($paymentSalariesDay === Date::FRIDAY) {

                return intval($currentDate->format('d')) - 1;
            } else {

                return intval($currentDate->format('d'));
            }
        }
    }

    /**
     * @return int
     */
    public function calculateBonusSalary(): int
    {
        $currentDate = new \DateTime ();

        $currentDate->setDate(
            intval($currentDate->format('Y')),
            intval($currentDate->format('m')),
            15
        );

        $bonusSalariesDay = $currentDate->format('D');
        if ($bonusSalariesDay == Date::SATURDAY) {
            $bonusSalariesDay = intval($currentDate->format('d')) + 6;
        } else {
            if ($bonusSalariesDay == Date::FRIDAY) {
                $bonusSalariesDay = intval($currentDate->format('d')) + 5;
            } else {
                $bonusSalariesDay = intval($currentDate->format('d'));
            }
        }

        return $bonusSalariesDay;
    }

}
