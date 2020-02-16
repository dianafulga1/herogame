<?php

namespace HeroGame\Characters;
use HeroGame\Logger\Logger;
use HeroGame\Skills;

class Hero extends Character {
	private $skills;

	public function __construct($stats)
	{
    	parent::__construct($stats, "Hero");
    	$this->skills[] = (new Skills\MagicShieldFactory())->create();
    	$this->skills[] = (new Skills\RapidStrikeFactory())->create();
	}

	public function attack(Character $defender)
	{
		if (!empty($this->skills))
			foreach ($this->skills as $skill)
				if ($skill->attack)
					$skill->apply($this, $defender);

		$this->setDamage($this->strength - $defender->getDefense());

		Logger::log($this->type . " attacks with " . $this->damage);
	}

	public function defend(Character $attacker)
	{
		if (!empty($this->skills))
			foreach ($this->skills as $skill)
				if ($skill->defense)
					$skill->apply($attacker, $this);
		
		$damage = (mt_rand(0, 100) > $this->luck) ? $attacker->getDamage() : 0;
		$this->setHealth($this->health - $damage);

		if ($damage == 0)
			Logger::log($this->type . " is lucky and blocks the attack");
		Logger::log($this->type . " has " . $this->getHealth() . " health left");
	}

}
