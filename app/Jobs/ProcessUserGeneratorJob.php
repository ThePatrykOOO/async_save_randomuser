<?php

namespace App\Jobs;

use App\Repositories\UserRepository;
use App\Services\RandomUserService;
use App\Services\UserProcessDataService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessUserGeneratorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private RandomUserService $randomUserService;
    private UserProcessDataService $userProcessDataService;
    private UserRepository $userRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        RandomUserService $randomUserService,
        UserProcessDataService $userProcessDataService,
        UserRepository $userRepository
    ) {
        $this->randomUserService = $randomUserService;
        $this->userProcessDataService = $userProcessDataService;
        $this->userRepository = $userRepository;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->randomUserService->handleDataFromAPI();

        if (empty($data)) {
            Log::warning("Random user data is empty. ");
            return;
        }

        try {
            $userData = $this->userProcessDataService->processResponse($data);
            $this->userRepository->create($userData);
        } catch (\Exception $exception) {
            Log::error("An exception occurred while processing and saving user data",
                ['message' => $exception->getMessage()]
            );
        }
    }


}
