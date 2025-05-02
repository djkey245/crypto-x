<?php

namespace App\Domain\News\Repositories;

use App\Domain\News\DTO\TweetDTO;

interface TweetRepositoryInterface
{
    public function existsByTweetId(string $tweetId): bool;

    public function saveFromDTO(TweetDTO $dto): void;

    public function bulkSaveFromDTOs(array $dtos): void;
}
