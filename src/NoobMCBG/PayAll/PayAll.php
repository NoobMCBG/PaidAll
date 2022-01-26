<?php

declare(strict_types=1);

namespace NoobMCBG\PayAll;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use onebone\economyapi\EconomyAPI;
use NoobMCBG\PayAll\commands\PayAllCommands;

class PayAll extends PluginBase implements Listener {

	public static $instance;

	public static function getInstance() : self {
		return self::$instance;
	}

	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
		$this->getServer()->getCommandMap()->register("PayAll", new PayAllCommands($this));
		$this->checkUpdate();
		self::$instance = $this;
	}
	
	public function checkUpdate(bool $isRetry = false) : void {
            $this->getServer()->getAsyncPool()->submitTask(new CheckUpdateTask($this->getDescription()->getName(), $this->getDescription()->getVersion()));
        }

	public function payAll($money){
	    if(is_numeric($money)){
                foreach($this->getServer()->getOnlinePlayers() as $player){
            	    if($player instanceof Player){
            		$count = count($this->getServer()->getOnlinePlayers());
            		$amount = $money/$count;
            		EconomyAPI::getInstance()->addMoney($player, $amount);
            	    }
                }
            }
	}
}
