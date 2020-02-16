<?php

use PHPUnit\Framework\TestCase;
use HeroGame\Characters\Character;
use HeroGame\Game;

class GameTest extends TestCase
{
	private $stats = [
		'health' 	=> [70, 100],
		'strength'  => [50, 50],
		'speed'     => [40, 50],
		'defense'   => [30, 50],
		'luck'      => [10, 20]
	];

	public function testAttackerAndDefenderNotNull()
	{
		$game = new Game();
		$reflector = new ReflectionClass(Game::class);
		$propertyAttacker = $reflector->getProperty('attacker');
		$propertyAttacker->setAccessible(true);
		$propertyDefender = $reflector->getProperty('defender');
		$propertyDefender->setAccessible(true);

		$this->assertNotNull($propertyAttacker->getValue($game));
		$this->assertNotNull($propertyDefender->getValue($game));
	}

	public function testIsOver()
	{
		$game = new Game();
		$attacker = $this->getMockBuilder(Character::Class)
				->setConstructorArgs([$this->stats, ''])
				->getMockForAbstractClass();
		$attacker->setHealth(0);
		$reflector = new ReflectionClass(Game::class);
		$property = $reflector->getProperty('attacker');
		$property->setAccessible(true);
		$property->setValue($game, $attacker);

		$reflector = new ReflectionClass(Game::class);
		$method = $reflector->getMethod('isOver');
		$method->setAccessible(true);
		$result = $method->invoke($game);

		$this->assertTrue($result);
	}
}