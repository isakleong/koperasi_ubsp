<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();

        Validator::extend('max_one_month_difference', function ($attribute, $value, $parameters, $validator) {
            $startDate = $validator->getData()[$parameters[0]];

            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($value);

            return $startDate->diffInMonths($endDate) <= 1;
        });

        Validator::replacer('max_one_month_difference', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Limit periode pencarian adalah 1 bulan');
        });
    }
}
