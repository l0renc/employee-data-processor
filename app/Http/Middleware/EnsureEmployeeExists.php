<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Services\EmployeeService;

class EnsureEmployeeExists
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function handle($request, Closure $next)
    {
        $employeeId = $request->route('id');

        /** @var array $employeeCheck */
        $employeeCheck = $this->employeeService->geEmployeeById($employeeId);

        if ($employeeCheck['status'] === 200) {
            return $next($request);
        } else {
            return response()->json([
                'message' => 'Employee not found from TrackTik.',
                'status' => $employeeCheck['status'],
                'error' => $employeeCheck['message']
            ], $employeeCheck['status']);
        }
    }
}
