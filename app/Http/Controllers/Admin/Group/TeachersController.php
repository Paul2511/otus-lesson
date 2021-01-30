<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupTeacher;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TeachersController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Group $group
     * @return View|RedirectResponse
     */
    public function create(Group $group)
    {
        $users = User::whereNotIn('id', $group->teachers->modelKeys())
            ->where('type', '=', User::TYPE_TEACHER)
            ->get()
            ->pluck('name', 'id');
        return view('admin.group.teachers.create', compact('users', 'group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request, Group $group): RedirectResponse
    {
        $this->validate($request, [
            'group_id' => 'required|integer',
            'teacher_id' => 'required|integer|unique:group_teacher,teacher_id,'.$request->input('teacher_id').',id,group_id,'.$group->id,
        ]);
        GroupTeacher::create($request->all());
        return redirect()
            ->route('groups.show', ['group' => $group->id])
            ->with('success', 'Новый преподаватель успешно добавлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @param GroupTeacher $teacher
     * @return RedirectResponse
     */
    public function destroy(Group $group, GroupTeacher $teacher): RedirectResponse
    {
        $teacher->delete();
        return redirect()
            ->route('groups.show', ['group' => $group])
            ->with('success', 'Преподаватель удален');
    }
}
