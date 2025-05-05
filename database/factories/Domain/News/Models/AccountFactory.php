<?php

namespace Database\Factories\Domain\News\Models;

use App\Domain\News\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\News\Models\Account>
 */
class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'nickname' => $this->faker->unique()->userName,
            'type' => 'investor',
        ];
    }

    public function withNickname(string $nickname): static
    {
        return $this->state(fn() => [
            'nickname' => $nickname,
        ]);
    }
}
