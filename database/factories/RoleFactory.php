<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Role;
use App\Policies\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->sentence,
            'status' => random_int(0, 1) === 0 ? Role::STATUS_INACTIVE : Role::STATUS_ACTIVE,
            'permissions' => [
                Article::class => [
                    Permission::VIEW_ANY,
                    Permission::RESTORE,
                    Permission::CREATE,
                    Permission::UPDATE,
                ]
            ],
        ];
    }
}
