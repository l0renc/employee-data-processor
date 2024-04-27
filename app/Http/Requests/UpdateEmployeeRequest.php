<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $provider = $this->route('provider');


        $rules = [
            'email' => 'sometimes|email',
        ];

        if ($provider === 'provider1') {
            $additionalRules = [
                'first_name' => 'sometimes|string|max:255',
                'last_name' => 'sometimes|string|max:255',
                'department' => 'sometimes|string|max:255',
            ];
        } elseif ($provider === 'provider2') {
            $additionalRules = [
                'fname' => 'sometimes|string|max:255',
                'lname' => 'sometimes|string|max:255',
                'office' => 'sometimes|string|max:255',
            ];
        }

        return array_merge($rules, $additionalRules);
    }

    public function after()
    {

        return [
            function (Validator $validator) {
                $inputFields = [
                    'email', 'first_name', 'last_name', 'department',
                    'fname', 'lname', 'office'
                ];

                $hasValidField = false;
                foreach ($inputFields as $field) {
                    if (!empty($this->$field)) {
                        $hasValidField = true;
                        break;
                    }
                }
                if (!$hasValidField) {
                    $validator->errors()->add('at_least_one', 'At least one field must be provided.');
                    $jsonResponse = response()->json(['errors' => $validator->errors() ?? 'Invalid Data'], 422);
                    throw new HttpResponseException($jsonResponse);
                }
            }
        ];
    }
}
