<?php

namespace App\Services\Categories\Translators;

use App\Models\Admin\Categories\Categories;

class CategoryStatusesTranslator {
    
    public function translator(string $lang):array
    {
        return [
            Categories::STATUS_ACTIVE => __('admin.categories.active',[],$lang),
            Categories::STATUS_INACTIVE => __('admin.categories.inactive',[],$lang),
        ];
    }
}
