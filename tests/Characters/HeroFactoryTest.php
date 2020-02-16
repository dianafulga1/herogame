<?php

use PHPUnit\Framework\TestCase;
use HeroGame\Characters\CharacterFactory;
use HeroGame\Characters\HeroFactory;
use HeroGame\Characters\Hero;

class HeroFactoryTest extends TestCase
{

	public function testCreate()
	{
		$hero = (new HeroFactory())->create();
		$this->assertInstanceOf(Hero::class, $hero);
	}

	public function testImplementsCharacterFactoryInterface()
	{
		$factory = new HeroFactory();
		$this->assertTrue($factory instanceof CharacterFactory);
	}

}