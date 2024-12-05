<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


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
    public function boot()
    {
        // Validação personalizada para CPF
        Validator::extend('cpf', function($attribute, $value, $parameters, $validator) {
            // Verifica se o valor do CPF segue o padrão de 3 números, ponto, 3 números, ponto, 3 números, traço e 2 números
            return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value);
        });
    }
}
