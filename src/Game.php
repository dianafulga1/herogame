<?php

namespace HeroGame;

use HeroGame\Characters\HeroFactory;
use HeroGame\Characters\BeastFactory;
use HeroGame\Logger\Logger;
use HeroGame\Config\Config;

class Game {
	private $attacker = null;
	private $defender = null;
	private $rounds;
	
	public function __construct()
	{
		$this->rounds = Config::ROUNDS;

		$hero = (new HeroFactory())->create();
		$beast = (new BeastFactory())->create(); 

		if ($hero->getSpeed() > $beast->getSpeed() || 
			($hero->getSpeed() == $beast->getSpeed() &&
				$hero->getLuck() >= $beast->getLuck())) {
			$this->attacker = $hero;
			$this->defender = $beast;
		} else {
			$this->attacker = $beast;
			$this->defender = $hero;
		}

		Logger::log(PHP_EOL . "----- INITIALIZE GAME -----" . PHP_EOL);
		Logger::log($this->attacker->getStats());
		Logger::log($this->defender->getStats());
	}

	public function run()
	{
		$i = 1;

		Logger::log("----- START GAME -----");

		while ($i < $this->rounds && !$this->isOver()) {
			Logger::log(PHP_EOL . "ROUND:" . $i);
			
			$this->attacker->attack($this->defender);
			$this->defender->defend($this->attacker);
			$this->swapRoles();
			$i++;
		}

		if ($this->attacker->isAlive() && $this->defender->isAlive())
			Logger::log(PHP_EOL . "DRAW" . PHP_EOL);
		else
			Logger::log(PHP_EOL . $this->defender->getType() . " WON" . PHP_EOL);

		Logger::log("----- END GAME -----");
	}

	private function isOver()
	{
		return !$this->attacker->isAlive() || !$this->defender->isAlive();
	}

	private function swapRoles()
	{
		$aux = $this->attacker;
		$this->attacker = $this->defender;
		$this->defender = $aux;
	}

}

