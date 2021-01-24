<?php


namespace App\Http\ViewModels\Pet;

use App\Http\ViewModels\ViewModel;
use App\Models\Pet;

class PetIndexViewModel extends ViewModel
{
    /** @var $pets Pet[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection */
    public function __construct($pets)
    {
        $result = $pets->map(function (Pet $pet){
            return $pet->toArray();
        });

        $this->data['pets'] = $result;
    }
}