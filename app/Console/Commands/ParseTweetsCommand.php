<?php

namespace App\Console\Commands;

use App\Application\Jobs\FetchTweetsJob;
use App\Domain\News\Models\Account;
use Illuminate\Console\Command;

class ParseTweetsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-tweets-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $accounts = Account::all();
        foreach ($accounts as $account) {
            FetchTweetsJob::dispatch($account);
        }
    }
}
