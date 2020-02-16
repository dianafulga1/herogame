<?php

use PHPUnit\Framework\TestCase;
use HeroGame\Skills\MagicShieldFactory;
use HeroGame\Skills\MagicShield;
use HeroGame\Skills\Skill;
use HeroGame\Characters\Character;

class MagicShieldTest extends TestCase
{
	private $config = [
		'chance' => 100,
		'attack' => false,
		'defense' => true
	];

	private $stats = [
		'health' 	=> [70, 100],
		'strength'  => [50, 50],
		'speed'     => [40, 50],
		'defense'   => [30, 50],
		'luck'      => [10, 30]
	];

	public function testImplementsSkillInterface()
	{
		$factory = new MagicShield($this->config);
		$this->assertTrue($factory instanceof Skill);
	}

	public function testApplyAlways()
	{
		$attacker = $this->getMockBuilder(Character::Class)
				->setConstructorArgs([$this->stats, ''])
				->getMockForAbstractClass();
		$defender = $this->getMockBuilder(Character::Class)
				->setConstructorArgs([$this->stats, ''])
				->getMockForAbstractClass();
		$skill = new MagicShield($this->config);
		$initialDamage = 10;
		$attacker->setDamage($initialDamage);

		$skill->apply($attacker, $defender);
		$this->assertEquals($attacker->getDamage(), $initialDamage / 2);
	}

	public function testApplyNever()
	{
		$config = [
			'chance' => 0,
			'attack' => false,
			'defense' => true
		];
		$attacker = $this->getMockBuilder(Character::Class)
				->setConstructorArgs([$this->stats, ''])
				->getMockForAbstractClass();
		$defender = $this->getMockBuilder(Character::Class)
				->setConstructorArgs([$this->stats, ''])
				->getMockForAbstractClass();
		$skill = new MagicShield($config);
		$initialDamage = 10;
		$attacker->setDamage($initialDamage);

		$skill->apply($attacker, $defender);
		$this->assertEquals($attacker->getDamage(), $initialDamage);
	}
	
	public function testEmptyConfig()
	{
		$config = [];
		$skill = new MagicShield($config);
		$reflector = new ReflectionClass(MagicShield::class);
		$property = $reflector->getProperty('chance');
		$property->setAccessible(true);

		$this->assertFalse($skill->defense);
		$this->assertFalse($skill->attack);
		$this->assertEquals($property->getValue($skill), 0);
	}

	public function testConfigValues()
	{
		$skill = new MagicShield($this->config);
		$reflector = new ReflectionClass(MagicShield::class);
		$property = $reflector->getProperty('chance');
		$property->setAccessible(true);

		$this->assertEquals($skill->defense, $this->config['defense']);
		$this->assertEquals($skill->attack, $this->config['attack']);
		$this->assertEquals($property->getValue($skill), $this->config['chance']);
	}
}