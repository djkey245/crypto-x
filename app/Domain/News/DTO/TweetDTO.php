<?php

namespace App\Domain\News\DTO;

readonly class TweetDTO
{
    public function __construct(
        public string             $tweetId,
        public string             $url,
        public string             $text,
        public \DateTimeInterface $postedAt,
    ) {}
}
