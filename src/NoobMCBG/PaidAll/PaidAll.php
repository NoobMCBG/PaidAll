<?php

declare(strict_types=1);

namespace NoobMCBG\PaidAll;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use NoobMCBG\PaidAll\libs\YTBJero\LibEconomy\Economy;
use NoobMCBG\PaidAll\commands\PaidAllCommands;

class PaidAll extends PluginBase implements Listener {

	public static $instance;

	public static function getInstance() : self {
		return self::$instance;
	}

	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
		$this->checkUpdate();
		$this->getServer()->getCommandMap()->register("PaidAll", new PaidAllCommands($this));
		self::$instance = $this;
	}
	
	public function checkUpdate(bool $isRetry = false) : void {
            $this->getServer()->getAsyncPool()->submitTask(new CheckUpdateTask($this->getDescription()->getName(), $this->getDescription()->getVersion()));
        }

	public function paidAll($money){
	    if(is_numeric($money)){
               foreach($this->getServer()->getOnlinePlayers() as $player){
            	   if($player instanceof Player){
            	       $count = count($this->getServer()->getOnlinePlayers());
            	       $amount = $money/$count;
		       Economy::addMoney($player, $amount);
            	   }
               }
            }
	}
}
