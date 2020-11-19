<?php

namespace Database\Factories;

use App\Models\Resource;
use App\Models\ResourceUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ResourceUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = $this->getData();

        if (empty($data['user'])) {
            while (empty($data['user'])) {
                $data = $this->getData();
            }
        }

        return [
            'user_id'   => $data['user'], 'resource_id' => $data['resource'],
            'is_active' => rand(0, 1),
        ];
    }

    private function getData()
    {
        $resource = Resource::inRandomOrder()->take(1)->value('id');

        $user = User::query()->whereKeyNot(1)->whereDoesntHave('resource_user',
                function ($query) use ($resource) {
                    $query->where('resource_id', $resource);
                })->inRandomOrder()->take(1)->value('id');

        return $data = array('user' => $user, 'resource' => $resource);
    }
}
