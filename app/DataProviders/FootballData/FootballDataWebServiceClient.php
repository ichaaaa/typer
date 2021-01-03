<?php 

namespace App\DataProviders\FootballData;

use App\Contracts\HasTokenContract;
use App\Contracts\WebServiceClient;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\GuzzleException;

class FootballDataWebServiceClient implements WebServiceClient, HasTokenContract
{
	private $guzzleClient;
    private $baseParams;

	public function __construct()
	{
        $this->baseParams = config('app.api_keys.football_data');
		$this->guzzleClient = new GuzzleHttpClient();
	}


	public function getCompetitionsList(array $params = [])
	{
        return $this->makeRequest(
            'https://api.football-data.org/v2/competitions',
            $params
        );
	}


    public function getCompetition($id)
    {
        return $this->makeRequest(
            'https://api.football-data.org/v2/competitions/'.$id
        );
    }


    /**
    * params:
    * season={YEAR}
    * stage={STAGE}
    */
    public function getCompetitionTeams($competition_id, array $params = [])
    {
        return $this->makeRequest(
            'https://api.football-data.org/v2/competitions/'.$competition_id.'/teams',
            $params
        );
    }

    /**
    * params:
    * standingType={standingType}
    */
    public function getCompetitionStanding($competition_id, array $params = [])
    {
        return $this->makeRequest(
            'https://api.football-data.org/v2/competitions/'.$competition_id.'/standings',
            $params
        );
    }

    /**
    * params:
    * dateFrom={DATE}
    * dateTo={DATE}
    * stage={STAGE}
    * status={STATUS}
    * matchday={MATCHDAY}
    * group={GROUP}
    * season={YEAR}
    */
    public function getCompetitionMatches($competition_id, array $params = [])
    {
        return $this->makeRequest(
            'https://api.football-data.org/v2/competitions/'.$competition_id.'/matches',
            $params
        );
    }

    /**
    * params:
    * limit={LIMIT}
    */
    public function getCompetitionScorers($competition_id, array $params = [])
    {
        return $this->makeRequest(
            'https://api.football-data.org/v2/competitions/'.$competition_id.'/scorers',
            $params
        );
    }

    /**
    * params:
    * competitions={competitionIds}
    * dateFrom={DATE}
    * dateTo={DATE}
    * status={STATUS}
    */
    public function getAllMatches(array $params = [])
    {
        return $this->makeRequest(
            'https://api.football-data.org/v2/matches',
            $params
        );
    }

    public function getMatch($id)
    {
        return $this->makeRequest(
            'https://api.football-data.org/v2/matches/'.$id
        );
    }

    /**
    * params:
    * dateFrom={DATE}
    * dateTo={DATE}
    * status={STATUS}
    * venue={VENUE}
    * limit={LIMIT}
    */
    public function getTeamMatches($id, array $params = [])
    {
        return $this->makeRequest(
            'https://api.football-data.org/v2/teams/'.$id.'/matches',
            $params
        );
    }

    public function getTeam($id)
    {
        return $this->makeRequest(
            'https://api.football-data.org/v2/teams/'.$id
        );
    }

    public function getPlayer($id)
    {
        return $this->makeRequest(
            'https://api.football-data.org/v2/players/'.$id
        );
    }


    /**
    * params:
    * dateFrom={DATE}
    * dateTo={DATE}
    * status={STATUS}
    * competitions={competitionIds}
    * limit={LIMIT}
    */
    public function getPlayerMatches($id, array $params = [])
    {
        return $this->makeRequest(
            'https://api.football-data.org/v2/players/'.$id.'/matches',
            $params
        );
    }


	private function makeRequest($url, array $params = []) {

        $queryParams['plan'] = $this->baseParams['plan'];

        $queryParams = array_merge($queryParams, $params);

        try{
            return json_decode(
                $this->guzzleClient->request('GET', $url, [
                    'headers' => $this->getHeaders(),
                    'query' => $queryParams,
                ])->getBody(),
                true
            );
        }
        catch(\Exception $e)
        {
            return [];
        }

    }


	/**
     * @return string[]
     * @throws GuzzleException
     */
    private function getHeaders()
    {
        return [
            'Accept'        => 'application/json',
            'X-Auth-Token' =>  $this->getToken(),
        ];
    }

    public function getToken()
    {
    	return $this->baseParams['token'];
    }

}