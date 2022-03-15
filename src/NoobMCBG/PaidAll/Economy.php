<?php

declare(strict_types=1);

namespace NoobMCBG\PaidAll;

use pocketmine\player\Player;
use pocketmine\Server;
use NoobMCBG\PaidAll\PaidAll;

class Economy {

    public static function addMoney(Player $player, int $amount){
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["BedrockEconomy"] == true){
            Server::getInstance()->getPluginManager()->getPlugin("BedrockEconomy")->getAPI()->addToPlayerBalance($player->getName(), (int)$amount);
        }
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["EconomyAPI"] == true){
            Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI")->getAPI()->addMoney($player, (int)$amount);
        }
    }

    public static function reduceMoney(Player $player, int $amount){
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["BedrockEconomy"] == true){
            Server::getInstance()->getPluginManager()->getPlugin("BedrockEconomy")->getAPI()->subtractFromPlayerBalance($player->getName(), (int)$amount);
        }
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["EconomyAPI"] == true){
            Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI")->getAPI()->reduceMoney($player, (int)$amount);
        }
    }

    public static function reduceMoney(Player $player){
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["BedrockEconomy"] == true){
            return Server::getInstance()->getPluginManager()->getPlugin("BedrockEconomy")->getAPI()->getPlayerBalance($player->getName());
        }
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["EconomyAPI"] == true){
            return Server::getInstance()->getPluginManager()->getPlugin("EconomyAPI")->getAPI()->myMoney($player);
        }
    }
}
