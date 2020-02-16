<?php

namespace HeroGame\Skills;
use HeroGame\Config\Config;

class RapidStrikeFactory implements SkillFactory {

	public function create()
	{
		return new RapidStrike(Config::SKILL_RAPIDSTRIKE);
	}
	
}