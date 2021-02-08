<?php


namespace App\Http\Resources\Specialization;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Translate\TranslateResource;
use App\Models\Specialization;

/**
 * @mixin Specialization
 */
class SpecializationResource extends BaseResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = parent::toArray($request);

        $result['translates'] = TranslateResource::collection($this->translates);

        if (isset($result['translates']) && count($result['translates'])) {
            foreach ($result['translates'] as $translate) {
                $result['locale_'.$translate['locale']] = $translate['value'];
            }
        }
        return $this->filterResult($result, $request);
    }
}