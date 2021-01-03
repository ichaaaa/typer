<?php 

namespace App\Services;

use App\DataProvider;
use App\Factories\CompetitionDataFactory;

class DataProviderService
{

	protected $dataProvider;
	protected $dataManager;
	protected $webServiceClient;
	protected $dataTransformer;

	public function __construct()
	{
		$this->dataProvider = DataProvider::active()->firstOrFail();

    	$this->dataManager = CompetitionDataFactory::make($this->dataProvider);
    	$this->webServiceClient = $this->dataManager->getWebServiceClient();
    	$this->dataTransformer = $this->dataManager->getDataTransformer();
	}

}
