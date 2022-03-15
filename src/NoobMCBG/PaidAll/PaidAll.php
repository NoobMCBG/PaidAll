<?php

declare(strict_types=1);

namespace NoobMCBG\PaidAll;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use NoobMCBG\PaidAll\Economy;
use NoobMCBG\PaidAll\commands\PaidAllCommands;

class PaidAll extends PluginBase implements Listener {
	
	public $currency = [];

	public static $instance;

	public static function getInstance() : self {
		return self::$instance;
	}

	public function onEnable() : void {
		if($this->getServer()->getPluginManager()->getPlugin("BedrockEconomy") == null and $this->getServer()->getPluginManager()->getPlugin("EconomyAPI") == null){
			$this->getLogger()->error("Please download one of 2 plugins EconomyAPI or BedrockEconomy to operate this plugin !");
			$this->getServer()->getPluginManager()->disablePlugin($this);
		}
		if($this->getServer()->getPluginManager()->getPlugin("BedrockEconomy") !== null and $this->getServer()->getPluginManager()->getPlugin("EconomyAPI") == null){
			$this->getLogger()->notice("PaidAll main currency has been set to BedrockEconomy");
			$this->setDefaultCurrencyUnit(true, false);
		}
		if($this->getServer()->getPluginManager()->getPlugin("EconomyAPI") !== null and $this->getServer()->getPluginManager()->getPlugin("BedrockEconomy") == null){
			$this->getLogger()->notice("PaidAll main currency has been set to EconomyAPI");
			$this->setDefaultCurrencyUnit(false, true);
		}
		if($this->getServer()->getPluginManager()->getPlugin("EconomyAPI") !== null and $this->getServer()->getPluginManager()->getPlugin("BedrockEconomy") !== null){
			$this->getLogger()->notice("PaidAll main currency has been set to EconomyAPI and BedrockEconomy");
			$this->setDefaultCurrencyUnit(true, true);
		}
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
		$this->checkUpdate();
		$this->getServer()->getCommandMap()->register("PaidAll", new PaidAllCommands($this));
		self::$instance = $this;
	}
	
	public function setDefaultCurrencyUnit(bool $bedrockeconomy, bool $economyapi){
		unset($this->currency["BedrockEconomy"]);
		unset($this->currency["EconomyAPI"]);
		$this->currency["BedrockEconomy"] = $bedrockeconomy;
		$this->currency["EconomyAPI"] = $economyapi;
	}
	
	public function getDefaultCurrencyUnit(){
		return $this->currency;
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
