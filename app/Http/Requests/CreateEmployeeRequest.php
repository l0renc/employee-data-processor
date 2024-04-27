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
                'username' => 'sometimes|string|max:255',
                'jobTitle' => 'sometimes|string|max:255',
                'primaryPhone' => 'sometimes|string|max:20',
            ];
        } elseif ($provider === 'provider2') {
            $additionalRules = [
                'first-name' => 'required|string|max:255',
                'last-name' => 'required|string|max:255',
                'username' => 'sometimes|string|max:255',
                'jobTitle' => 'sometimes|string|max:255',
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
