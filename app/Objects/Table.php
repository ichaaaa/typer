<?php 

namespace App\Objects;

class Table
{
	private $positions = [];

	public function addPosition(Position $position)
	{
		array_push($this->positions, $position);
	}

	public function getPositions()
	{
		return $this->positions;
	}
}