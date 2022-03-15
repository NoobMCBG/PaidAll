<?php 

declare(strict_types=1);

namespace NoobMCBG\PaidAll\libs\YTBJero\LibEconomy;

use pocketmine\Server as PMServer;
use pocketmine\player\Player;

final class Economy {

	private const ECONOMYAPI = "EconomyAPI";
	
	private const BEDROCKECONOMYAPI = "BedrockEconomyAPI";

	/**
	 * @return array
	 */
	private function getEconomy(): array{
		$api = PMServer::getInstance()->getPluginManager()->getPlugin("EconomyAPI");
		if($api !== null){
			return [self::ECONOMYAPI, $api];
		} else{
			$api = PMServer::getInstance()->getPluginManager()->getPlugin("BedrockEconomy");
			if($api !== null){
				return [self::BEDROCKECONOMYAPI, $api];
			}
		}
        	throw new \Exception("You not have economy plugin.");
	}
	/**
	 * @param  Player $player
	 */
	public static function myMoney(Player $player){
		if($this->getEconomy()[0] === self::ECONOMYAPI){
			return $this->getEconomy()[1]->myMoney($player);
		} elseif($this->getEconomy()[0] === self::BEDROCKECONOMYAPI){
			return $this->getEconomy()[1]->getAPI()->getPlayerBalance($player->getName());
		}
	}
	/**
	 * @param Player $player
	 * @param int $amount
	 */
	public static function addMoney(Player $player, $amount){
		if($this->getEconomy()[0] === self::ECONOMYAPI){
			$this->getEconomy()[1]->addMoney($player, $amount);
		} elseif($this->getEconomy()[0] === self::BEDROCKECONOMYAPI){
			return $this->getEconomy()[1]->getAPI()->addToPlayerBalance($player->getName(), (int) ceil($amount));
		}
	}
	/**
	 * @param  Player $player
	 * @param  int $amount
	 */
	public static function reduceMoney(Player $player, $amount){
		if($this->getEconomy()[0] === self::ECONOMYAPI){
			$this->getEconomy()[1]->reduceMoney($player, $amount);
		} elseif($this->getEconomy()[0] === self::BEDROCKECONOMYAPI){
			return $this->getEconomy()[1]->getAPI()->subtractFromPlayerBalance($player->getName(), (int) ceil($amount));
		}
	}
}
