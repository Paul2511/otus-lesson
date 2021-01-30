<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Skill;
use App\Models\SkillUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param User $user
     * @return View
     */
    public function create(User $user): View
    {
        $skills = Skill::pluck('title','id');
        $levels = Level::pluck('title','id');
        return view('admin.user.skills.create', compact('user', 'skills', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(User $user, Request $request): RedirectResponse
    {
        $this->validate($request, [
            'user_id' => 'required|integer',
            'skill_id' => 'required|integer|unique:skill_user,skill_id,'.$request->input('skill_id').',id,user_id,'.$user->id,
            'level_id' => 'required|integer',
        ]);
        SkillUser::create($request->all());
        return redirect()
            ->route('users.show', ['user' => $user->id])
            ->with('success', 'Новый навык успешно добавлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param SkillUser $skill
     * @return RedirectResponse
     */
    public function destroy(User $user, SkillUser $skill): RedirectResponse
    {
        $skill->delete();
        return redirect()
            ->route('users.show', ['user' => $user])
            ->with('success', 'Навык удален');
    }
}
