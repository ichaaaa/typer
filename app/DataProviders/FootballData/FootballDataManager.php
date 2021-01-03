<?php 

namespace App\DataProviders\FootballData;

use App\Contracts\DataManager;
use App\Contracts\DataTransformer;
use App\Contracts\WebServiceClient;
use App\DataProviders\FootballData\FootballDataDataTransformer;
use App\DataProviders\FootballData\FootballDataWebServiceClient;

class FootballDataManager implements DataManager
{
	/**
     * Returns object with methods to call API web services
     * May be based for example on the GuzzleClient or SoapClient
     *
     * @return WebServiceClient
     */
	public function getWebServiceClient(): WebServiceClient
	{
		return new FootballDataWebServiceClient;
	}

	public function getDataTransformer(): DataTransformer
	{
		return new FootballDataDataTransformer;
	}

}