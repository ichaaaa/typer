<?php 

namespace App\Contracts;

use App\Contracts\DataTransformer;
use App\Contracts\WebServiceClient;

interface DataManager
{

    /**
     * Returns object with methods to call API web services
     * May be based for example on the GuzzleClient or SoapClient
     *
     * @return WebServiceClient
     */
    public function getWebServiceClient(): WebServiceClient;
    public function getDataTransformer(): DataTransformer;

}