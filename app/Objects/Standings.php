<?php

namespace App\Objects;

use App\Objects\Table;

class Standings
{
	private $stage;
	private $type;
	private $group;
	private $table;


    /**
     * @return mixed
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * @param mixed $stage
     *
     * @return self
     */
    public function setStage($stage)
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }    

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     *
     * @return self
     */
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTable(): Table
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     *
     * @return self
     */
    public function setTable(Table $table)
    {
        $this->table = $table;

        return $this;
    }

}