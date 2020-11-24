<?php

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (self::getDefaultCards() as $i => $card) {
            factory(Card::class, 1)->states($i)->create();
        }
    }

    /**
     * TODO перенести в хэлпер как дефолтный
     * @return array
     */
    public static function getDefaultCards(): array
    {
        return [
            [
                'title' => 'Год',
                'count_month' => 12,
                'count_day' => 365,
                'price' => 200000,
            ],
            [
                'title' => '6 месяцев',
                'count_month' => 6,
                'count_day' => 180,
                'price' => 120000,
            ],
            [
                'title' => '3 месяца',
                'count_month' => 3,
                'count_day' => 90,
                'price' => 60000,
            ],
            [
                'title' => '1 месяц',
                'count_month' => 1,
                'count_day' => 30,
                'price' => 20000,
            ],
            [
                'title' => 'Персональные',
                'count_month' => 12,
                'count_day' => 365,
                'price' => 250000,
            ],
            [
                'title' => 'Детские',
                'count_month' => 1,
                'count_day' => 30,
                'price' => 15000,
            ],
        ];
    }
}
