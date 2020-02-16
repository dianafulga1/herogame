<?php

use PHPUnit\Framework\TestCase;
use HeroGame\Characters\BeastFactory;
use HeroGame\Characters\Beast;
use HeroGame\Characters\CharacterFactory;

class BeastFactoryTest extends TestCase
{

	public function testCreate()
	{
		$beast = (new BeastFactory())->create();
		$this->assertInstanceOf(Beast::class, $beast);
	}

	public function testImplementsCharacterFactoryInterface()
	{
		$factory = new BeastFactory();
		$this->assertTrue($factory instanceof CharacterFactory);
	}

}