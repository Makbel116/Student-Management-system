<?php

namespace App\Providers;


use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(125);

        //to disable a space in the usernames
        Validator::extend('no_spaces', function ($attribute, $value, $parameters, $validator) {
            return !preg_match('/\s/', $value);
        });
        Validator::replacer('no_spaces', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute field should not contain spaces.');
        });
        Validator::extend('not_past_date', function ($attribute, $value, $parameters, $validator) {
            return strtotime($value) >= strtotime('today');
        });
    
        Validator::replacer('not_past_date', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The date must be a date equal to or after today.');
        });
    }
}
