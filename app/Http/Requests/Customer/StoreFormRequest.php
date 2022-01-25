<?php

namespace App\Http\Requests\Customer;

use App\Models\Customer;
use Bloonde\ProjectGenerator\AbstractClasses\AbstractStoreFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Bloonde\ProjectGenerator\Helpers\CodesHelper;

class StoreFormRequest extends AbstractStoreFormRequest
{

    public $configuration_impl;
    protected $user_id;

    public function __construct()
    {
        parent::__construct('customer');
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
        $this->user_id = null;
        $rules = parent::rules();
        if ($this->route('id')) {
            $this->user_id = Customer::find($this->route('id'))->user_id;
        }
        $extra_rules = [
            "email" => "required|email|max:50|unique:users,email," . $this->user_id
        ];
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
