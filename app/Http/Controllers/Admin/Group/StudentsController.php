<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupStudent;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class StudentsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Group $group
     * @return View|RedirectResponse
     */
    public function create(Group $group)
    {
        if ($group->students->count() < $group->size->max_count)
        {
            $users = User::whereNotIn('id', $group->students->modelKeys())
                ->where('type', '=', User::TYPE_STUDENT)
                ->get()
                ->pluck('name', 'id');
            return view('admin.group.students.create', compact('users', 'group'));
        }

        return redirect()
            ->route('groups.show', ['group' => $group->id])
            ->with('error', 'Группа уже собрана');
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
            'student_id' => 'required|integer|unique:group_student,student_id,'.$request->input('student_id').',id,group_id,'.$group->id,
        ]);
        GroupStudent::create($request->all());
        return redirect()
            ->route('groups.show', ['group' => $group->id])
            ->with('success', 'Новый студент успешно добавлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @param GroupStudent $student
     * @return RedirectResponse
     */
    public function destroy(Group $group, GroupStudent $student): RedirectResponse
    {
        $student->delete();
        return redirect()
            ->route('groups.show', ['group' => $group])
            ->with('success', 'Студент удален');
    }
}
