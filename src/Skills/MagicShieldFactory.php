<?php

namespace HeroGame\Skills;
use HeroGame\Config\Config;

class MagicShieldFactory implements SkillFactory {

	public function create()
	{
		return new MagicShield(Config::SKILL_MAGICSHIELD);
	}

}