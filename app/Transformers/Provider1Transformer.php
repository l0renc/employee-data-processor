<?php

namespace App\Transformers;

class Provider1Transformer implements ProviderTransformerInterface
{
    public static function employeeTransform($data): array
    {
        $transformedData = [
            'firstName' => $data['first_name'] ?? null,
            'lastName' => $data['last_name'] ?? null,
            'email' => $data['email'] ?? null,
            'username' => $data['username'] ?? null,
            'jobTitle' => $data['jobTitle'] ?? null,
        ];

        return array_filter($transformedData, function ($value) {
            return !empty($value);
        });
    }

}

