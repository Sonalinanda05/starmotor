<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


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
        Paginator::useBootstrap();
        Blade::directive('fileIcon', function ($extension) {
            $extension = strtolower($extension);
    
            switch ($extension) {
                case 'pdf':
                    return '<i class="far fa-fw fa-file-pdf"></i>';
                case 'doc':
                case 'docx':
                    return '<i class="far fa-fw fa-file-word"></i>';
                case 'jpg':
                case 'jpeg':
                case 'png':
                    return '<i class="far fa-fw fa-image"></i>';
                case 'zip':
                    return '<i class="far fa-fw fa-file-zip"></i>';
                default:
                    return '<i class="far fa-fw fa-file"></i>';
            }
        });
    }
    

}
