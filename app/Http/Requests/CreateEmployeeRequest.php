<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

class CreateEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $provider = $this->route('provider');

        // default rules
        $rules = [
            'email' => 'required|email',
        ];

        if ($provider === 'provider1') {
            $additionalRules = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'department' => 'sometimes|string|max:255',
            ];
        } elseif ($provider === 'provider2') {
            $additionalRules = [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'office' => 'sometimes|string|max:255',
            ];
        }

        return array_merge($rules, $additionalRules);
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->failed()) {
                    $jsonResponse = response()->json(['errors' => $validator->errors() ?? 'Invalid Data'], 422);
                    throw new HttpResponseException($jsonResponse);
                }
            }
        ];
    }
}
