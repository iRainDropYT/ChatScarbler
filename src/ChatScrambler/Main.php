<?php

namespace ChatScrambler;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\{Utils, Config, TextFormat};
use pocketmine\math\Vector3;
use pocketmine\{Player, Server};
use pocketmine\level\Level;
use pocketmine\event\player\PlayerChatEvent;

	class Main extends PluginBase implements Listener{
		
		public $config;
		public $win = null;
		public $price = null;
		public $economy;
		
		/*
		This plugin has been updated to API: 3.0.0
		By: ArceusMatt
		*/
		
		public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
		$this->economy = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$this->getLogger()->info("Version: 1.0.0 for API: 3.0.0");
		$this->config = $this->getConfig();
		$this->getScheduler()->scheduleDelayedTask(new RTask($this), (20 * 60 * ($this->config->get("minutes-to-scramble"))));
		}
		
		public function onChat(PlayerChatEvent $e){
		$msg = $e->getMessage();
		$p = $e->getPlayer();
		
		if($this->win != null && $this->price != null){
			if($msg == $this->win){
				$this->getServer()->broadcastMessage("§b". $p->getName() ."§a unscrambled the word: §e". $this->win ." §aand won $". $this->price);
				$this->economy->addMoney($p->getName(), $this->price);
				$this->win = null;
				$this->price = null;
				$e->setCancelled();
				}
			}
		}
	
	}
