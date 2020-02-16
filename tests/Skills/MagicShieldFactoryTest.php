<?php

use PHPUnit\Framework\TestCase;
use HeroGame\Skills\MagicShieldFactory;
use HeroGame\Skills\MagicShield;
use HeroGame\Skills\SkillFactory;

class MagicShieldFactoryTest extends TestCase
{
	public function testCreate()
	{
		$beast = (new MagicShieldFactory())->create();
		$this->assertInstanceOf(MagicShield::class, $beast);
	}

	public function testImplementsSkillFactoryInterface()
	{
		$factory = new MagicShieldFactory();
		$this->assertTrue($factory instanceof SkillFactory);
	}
}