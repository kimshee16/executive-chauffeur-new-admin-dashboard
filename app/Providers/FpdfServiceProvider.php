<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Fpdf\Fpdf;


class FpdfServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('fpdf', function () {
            return new Fpdf();
        });
    }
}