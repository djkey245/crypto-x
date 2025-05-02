<?php

namespace App\Infrastructure\Persistence\News;

use App\Domain\News\DTO\TweetDTO;
use App\Domain\News\Models\Account;
use App\Domain\News\Models\Tweet;
use App\Domain\News\Repositories\TweetRepositoryInterface;

class EloquentTweetRepository implements TweetRepositoryInterface
{
    public function existsByTweetId(string $tweetId): bool
    {
        return Tweet::where('tweet_id', $tweetId)->exists();
    }

    public function saveFromDTO(TweetDTO $dto): void
    {
        $tweet = Tweet::create([
            'tweet_id' => $dto->tweetId,
            'text' => $dto->text,
            'url' => $dto->url,
            'posted_at' => $dto->postedAt,
            'source' => $dto->source,
            'account_id' => $dto->account->id
        ]);
    }

    public function bulkSaveFromDTOs(array $dtos): void
    {
        $existingIds = Tweet::whereIn('tweet_id', array_column($dtos, 'tweetId'))
            ->pluck('tweet_id')
            ->toArray();

        $new = array_filter($dtos, fn($dto) => !in_array($dto->tweetId, $existingIds));

        foreach ($new as $dto) {
            $this->saveFromDTO($dto);
        }
    }
}
