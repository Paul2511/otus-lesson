<?php

use App\Models\Card;
use App\Models\CardUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class CardUserSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::query()->where('role', User::ROLE_GUEST)->pluck('id')->toArray();
        $cardIds = Card::query()->pluck('id')->toArray();

        $cards = factory(CardUser::class, 10)->make()->each(function ($card) use ($userIds, $cardIds) {
            factory(CardUser::class)->make();
            $card->user_id = (int)array_rand(array_flip($userIds));
            $card->card_id = (int)array_rand(array_flip($cardIds));
        })->toArray();

        CardUser::query()->insert($cards);
    }
}
