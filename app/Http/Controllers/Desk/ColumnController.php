<?php

namespace App\Http\Controllers\Desk;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateColumnRequest;
use App\Models\Column;
use App\Services\Columns\ColumnService;

class ColumnController extends Controller
{
    private ColumnService $columnService;

    public function __construct(ColumnService $columnService)
    {
        $this->columnService = $columnService;
    }


    public function store(CreateColumnRequest $columnRequest)
    {
        $this->columnService->storeColumn($columnRequest->toArray());
        return back()->with('message', __('Успех'));
    }

    public function show($id)
    {
        return redirect()->route('home');
    }

    public function destroy(int $id)
    {

        $this->columnService->destroyColumn($id);
        return back()->with('message', __('Успех'));
    }
}
