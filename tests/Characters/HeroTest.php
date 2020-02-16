<?php

use PHPUnit\Framework\TestCase;
use HeroGame\Characters\BeastFactory;
use HeroGame\Characters\Beast;
use HeroGame\Characters\HeroFactory;
use HeroGame\Characters\Hero;

class HeroTest extends TestCase
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
		$hero = new Hero($this->stats);
		$this->assertEquals($hero->getType(), 'Hero');
	}

	public function testSkills()
	{
		$hero = new Hero($this->stats);
		$reflector = new ReflectionClass(Hero::class);
		$property = $reflector->getProperty('skills');
		$property->setAccessible(true);
		$value = $property->getValue($hero);

		$this->assertEquals(count($value), 2);
	}
}
