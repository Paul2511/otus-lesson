<?php


namespace App\Http\Resources\Pet;

use App\Models\Pet;
use App\Http\Resources\BaseResource;
use App\Models\User;
use App\Services\Files\Helpers\SrcHelper;

/**
 * @mixin Pet
 */
class PetResource extends BaseResource
{

    private function getSrcHelper(): SrcHelper
    {
        return app(SrcHelper::class);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = parent::toArray($request);

        /** @var User $my */
        $my = auth()->user();
        if ($my->canManage) {
            $result['clientName'] = $this->client->user->name->displayName;
        }

        $defaultPhotos = $this->getSrcHelper()->getAllPetDefaultPhoto();
        $result['defaultPhotos'] = $defaultPhotos;


        return $result;
    }
}