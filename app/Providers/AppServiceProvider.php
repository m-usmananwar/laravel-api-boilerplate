<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

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
        Response::macro("success", function($message, $data = null) {
            return response()->json([
                "success" => true,
                "message" => $message,
                "data" => $data
            ]);
        });

        Response::macro("error", function($message, $code, $errros = []) {
            $response = [
                "success" => false,
                "message" => $message,
            ];

            if(count($errros) > 0) $response = array_merge($response, $errros);

            return response()->json($response, $code);
        });
    }
}
