<?php

namespace App\Repositories;

use App\Models\AmortizationSchedule;

class AmortizationScheduleRepository extends MainRepository
{
    public function __construct()
    {
        $this->setModel(new AmortizationSchedule());
    }


    /**
     * @return int
     */
    public function getMonth():int
    {
        return $this->getModel()->month ?? 0;
    }

    /**
     * @return float
     */
    public function getStartingBalance():float
    {
        return $this->getModel()->starting_balance ?? 0;
    }


    /**
     * @return float
     */
    public function getMonthlyPayment():float
    {
        return $this->getModel()->monthly_payment ?? 0;
    }

    /**
     * @return float
     */
    public function getPrincipalComponent():float
    {
        return $this->getModel()->principal_component ?? 0;
    }

    /**
     * @return float
     */
    public function getInterestComponent():float
    {
        return $this->getModel()->interest_component ?? 0;
    }


    /**
     * @return float
     */
    public function getEndingBalance():float
    {
        return $this->getModel()->ending_balance ?? 0;
    }

}
