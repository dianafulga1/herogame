<?php

use PHPUnit\Framework\TestCase;
use HeroGame\Skills\RapidStrike;
use HeroGame\Skills\Skill;
use HeroGame\Characters\Hero;
use HeroGame\Characters\Beast;

class RapidStrikeTest extends TestCase
{
	private $config = [
		'chance' => 100,
		'attack' => false,
		'defense' => true
	];

	private $stats = [
		'health' 	=> [100, 100],
		'strength'  => [50, 50],
		'speed'     => [40, 50],
		'defense'   => [30, 30],
		'luck'      => [10, 20]
	];

	public function testImplementsSkillInterface()
	{
		$factory = new RapidStrike($this->config);
		$this->assertTrue($factory instanceof Skill);
	}

	public function testApplyAlways()
	{
		$attacker = new Beast($this->stats);
		$defender = new Beast($this->stats);
		$skill = new RapidStrike($this->config);
		$damage = $attacker->getStrength() - $defender->getDefense();
		$initialHealth = $defender->getHealth();
		$defender->setLuck(0);

		$skill->apply($attacker, $defender);
		$this->assertEquals($attacker->getDamage(), $damage);
		$this->assertEquals($defender->getHealth(), $initialHealth - $damage);
	}

	public function testApplyNever()
	{
		$config = [
			'chance' => 0,
			'attack' => false,
			'defense' => true
		];

		$attacker = new Beast($this->stats);
		$defender = new Beast($this->stats);
		$skill = new RapidStrike($config);
		$initialHealth = $defender->getHealth();
		$defender->setLuck(0);

		$skill->apply($attacker, $defender);
		$this->assertEquals($defender->getHealth(), $initialHealth);
	}
	
	public function testEmptyConfig()
	{
		$config = [];
		$skill = new RapidStrike($config);
		$reflector = new ReflectionClass(RapidStrike::class);
		$property = $reflector->getProperty('chance');
		$property->setAccessible(true);

		$this->assertFalse($skill->defense);
		$this->assertFalse($skill->attack);
		$this->assertEquals($property->getValue($skill), 0);
	}

	public function testConfigValues()
	{
		$skill = new RapidStrike($this->config);
		$reflector = new ReflectionClass(RapidStrike::class);
		$property = $reflector->getProperty('chance');
		$property->setAccessible(true);

		$this->assertEquals($skill->defense, $this->config['defense']);
		$this->assertEquals($skill->attack, $this->config['attack']);
		$this->assertEquals($property->getValue($skill), $this->config['chance']);
	}
}