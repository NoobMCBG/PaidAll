<?php

declare(strict_types=1);

namespace NoobMCBG\PaidAll;

use pocketmine\player\Player;
use cooldogedev\BedrockEconomy\api\BedrockEconomyAPI;
use onebone\economyapi\EconomyAPI;
use NoobMCBG\PaidAll\PaidAll;

class Economy {

    public static function addMoney(Player $player, int $amount){
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["BedrockEconomy"] == true){
            BedrockEconomyAPI::getInstance()->addToPlayerBalance($player->getName(), (int)$amount);
        }
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["EconomyAPI"] == true){
            EconomyAPI::getInstance()->addMoney($player, (int)$amount);
        }
    }

    public static function reduceMoney(Player $player, int $amount){
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["BedrockEconomy"] == true){
            BedrockEconomyAPI::getInstance()->subtractFromPlayerBalance($player->getName(), (int)$amount);
        }
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["EconomyAPI"] == true){
            EconomyAPI::getInstance()->reduceMoney($player, (int)$amount);
        }
    }

    public static function myMoney(Player $player){
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["BedrockEconomy"] == true){
            return BedrockEconomyAPI::getInstance()->getPlayerBalance($player->getName());
        }
        if(PaidAll::getInstance()->getDefaultCurrencyUnit()["EconomyAPI"] == true){
            return EconomyAPI::getInstance()->myMoney($player);
        }
    }
}
