<?php

namespace App\Repositories;

use App\Models\Loan;

class LoanRepository extends MainRepository
{
    public function __construct()
    {
        $this->setModel(new Loan());
    }

    /**
     * @return float
     */
    public function getLoanAmount(): float
    {
        return $this->getModel()->loan_amount ?? 0;
    }


    /**
     * @return float
     */
    public function getInterestRate(): float
    {
        return $this->getModel()->interest_rate ?? 0;
    }

    /**
     * @return float
     */
    public function getLoanTerm(): float
    {
        return $this->getModel()->loan_term ?? 0;
    }


    /**
     * @return void
     */
    public function generateAmortizationSchedule():void
    {
        $loanAmount = $this->getLoanAmount();
        $monthlyInterestRate = ($this->getInterestRate() / 12) / 100;
        $loanTermMonths = $this->getLoanTerm() * 12;

        $monthlyPayment = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$loanTermMonths));

        $currentBalance = $loanAmount;

        for ($month = 1; $month <= $loanTermMonths; $month++) {
            $interestComponent = $currentBalance * $monthlyInterestRate;
            $principalComponent = $monthlyPayment - $interestComponent;
            $endingBalance = $currentBalance - $principalComponent;

            $this->getModel()->amortizationSchedules()->create([
                'month' => $month,
                'starting_balance' => $currentBalance,
                'monthly_payment' => $monthlyPayment,
                'principal_component' => $principalComponent,
                'interest_component' => $interestComponent,
                'ending_balance' => $endingBalance,
            ]);

            $currentBalance = $endingBalance;
        }
    }


    /**
     * @return array
     */
    public function getScheduleList(): array
    {
        $amortizationScheduleRepository = new AmortizationScheduleRepository();
        $schedulePayments = $this->getModel()->amortizationSchedules()->get();
        $data = [];
        foreach ($schedulePayments as $schedulePayment){
            $amortizationScheduleRepository->setModel($schedulePayment);
            $data[] = $amortizationScheduleRepository;
        }
        return $data;
    }

}
