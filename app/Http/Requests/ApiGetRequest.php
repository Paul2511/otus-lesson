<?php

namespace App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
class ApiGetRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if (isset($this->per_page)) {
            $this->merge([
                'per_page'=>(int)$this->per_page > Controller::MAX_PER_PAGE ? Controller::MAX_PER_PAGE : $this->per_page
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'per_page' => ['integer', 'min:1', 'max:'.Controller::MAX_PER_PAGE],
            'direction' => ['string', Rule::in(['DESC','ASC','desc','asc'])]
        ];
    }

    public function getHash() {
        $array = $this->toArray();
        $collect = collect($array)->sort()->toJson();
        return sha1($collect);
    }
}
