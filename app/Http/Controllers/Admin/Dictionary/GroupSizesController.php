<?php

namespace App\Http\Controllers\Admin\Dictionary;

use App\Http\Controllers\Controller;
use App\Models\GroupSize;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class GroupSizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $groupSizes = GroupSize::paginate(20);
        return view('admin.dictionary.group-sizes.index', compact('groupSizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.dictionary.group-sizes.create');
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
            'max_count' => 'integer|required',
            'order' => 'integer|required',
        ]);
        GroupSize::create($request->all());
        $request->session()->flash('success', 'Размер группы добавлен');
        return redirect()->route('group-sizes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param GroupSize $groupSize
     * @return Response
     */
    public function show(GroupSize $groupSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GroupSize $groupSize
     * @return View
     */
    public function edit(GroupSize $groupSize): View
    {
        return view('admin.dictionary.group-sizes.edit', compact('groupSize'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param GroupSize $groupSize
     * @return RedirectResponse
     */
    public function update(Request $request, GroupSize $groupSize): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'max_count' => 'integer|required',
            'order' => 'integer|required',
        ]);
        $groupSize->slug = null;
        $groupSize->update($request->all());
        $request->session()->flash('success', 'Размер группы обновлен');
        return redirect()->route('group-sizes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GroupSize $groupSize
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(GroupSize $groupSize): RedirectResponse
    {
        $groupSize->delete();
        return redirect()->route('group-sizes.index')->with('success', 'Размер группы удален');
    }
}
