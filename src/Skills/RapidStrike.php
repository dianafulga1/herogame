<?php

namespace HeroGame\Skills;
use HeroGame\Logger\Logger;
use HeroGame\Characters\Character;

class RapidStrike implements Skill {
	private $chance;
	public $attack;
	public $defense;
	private $used;

	public function __construct($config)
	{
		$this->used = false;
		$this->chance = array_key_exists('chance', $config) ? $config['chance'] : 0;
		$this->attack = array_key_exists('attack', $config) ? $config['attack'] : false;
		$this->defense = array_key_exists('defense', $config) ? $config['defense'] : false;
	}

	public function apply(Character $attacker, Character $defender)
	{
		if (!$this->used && $this->chance >= mt_rand(1, 100)) {
			$this->used = true;
			$attacker->attack($defender);
			$defender->defend($attacker);

			Logger::log($attacker->getType() . " uses the rapid strike skill");
			$this->used = false;
		}
	}
}