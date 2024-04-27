<?php
namespace App\Http\Services;

use App\Transformers\Provider1Transformer;
use App\Transformers\Provider2Transformer;

class EmployeeService
{
    const PROVIDER_1 = 'provider1';
    const PROVIDER_2 = 'provider2';
    protected $trackTikApiClient;

    public function __construct(TrackTikAPIClient $trackTikApiClient)
    {
        $this->trackTikApiClient = $trackTikApiClient;
    }

    /**
     * @param $data
     * @param $provider
     * @return array
     */
    public function createEmployee($data, $provider)
    {
        $transformedData = $this->getTransformedData($data, $provider);

        return $this->trackTikApiClient->createEmployee($transformedData);
    }

    /**
     * @param $data
     * @param $provider
     * @param $id
     * @return array
     */
    public function updateEmployee($data, $provider, $id)
    {
        $transformedData = $this->getTransformedData($data, $provider);

        return $this->trackTikApiClient->updateEmployee($transformedData, $id);
    }

    /**
     * @param $id
     * @return array
     */
    public function geEmployeeById($id)
    {
        return $this->trackTikApiClient->getEmployee($id);
    }

    /**
     * @param $data
     * @param $provider
     * @return array
     */
    public function getTransformedData($data, $provider)
    {
        if ($provider == self::PROVIDER_1) {
            return Provider1Transformer::employeeTransform($data);
        } else {
            return Provider2Transformer::employeeTransform($data);
        }
    }
}


