<?php

use PHPUnit\Framework\TestCase;
use HeroGame\Characters\Character;

class CharacterTest extends TestCase
{
	private $stats = [
		'health' 	=> [70, 100],
		'strength'  => [50, 50],
		'speed'     => [40, 50],
		'defense'   => [30, 50],
		'luck'      => [10, 30]
	];
	
	public function testIsAlive()
	{
		$mock = $this->getMockBuilder(Character::Class)
				->setConstructorArgs([$this->stats, ''])
				->getMockForAbstractClass();
		
		$zeroHealth = 0;
		$mock->setHealth($zeroHealth);
		$this->assertFalse($mock->isAlive());

		$positiveHeath = 10;
		$mock->setHealth($positiveHeath);
		$this->assertTrue($mock->isAlive());
	}

	public function testType()
	{
		$type = "Type";

		$mock = $this->getMockBuilder(Character::Class)
				->setConstructorArgs([$this->stats, $type])
				->getMockForAbstractClass();
		$this->assertEquals($type, $mock->getType());
	}

	public function testHealthGreaterOrEqualToZero()
	{
		$negativeHealth = -10;

		$mock = $this->getMockBuilder(Character::Class)
				->setConstructorArgs([$this->stats, ''])
				->getMockForAbstractClass();

		$mock->setHealth($negativeHealth);
		$this->assertEquals(0, $mock->getHealth());
	}

	public function testDamageGreaterOrEqualToZero()
	{
		$negativeDamage = -10;

		$mock = $this->getMockBuilder(Character::Class)
				->setConstructorArgs([$this->stats, ''])
				->getMockForAbstractClass();
		$mock->setDamage($negativeDamage);
		$this->assertEquals(0, $mock->getDamage());

	}

	public function testEmptyStats()
	{	
		$this->setExpectedException(Exception::class, "The stats cannot be empty");

		$stats = [];
		$this->getMockBuilder(Character::Class)
				->setConstructorArgs([$stats, ''])
				->getMockForAbstractClass();
	}

	public function testStatsMissingValues()
	{
		$this->setExpectedException(Exception::class, "The minimum or maximum value is missing");

		$stats = [
			'health' 	=> [40],
			'strength'  => [70, 80],
			'speed'     => [40, 50],
			'defense'   => [],
			'luck'      => [10, 30]
		];
		$this->getMockBuilder(Character::Class)
				->setConstructorArgs([$stats, ''])
				->getMockForAbstractClass();
	}

	public function testStatsCorrectIntervals()
	{
		$this->setExpectedException(Exception::class, "The minimum cannot be greater than maximum");

		$stats = [
			'health' 	=> [100, 70],
			'strength'  => [70, 80],
			'speed'     => [40, 50],
			'defense'   => [30, 50],
			'luck'      => [10, 30]
		];
		$this->getMockBuilder(Character::Class)
				->setConstructorArgs([$stats, ''])
				->getMockForAbstractClass();
	}

	public function testStatsValuesNotEmpty()
	{
		$mock = $this->getMockBuilder(Character::Class)
						->setConstructorArgs([$this->stats, ''])
						->getMockForAbstractClass();

		$this->assertNotEmpty($mock->getHealth());
		$this->assertNotEmpty($mock->getStrength());
		$this->assertNotEmpty($mock->getSpeed());
		$this->assertNotEmpty($mock->getDefense());
		$this->assertNotEmpty($mock->getLuck());
	}

	public function testStatsValuesInRange()
	{
		$mock = $this->getMockBuilder(Character::Class)
						->setConstructorArgs([$this->stats, ''])
						->getMockForAbstractClass();

		$health = $mock->getHealth();
		$this->assertTrue($health >= $this->stats['health'][0]);
		$this->assertTrue($health <= $this->stats['health'][1]);

		$strength = $mock->getStrength();
		$this->assertTrue($strength >= $this->stats['strength'][0]);
		$this->assertTrue($strength <= $this->stats['strength'][1]);

		$speed = $mock->getSpeed();
		$this->assertTrue($speed >= $this->stats['speed'][0]);
		$this->assertTrue($speed <= $this->stats['speed'][1]);

		$defense = $mock->getDefense();
		$this->assertTrue($defense >= $this->stats['defense'][0]);
		$this->assertTrue($defense <= $this->stats['defense'][1]);

		$luck = $mock->getLuck();
		$this->assertTrue($luck >= $this->stats['luck'][0]);
		$this->assertTrue($luck <= $this->stats['luck'][1]);
	}
}