<?php


namespace App\Http\ViewModels;


abstract class ViewModel
{
    protected $data = ['success'=>true];

    public function json()
    {
        return response()->json($this->data);
    }
}