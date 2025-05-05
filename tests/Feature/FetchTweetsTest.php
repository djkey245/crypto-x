<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use App\Domain\News\Models\Account;

beforeEach(function () {
    Account::factory()->withNickname('saylor')->create();
    Storage::fake();
});

it('parse-tweets-command is successful', function () {

    $this->artisan('app:parse-tweets-command')->assertExitCode(0);

});

it('saving tweets', function () {
    $tweetRepository = new \App\Infrastructure\Persistence\News\EloquentTweetRepository();
    $account = Account::first();
    $url = 'https://x.com/test';
    $text = 'Test text';
    $postedAt = \Carbon\Carbon::parse(str_replace('·', '', 'Apr 22, 2025 · 8:05 PM UTC'));
    $DTOs = [new \App\Domain\News\DTO\TweetDTO('123', $url, $text, 'X', $account, $postedAt)];
    $tweetRepository->bulkSaveFromDTOs($DTOs);

    $this->assertDatabaseHas('tweets', [
        'url' => $url,
        'text' => $text,
        'account_id' => $account->id,
        'posted_at' => $postedAt->format('Y-m-d H:i:s')
    ]);

});

it('the parsing function works correctly', function () {

    $html = \Illuminate\Support\Facades\File::get(base_path('tests/Fixtures/tweet.html'));

    $parser = new \App\Domain\News\Services\TweetParserService(Account::first());
    $tweets = $parser->parse($html, 2);
    expect($tweets)->toBeArray()
        ->and($tweets)->toHaveCount(2)
        ->and($tweets[0]->text)->toBeString()
        ->and($tweets[0]->tweetId)->toBeNumeric()
        ->and($tweets[0]->postedAt)->toBeInstanceOf(DateTimeInterface::class)
        ->and($tweets[0])->toBeInstanceOf(App\Domain\News\DTO\TweetDTO::class);

});

it('the Twitter page retrieval function works correctly', function () {

    $parser = new \App\Domain\News\Services\TweetParserService(Account::first());
    $twitterPage = $parser->fetch();
    expect($twitterPage)->toBeString()->and($twitterPage)->toContain('html', 'body', 'timeline', 'timeline-item', 'tweet-content', 'tweet-link', 'tweet-date');
});
