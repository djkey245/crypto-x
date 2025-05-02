<?php

namespace App\Domain\News\Services;

use App\Domain\News\DTO\TweetDTO;
use App\Domain\News\Models\Account;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class TweetParserService
{

    public function __construct(private readonly Account $account)
    {
    }

    public function fetch($limit = 5): array
    {
        $url = "https://nitter.privacydev.net/{$this->account->nickname}";

        $html = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (compatible; Bot/1.0)',
        ])->timeout(10)->get($url)->body();

        return $this->parse($html, $limit);
    }

    private function parse(string $html, int $limit): array
    {
        $crawler = new Crawler($html);
        $tweets = [];

        $crawler->filter('div.timeline > div.timeline-item')->each(function (Crawler $node) use (&$tweets, $limit) {
            if (count($tweets) >= $limit) return;

            $text = trim($node->filter('.tweet-content')->text(''));
            $link = $node->filter('a.tweet-link')->attr('href') ?? '';
            $url = 'https://nitter.net' . $link;

            $tweetId = null;
            if ($link && preg_match('#/status/(\d+)#', $link, $matches)) {
                $tweetId = $matches[1];
            }

            $timestamp = $node->filter('span.tweet-date a')->attr('title') ?? '';

            $tweets[] = new TweetDTO($tweetId, $url, $text, 'X', $this->account, Carbon::parse(str_replace('·', '', $timestamp)));
        });
        return $tweets;
    }
}
