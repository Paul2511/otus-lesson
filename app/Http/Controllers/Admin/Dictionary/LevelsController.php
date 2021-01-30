<?php

namespace App\Http\Controllers\Admin\Dictionary;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $levels = Level::paginate(20);
        return view('admin.dictionary.levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.dictionary.levels.create');
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
            'order' => 'integer|required',
        ]);
        Level::create($request->all());
        $request->session()->flash('success', 'Уровень добавлен');
        return redirect()->route('levels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Level $level
     * @return Response
     */
    public function show(Level $level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Level $level
     * @return View
     */
    public function edit(Level $level): View
    {
        return view('admin.dictionary.levels.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Level $level
     * @return RedirectResponse
     */
    public function update(Request $request, Level $level): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'order' => 'integer|required',
        ]);
        $level->slug = null;
        $level->update($request->all());
        $request->session()->flash('success', 'Уровень обновлен');
        return redirect()->route('levels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Level $level
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Level $level): RedirectResponse
    {
        $level->delete();
        return redirect()->route('levels.index')->with('success', 'Уровень удален');
    }
}
