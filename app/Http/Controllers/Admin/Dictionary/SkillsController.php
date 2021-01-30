<?php

namespace App\Http\Controllers\Admin\Dictionary;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $skills = Skill::paginate(20);
        return view('admin.dictionary.skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.dictionary.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
        ]);
        Skill::create($request->all());
        $request->session()->flash('success', 'Навык добавлен');
        return redirect()->route('skills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Skill $skill
     * @return Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Skill $skill
     * @return View
     */
    public function edit(Skill $skill): View
    {
        return view('admin.dictionary.skills.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Skill $skill
     * @return RedirectResponse
     */
    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
        ]);
        $skill->slug = null;
        $skill->update($request->all());
        $request->session()->flash('success', 'Навык обновлен');
        return redirect()->route('skills.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Skill $skill
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();
        return redirect()->route('skills.index')->with('success', 'Навык удален');
    }
}
