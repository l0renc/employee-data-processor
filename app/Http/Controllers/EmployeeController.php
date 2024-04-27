<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Services\EmployeeService;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    private $employeeService;

    /**
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function test ()
    {
        dd('tttesst');
    }

    /**
     * @param CreateEmployeeRequest $request
     * @param $provider
     * @return JsonResponse
     */
    public function create(CreateEmployeeRequest $request, $provider)
    {
        $validatedData = $request->validated();
        $response = $this->employeeService->createEmployee($validatedData, $provider);

        return response()->json($response['data'], $response['status']);
    }

    /**
     * @param UpdateEmployeeRequest $request
     * @param $provider
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateEmployeeRequest $request, $provider, $id)
    {
        $validatedData = $request->validated();
        $response = $this->employeeService->updateEmployee($validatedData, $provider, $id);

        return response()->json($response['data'], $response['status']);
    }

}
