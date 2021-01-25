<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\GroupSize;
use App\Models\Level;
use App\Models\Skill;
use App\Models\SkillUser;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Exception;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @var $students User
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '-1');

        $students = User::factory()->count(30) ->create(['type' => User::TYPE_STUDENT]);
        $teachers = User::factory()->count(10)->create(['type' => User::TYPE_TEACHER]);

        $skills = Skill::all()->pluck('id')->toArray();
        $count_skills = count($skills);
        $levels = Level::all()->pluck('id')->toArray();

        foreach ($students as $student)
        {
            $count_student_skills = rand(0, $count_skills);
            for ($i = 0; $i < $count_student_skills; $i++) {
                try {
                    $skill_id = Arr::random($skills);
                    $level_id = Arr::random($levels);
                    $student->skills()->attach([
                        ['skill_id' => $skill_id, 'level_id' => $level_id]
                    ]);
                } catch (Exception $e) {
                    report($e);
                }
            }
        }

        foreach ($teachers as $teacher)
        {
            $count_teacher_skills = rand(0, $count_skills);
            for ($i = 0; $i < $count_teacher_skills; $i++) {
                try {
                    $skill_id = Arr::random($skills);
                    $level_id = Arr::random($levels);
                    $teacher->skills()->attach([
                        ['skill_id' => $skill_id,'level_id' => $level_id]
                    ]);
                } catch (Exception $e) {
                    report($e);
                }
            }
        }

        $faker = Factory::create();
        $skills_collection = DB::table('skill_user')
            ->select(DB::raw('skill_id, level_id, count(id) as user_count'))
            ->groupBy('skill_id', 'level_id')
            ->orderBy('user_count', 'desc')
            ->get()
            ->toArray();
        $group_sizes = GroupSize::all()->pluck('id')->toArray();
        $groups = array_slice($skills_collection, 0, 7);

        foreach ($groups as $key => $group_local) {
            $group = new Group();
            $group->title = $faker->sentence($nbWords = 5, $variableNbWords = true);
            $group->description =  $faker->paragraph($nbSentences = 2, $variableNbSentences = true);
            $group->size_id = Arr::random($group_sizes);
            $group->save();
            $students_limit = $group->size->max_count;

            $students = SkillUser::with('user' )->whereHas('user', function($query) {
                $query->where('type', '=', User::TYPE_STUDENT);
            })
                ->where('skill_id', '=', $group_local->skill_id)
                ->where('level_id', '=', $group_local->level_id)
                ->limit($students_limit)
                ->pluck('user_id');

            $teachers = SkillUser::with('user' )->whereHas('user', function($query) {
                $query->where('type', '=', User::TYPE_TEACHER);
            })
                ->where('skill_id', '=', $group_local->skill_id)
                ->where('level_id', '=', $group_local->level_id)
                ->limit(2)
                ->pluck('user_id');

            $group->students()->attach($students);
            $group->teachers()->attach($teachers);
        }
    }
}
