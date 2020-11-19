<?php

namespace Database\Factories;

use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectUser::class;

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
            'user_id' => $data['user'], 'project' => $data['project'],
        ];
    }

    private function getData()
    {
        $project = $this->faker->randomElement([1010, 5174, 5335]);

        $user = User::query()->whereKeyNot(1)
            ->whereDoesntHave('project_user', function ($query) use ($project) {
                $query->where('project', $project);
            })->inRandomOrder()->take(1)->value('id');

        return $data = array('user' => $user, 'project' => $project);
    }
}
