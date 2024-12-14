<?php

namespace Iamvimukthi\Loancalculator\Facades;

use Illuminate\Support\Facades\Facade;

class LoanCalculatorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'loan-calculator';
    }
}
