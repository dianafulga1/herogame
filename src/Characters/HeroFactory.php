<?php

namespace HeroGame\Characters;
use HeroGame\Config\Config;

Class HeroFactory implements CharacterFactory {

	public function create()
	{
		return new Hero(Config::HERO_STATS);
	}

}