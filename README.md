<div align="center">
<h1>PayAll | v1.0.0<h1>
</div>
<p align="center">
<br>
✔️ Pay money to all people online ✔️
</p>

<br>

## Features
- Pay money to all people online

<br>
  
## Commands
| **Commands** | **Description** | **Aliases** |
| --- | --- | --- |
| **/payall** | **Commands paid all players online** | **/pa** |

<br>
  
## Permissions
| **Permission** | **Description** | **Default** |
| --- | --- | --- |
| **`payall.pay`** | **Permission use commands /payall** | **true** |

<br>

## Config
```
---
#   ░██████╗░░█████╗░██╗░░░██╗░█████╗░██╗░░░░░██╗░░░░░
#   ░██╔══██╗██╔══██╗╚██╗░██╔╝██╔══██╗██║░░░░░██║░░░░░
#   ░██████╔╝███████║░╚████╔╝░███████║██║░░░░░██║░░░░░
#   ░██╔═══╝░██╔══██║░░╚██╔╝░░██╔══██║██║░░░░░██║░░░░░
#   ░██║░░░░░██║░░██║░░░██║░░░██║░░██║███████╗███████╗
#   ░╚═╝░░░░░╚═╝░░╚═╝░░░╚═╝░░░╚═╝░░╚═╝╚══════╝╚══════╝

# Message Paid Successfully
# Use {money} to show the amount that player paid
paid-successfully:
  msg: true # false = disable, true = enable;
  msg-paid-successfully: "§a> You have just paid {money} money to all players"

# Broadcast Message Paid
# Use {player} to get the name of the person who paid for the whole server
# Use {money} to show the amount that player paid
broadcast-paid:
  broadcast: true # false = disable, true = enable;
  msg-broadcast-paid: "§a> player {player} just paid everyone {money}$ money !"

# Message Paid Fallied
# Use {price} to show the additional amount to pay
paid-fallied:
  msg: true # false = disable, true = enable;
  msg-paid-fallied: "You need more {price}$ money to paid all players"
...
```
  
<br>

## For Developer
- You can access to PayAll by using `PayAll::getInstance()`
- PayAll Usage:
```php
$money = 1000;
PayAll::getInstance()->payAll($money);
```

<br>

## Install
- Step 1: Click the "Direct Download" button to download the plugin
- Step 2: move the file "PayAll.phar" into the file "plugins"
- Step 3: Restart server for plugins to work

