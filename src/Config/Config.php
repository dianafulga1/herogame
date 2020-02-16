<?php

namespace HeroGame\Config;

class Config {

	const HERO_STATS = [
		'health' => [70, 100],
		'strength' => [70, 80],
		'defense' => [45, 55],
		'speed' => [40, 50],
		'luck' => [10, 30]
	];

	const BEAST_STATS = [
		'health' => [60, 90],
		'strength' => [60, 90],
		'defense' => [40, 60],
		'speed' => [40, 60],
		'luck' => [25, 40]
	];

	const ROUNDS = 20;

	const SKILL_RAPIDSTRIKE = [
		'chance' => 10,
		'attack' => true,
		'defense' => false
	];

	const SKILL_MAGICSHIELD = [
		'chance' => 20,
		'attack' => false,
		'defense' => true
	];

}