<?php

namespace ChatScrambler;

use pocketmine\scheduler\Task;
use pocketmine\Server;

	class RTask extends Task{
	
		public function __construct($plugin){
		$this->plugin = $plugin;
		}
		
		public function onRun($ticks){
		$key = array_rand($this->plugin->config->get("scramble-words"));
		$word = $this->plugin->config->get("scramble-words")[$key];
		$this->plugin->win = $word;
		$price = mt_rand($this->plugin->config->get("min-price"), $this->plugin->config->get("max-price"));
		$this->plugin->price = $price;
		$this->plugin->getServer()->broadcastMessage("§b» Unscramble the word below by typing it in chat!\n\n» Word: §e". str_shuffle($word) ."\n\n§b» First player who can unscramble it gets $". $price ." in-game money!");
		$this->plugin->getScheduler()->scheduleDelayedTask(new RTask($this->plugin), (20 * 60 * ($this->plugin->config->get("minutes-to-scramble"))));
		}
		
	}
