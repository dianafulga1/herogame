<?php

use PHPUnit\Framework\TestCase;
use HeroGame\Skills\SkillFactory;
use HeroGame\Skills\RapidStrikeFactory;
use HeroGame\Skills\RapidStrike;

class RapidStrikeFactoryTest extends TestCase
{

	public function testCreate()
	{
		$RapidStrike = (new RapidStrikeFactory())->create();
		$this->assertInstanceOf(RapidStrike::class, $RapidStrike);
	}

	public function testImplementsSkillFactoryInterface()
	{
		$factory = new RapidStrikeFactory();
		$this->assertTrue($factory instanceof SkillFactory);
	}

}