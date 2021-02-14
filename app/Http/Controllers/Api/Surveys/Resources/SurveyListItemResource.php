<?php

namespace App\Http\Controllers\Api\Surveys\Resources;

use App\Models\Survey;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SurveyListItemResource
 *
 * @package App\Http\Controllers\Api\Surveys\Resources
 * @mixin Survey
 */
class SurveyListItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
            'text' => $this->text
        ];
    }
}
