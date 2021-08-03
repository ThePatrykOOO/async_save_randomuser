<?php

namespace App\Console\Commands;

use App\Jobs\ProcessUserGeneratorJob;
use App\Repositories\UserRepository;
use App\Services\RandomUserService;
use App\Services\UserProcessDataService;
use Illuminate\Console\Command;

class RandomUserGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:random-generator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate random user command';

    private RandomUserService $randomUserService;
    private UserProcessDataService $userProcessDataService;
    private UserRepository $userRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        RandomUserService $randomUserService,
        UserProcessDataService $userProcessDataService,
        UserRepository $userRepository
    )
    {
        $this->randomUserService = $randomUserService;
        $this->userProcessDataService = $userProcessDataService;
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ProcessUserGeneratorJob::dispatch($this->randomUserService, $this->userProcessDataService, $this->userRepository);
        return 0;
    }
}
