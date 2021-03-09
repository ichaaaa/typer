<?php 

namespace App\Objects;

use App\Objects\Group;
use App\Objects\Match;

class Stage 
{
	protected $name;
	protected $code;
	protected $matches = [];
    protected $groups = [];
    protected $isGroup = false;


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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * @param mixed $matches
     *
     * @return self
     */
    public function addMatch(Match $match)
    {
        array_push($this->matches, $match);

        return $this;
    }

    public function setMatches($matches)
    {
        $this->matches = $matches;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param mixed $groups
     *
     * @return self
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * @param mixed $matches
     *
     * @return self
     */
    public function addGroup(Group $group)
    {
        array_push($this->groups, $group);

        return $this;
    }    

    /**
     * @return mixed
     */
    public function getIsGroup()
    {
        return $this->isGroup;
    }

    /**
     * @param mixed $isGroup
     *
     * @return self
     */
    public function setIsGroup($isGroup)
    {
        $this->isGroup = $isGroup;

        return $this;
    }
}