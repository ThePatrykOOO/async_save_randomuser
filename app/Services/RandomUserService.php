<?php


namespace App\Services;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RandomUserService
{
    public function handleDataFromAPI() : array
    {
        $request = Http::get(config('external.random_user.url'));

        if ($request->status() !== JsonResponse::HTTP_OK) {
            Log::error("Random user API return a different response code than 200.",
                ['code' => $request->status(), 'response_body' => $request->body()]
            );
            return [];
        }
        $z = $request->json();

        return Arr::get($request->json(), 'results.0');
    }
}
