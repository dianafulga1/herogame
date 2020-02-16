<?php

use PHPUnit\Framework\TestCase;
use HeroGame\Characters\BeastFactory;
use HeroGame\Characters\Beast;
use HeroGame\Characters\HeroFactory;
use HeroGame\Characters\Hero;

class BeastTest extends TestCase
{
	private $stats = [
			'health' 	=> [70, 100],
			'strength'  => [50, 50],
			'speed'     => [40, 50],
			'defence'   => [30, 50],
			'luck'      => [10, 30]
		];
	
	public function testType()
	{
		$beast = new Beast($this->stats);
		$this->assertEquals($beast->getType(), 'Beast');
	}

	public function testAttack()
	{
		$attacker = new Beast($this->stats);
		$defender = new Beast($this->stats);

		$attacker->attack($defender);
		$this->assertEquals($attacker->getDamage(), $attacker->getStrength() - $defender->getDefense());
	}

	public function testDefendNoLuck()
	{
		$attacker = new Beast($this->stats);
		$defender = new Beast($this->stats);
		$defender->setLuck(0);
		$initialHealth = $defender->getHealth();

		$defender->defend($attacker);
		$this->assertEquals($defender->getHealth(), $initialHealth - $attacker->getDamage());
	}

	public function testDefendWithLuck()
	{
		$attacker = new Beast($this->stats);
		$defender = new Beast($this->stats);
		$defender->setLuck(100);
		$initialHealth = $defender->getHealth();

		$defender->defend($attacker);
		$this->assertEquals($defender->getHealth(), $initialHealth);
	}
}