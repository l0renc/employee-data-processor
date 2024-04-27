<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Container\Container;
use App\Http\Services\EmployeeService;

class EnsureValidProvider
{
    /**
     * List of valid providers.
     *
     * @var array
     */
    protected $validProviders = [EmployeeService::PROVIDER_1, EmployeeService::PROVIDER_2];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $provider = $request->route('provider');

        if (!in_array($provider, $this->validProviders)) {
            return response()->json(['message' => 'Invalid provider specified'], 400);
        }

        $token = $request->bearerToken();
        if (!empty($token)) {
            Container::getInstance()->singleton('token', function () use ($token) {
                return $token;
            });
        } else {
            return response()->json(['message' => 'Please set a valid Bearer Token'], 400);
        }

        return $next($request);
    }
}
