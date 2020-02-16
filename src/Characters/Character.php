<?php

namespace HeroGame\Characters;

abstract class Character {
	protected $health;
	protected $strength;
	protected $defense;
	protected $speed;
	protected $luck;
	protected $damage;
	protected $type;

	abstract public function attack(Character $defender);
	abstract public function defend(Character $attacker);

	public function __construct($stats, $type)
	{
		if (empty($stats))
			throw new \Exception('The stats cannot be empty');

		foreach ($stats as $key => $value) {
			if (empty($value[0]) || empty($value[1]))
				throw new \Exception('The minimum or maximum value is missing');
			
			if ($value[0] > $value[1])
				throw new \Exception('The minimum cannot be greater than maximum');

			$this->$key = rand($value[0], $value[1]);
		}

		$this->type = $type;
		$this->damage = 0;
	}

	public function setHealth($health)
	{
		$this->health = $health >= 0 ? $health : 0;
	}

	public function getHealth()
	{
		return $this->health;
	}

	public function setDamage($damage)
	{
		$this->damage = $damage >= 0 ? $damage : 0;
	}

	public function getDamage()
	{
		return $this->damage;
	}

	public function getStrength()
	{
		return $this->strength;
	}

	public function getSpeed()
	{
		return $this->speed;
	}

	public function getLuck()
	{
		return $this->luck;
	}

	public function setLuck($luck)
	{
		$this->luck = $luck;
	}
	
	public function getDefense()
	{
		return $this->defense;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getStats() {
		$stats = $this->type . ' stats: ' . PHP_EOL;

		$stats .= 'Health: ' . $this->health . PHP_EOL;
		$stats .= 'Strength: ' . $this->strength . PHP_EOL;
		$stats .= 'Defense: ' . $this->defense . PHP_EOL;
		$stats .= 'Speed: ' . $this->speed . PHP_EOL;
		$stats .= 'Luck: ' . $this->luck . PHP_EOL;

        return $stats;
    }

    public function isAlive()
    {
    	return $this->health > 0;
    }

}