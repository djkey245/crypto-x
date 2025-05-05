<?php

namespace App\Application\Jobs;

use App\Domain\News\Models\Account;
use App\Domain\News\Repositories\TweetRepositoryInterface;
use App\Domain\News\Services\TweetParserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FetchTweetsJob implements ShouldQueue
{
    use Queueable;

    // Job запускає Parser твітів

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Account $account)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(TweetRepositoryInterface $tweetRepository): void
    {
        $parserService = new TweetParserService($this->account);
        $twitterPage = $parserService->fetch();
        $tweetDTOs = $parserService->parse($twitterPage);
        $tweetRepository->bulkSaveFromDTOs($tweetDTOs);
    }
}
