<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TEST THE SCHUDLE FOR USER';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::first();
        Log::info('Schedule command executed for user: ' . $user->name);
    }
}
