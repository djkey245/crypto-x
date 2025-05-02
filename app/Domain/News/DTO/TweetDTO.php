<?php

namespace App\Domain\News\DTO;

use App\Domain\News\Models\Account;

readonly class TweetDTO
{
    public function __construct(
        public string             $tweetId,
        public string             $url,
        public string             $text,
        public string             $source,
        public Account            $account,
        public \DateTimeInterface $postedAt,
    )
    {}
}
