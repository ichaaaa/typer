<?php

namespace App\Objects;

use App\Objects\Player;

class Team
{
	private $id;
	private $name;
	private $shortName;
	private $crestURL;
	private $address;
	private $website;
	private $founded;
	private $venue;
	private $players = [];


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * @param mixed $shortName
     *
     * @return self
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCrestURL()
    {
        return $this->crestURL;
    }

    /**
     * @param mixed $crestURL
     *
     * @return self
     */
    public function setCrestURL($crestURL)
    {
        $this->crestURL = $crestURL;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     *
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     *
     * @return self
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFounded()
    {
        return $this->founded;
    }

    /**
     * @param mixed $founded
     *
     * @return self
     */
    public function setFounded($founded)
    {
        $this->founded = $founded;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * @param mixed $venue
     *
     * @return self
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlayers()
    {
        return $this->players;
    }

    public function addPlayer(Player $player)
    {
    	array_push($this->players, $player);
    }

}