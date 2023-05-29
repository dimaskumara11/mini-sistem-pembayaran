<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro('custom', function (array $data) {
            $responseData = [
                'data'      => $data["data"]??null,
                'message'   => $data["message"]??"",
            ];

            return Response::json($responseData, $data["code"]);
        });
    }
}
