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
    protected $signature = 'app:test-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test the schudle for user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //سوف نكتب هنا اللوجيك او شئ الذي نريده

        $user = User::first();
        Log::info('Hello' . $user->name);
    }
}