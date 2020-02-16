<?php

namespace HeroGame\Characters;
use HeroGame\Config\Config;

Class BeastFactory implements CharacterFactory {

	public function create()
	{
		return new Beast(Config::BEAST_STATS);
	}

}