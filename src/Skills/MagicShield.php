<?php

namespace HeroGame\Skills;
use HeroGame\Logger\Logger;
use HeroGame\Characters\Character;

class MagicShield implements Skill {
	private $chance;
	public $attack;
	public $defense;

	public function __construct($config)
	{
		$this->chance = array_key_exists('chance', $config) ? $config['chance'] : 0;
		$this->attack = array_key_exists('attack', $config) ? $config['attack'] : false;
		$this->defense = array_key_exists('defense', $config) ? $config['defense'] : false;
	}

	public function apply(Character $attacker, Character $defender)
	{
		if ($this->chance >= mt_rand(1, 100)) {
			Logger::log($defender->getType() . " uses the magic shield skill");

			$attacker->setDamage($attacker->getDamage() / 2);
		}
	}
}