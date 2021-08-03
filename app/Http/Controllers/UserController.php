<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    private const CACHE_TIMEOUT_USER_ALL = 120;
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = Cache::remember('users', self::CACHE_TIMEOUT_USER_ALL, function () {
            return $this->userRepository->all();
        });

        return UserResource::collection($users);
    }
}
