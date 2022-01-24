<?php

namespace App\Http\Requests\User;

use Bloonde\ProjectGenerator\AbstractClasses\AbstractStoreFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Bloonde\ProjectGenerator\Helpers\CodesHelper;

class StoreFormRequest extends AbstractStoreFormRequest
{

    public $configuration_impl;

    public function __construct()
    {
        parent::__construct('user');
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $extra_rules = [];
        $rules = array_merge($rules, $extra_rules);
        return $rules;
    }
    public function messages(){
        return parent::messages();
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), CodesHelper::FAILED_VALIDATOR_CODE));
    }

}
