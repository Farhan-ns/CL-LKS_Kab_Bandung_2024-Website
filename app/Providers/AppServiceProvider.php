<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;
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
        // Disable resource wrapping
        JsonResource::withoutWrapping();

        Response::macro('success', function ($data, string $message = '', int $httpCode = 200) {
            return Response::json([
                'success' => true,
                'code' => $httpCode,
                'message' => $message,
                'data' => $data,
            ], $httpCode);
        });

        Response::macro('error', function ($error, string $message = '', int $httpCode) {
            return Response::json([
                'success' => false,
                'code' => $httpCode,
                'message' => $message,
                'error' => $error,
            ], $httpCode);
        });
    }
}
