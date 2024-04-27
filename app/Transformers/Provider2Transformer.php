<?php

namespace App\Transformers;

class Provider2Transformer implements ProviderTransformerInterface
{
    public static function employeeTransform($data): array
    {
        $transformedData = [
            'firstName' => $data['first-name'] ?? null,
            'lastName' => $data['last-name'] ?? null,
            'email' => $data['email'] ?? null,
            'username' => $data['username'] ?? null,
            'jobTitle' => $data['jobTitle'] ?? null,
        ];

        return array_filter($transformedData, function ($value) {
            return !empty($value);
        });
    }

}

