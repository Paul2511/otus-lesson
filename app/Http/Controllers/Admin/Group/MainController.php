<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupSize;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $groups = Group::paginate(20);
        return view('admin.group.main.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $sizes = GroupSize::pluck('title', 'id');
        return view('admin.group.main.create', compact('sizes'));
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
            'description' => 'required',
            'is_active' => 'required|boolean',
            'size_id' => 'required|integer',
        ]);
        Group::create($request->all());
        $request->session()->flash('success', 'Группа добавлена');
        return redirect()->route('groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return View
     */
    public function show(Group $group): View
    {
        return view('admin.group.main.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @return View
     */
    public function edit(Group $group): View
    {
        $sizes = GroupSize::pluck('title', 'id');
        return view('admin.group.main.edit', compact('group', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return RedirectResponse
     */
    public function update(Request $request, Group $group): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'is_active' => 'required|boolean',
            'size_id' => 'required|integer',
        ]);
        $group->update($request->all());
        $request->session()->flash('success', 'Группа обновлена');
        return redirect()->route('groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();
        return redirect()->route('groups.index')->with('success', 'Группа удалена');

    }
}
