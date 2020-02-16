<?php

namespace HeroGame\Skills;
use HeroGame\Characters\Character;

interface Skill {
	public function apply(Character $attacker, Character $defender);
}