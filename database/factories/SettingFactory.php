<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 2, 'type' => 'filename', 'value' => 1, // id базы
        ];
    }

    public function filename()
    {
        return $this->state(function () {
            $data = $this->getData();
            if (empty($data['user'])) {
                while (empty($data['user'])) {
                    $data = $this->getData();
                }
            }

            return [
                'user_id' => $data['user'], 'type' => $data['type'],
                'value'   => $data['value'],
            ];
        });

    }

    public function status()
    {
        return $this->state(function () {

            $data = $this->getData('status');
            if (empty($data['user'])) {
                while (empty($data['user'])) {
                    $data = $this->getData('status');
                }
            }

            return [
                'user_id' => $data['user'], 'type' => $data['type'],
                'value'   => $data['value'],
            ];
        });
    }

    private function getData($type = 'filename')
    {
        switch ($type) {
            case 'filename':
                $value = rand(1, 50);
                break;
            case 'status':
                $value = rand(1, 78);
                break;
        }
        $user = User::query()->whereKeyNot(1)->whereDoesntHave('settings',
            function ($query) use ($type, $value) {
                $query->where('type', $type)->where('value', $value);
            })->inRandomOrder()->take(1)->value('id');

        return $data = array(
            'user' => $user, 'type' => $type, 'value' => $value,
        );
    }
}
