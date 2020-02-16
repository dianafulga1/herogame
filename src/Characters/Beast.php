<?php

namespace HeroGame\Characters;
use HeroGame\Logger\Logger;

class Beast extends Character {

	public function __construct($stats)
	{
    	parent::__construct($stats, "Beast");
	}

	public function attack(Character $defender)
	{
		if ($defender->isAlive()) {
			$this->setDamage($this->strength - $defender->getDefense());
			
			Logger::log($this->type . " attacks with " . $this->damage);
		}
	}

	public function defend(Character $attacker)
	{
		$damage = (mt_rand(0, 100) > $this->luck) ? $attacker->getDamage() : 0;
		$this->setHealth($this->health - $damage);

		if ($damage == 0)
			Logger::log($this->type . " is lucky and blocks the attack");
		Logger::log($this->type . " has " . $this->health . " health left");
	}
	
}