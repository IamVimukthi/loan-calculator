<?php

namespace Iamvimukthi\Loancalculator;

use Illuminate\Support\ServiceProvider;

class LoanCalculatorService extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('loan-calculator', function () {
            return new LoanCalculator();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
      
    }
}
