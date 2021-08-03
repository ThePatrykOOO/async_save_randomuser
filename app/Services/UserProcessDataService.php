<?php


namespace App\Services;


class UserProcessDataService
{
    public function processResponse(array $response): array
    {
        return [
            'name' => $response['name']['first'],
            'email' => $response['email'],
            'password' => bcrypt($response['login']['password']),
        ];
    }
}
