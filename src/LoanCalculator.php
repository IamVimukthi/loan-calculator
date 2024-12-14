<?php

namespace Iamvimukthi\Loancalculator;

use DateTime;

class LoanCalculator
{
    /**
     * Calculate loan details (EMI, Total Cost, Total Interest)
     * 
     * @param float $loanAmount The principal loan amount
     * @param float $annualInterestRate The annual interest rate in percentage
     * @param int $loanTermYears The loan term in years
     * @param int $loanTermMonths The additional loan term in months
     * @return array
     */
    public static function calculateLoanDetails($loanAmount, $annualInterestRate, $loanTermYears, $loanTermMonths = 0)
    {
        $numberOfPayments = ($loanTermYears * 12) + $loanTermMonths;
        $monthlyInterestRate = $annualInterestRate / 12 / 100;

        $presentValueInterestFactor = pow(1 + $monthlyInterestRate, $numberOfPayments);
        $emi = $loanAmount * $monthlyInterestRate * ($presentValueInterestFactor / ($presentValueInterestFactor - 1));

        $totalCost = $emi * $numberOfPayments;
        $totalInterest = $totalCost - $loanAmount;

        return [
            'EMI' => round($emi, 2),
            'TotalCost' => round($totalCost, 2),
            'TotalInterest' => round($totalInterest, 2),
        ];
    }

    /**
     * Generate payment schedule with year-month breakdown
     * 
     * @param float $loanAmount The principal loan amount
     * @param float $annualInterestRate The annual interest rate in percentage
     * @param int $loanTermYears The loan term in years
     * @param int $loanTermMonths The additional loan term in months
     * @return array
     */
    public static function generatePaymentSchedule($loanAmount, $annualInterestRate, $loanTermYears, $loanTermMonths = 0)
    {

        $numberOfPayments = ($loanTermYears * 12) + $loanTermMonths;
        $monthlyInterestRate = $annualInterestRate / 12 / 100;
        $emi = self::calculateLoanDetails($loanAmount, $annualInterestRate, $loanTermYears, $loanTermMonths)['EMI'];

        $remainingPrincipal = $loanAmount;
        $schedule = [];
        $currentDate = new DateTime();

        for ($i = 0; $i < $numberOfPayments; $i++) {
            $interestPayment = $remainingPrincipal * $monthlyInterestRate;
            $principalPayment = $emi - $interestPayment;
            $remainingPrincipal -= $principalPayment;
          
            $schedule[] = [
                'MonthYear' => $currentDate->format('M-Y'),
                'PrincipalPayment' => round($principalPayment, 2),
                'InterestPayment' => round($interestPayment, 2),
                'TotalPayment' => round($emi, 2),
                'Balance' => round(max($remainingPrincipal, 0), 2),
            ];

            $currentDate->modify('+1 month');
        }

        return $schedule;
    }
}
