<?php

namespace App\Http\Services;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Http;

class TrackTikAPIClient
{
    const TRACKTIK_EMPLOYEES_BASE_URL = 'https://smoke.staffr.net/rest/v1/employees/';

    /**
     * @param $data
     * @return array
     */
    public function createEmployee($data)
    {
        $token = Container::getInstance()->make('token');
        $url = self::TRACKTIK_EMPLOYEES_BASE_URL;

        $response = Http::withToken($token)->post($url, $data);

        return [
            'data' => $response->successful() ? $response->json() : $response->body(),
            'status' => $response->status()
        ];
    }

    /**
     * @param $data
     * @param $id
     * @return array
     */
    public function updateEmployee($data, $id)
    {
        $token = Container::getInstance()->make('token');
        $url = self::TRACKTIK_EMPLOYEES_BASE_URL . $id;

        $response = Http::withToken($token)->patch($url, $data);

        return [
            'data' => $response->successful() ? $response->json() : $response->body(),
            'status' => $response->status()
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function getEmployee($id)
    {
        $url = self::TRACKTIK_EMPLOYEES_BASE_URL . $id;
        $token = Container::getInstance()->make('token');
        $response = Http::withToken($token)->get($url);

        if (!$response->successful()) {
            return [
                'status' => $response->status(),
                'data' => null,
                'message' => 'Employee not found.'
            ];
        }

        return [
            'status' => $response->status(),
            'data' => $response->json(),
            'message' => 'Employee found.'
        ];
    }
}
