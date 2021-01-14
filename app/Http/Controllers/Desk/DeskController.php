<?php

namespace App\Http\Controllers\Desk;

use App\Http\Controllers\Controller;
use App\Services\Columns\ColumnService;

class DeskController extends Controller
{
    private ColumnService $columnService;

    public function __construct(ColumnService $columnService)
    {
        $this->columnService = $columnService;
    }

    public function index()
    {
        $columns = $this->columnService->getColumnsWithTasks();
        return view('pages.index', compact('columns'));
    }
}
