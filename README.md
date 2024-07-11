# BetterBrag

Advanced bragging plugin for Pocketmine-MP.

## Features
 - GUI Based bragging system.
 - Commands for commencing and ending brags.
 - Ability to list all other ongoing brags.

# Installation
 1. Download plugin phar from [here](https://poggit.pmmp.io/ci/snarerectify/BetterBrag/~)
 2. Add to your servers' plugin folder.
 3. Restart server.

## Commands

| Command                                           | Description                                                   | Permission         |                                                             
|---------------------------------------------------|---------------------------------------------------------------|--------------------|
| /brag                                             | Brag management command.                                      | brag.command       | 
| /brag start                                       | Start bragging about the item within your hand.               | brag.command.start |                           
| /brag stop                                        | Stop bragging about the item you are currently bragging about.| brag.command.stop  |                 
| /brag list                                        | List all current bragging players & corresponding items.      | brag.command.list  |                                                 
| /brag view <player>                               | View the item a player is bragging about.                     | brag.command.view  |

## API
To obtain an instance of this plugin's main class:
```php
use snare\BetterBrag\BetterBrag;

$instance = BetterBrag::getBetterBrag();
```

Various methods can be found below:
```php
$instance->getBragItems(); // returns an array with player name as key, Item instance as value.

$instance->isBragging(Player $player); returns true or false depending on whether or not the specified player is bragging.

$instance->startBragging(Player $player); causes the specified player to brag about the item in their hand.

$instance->stopBragging(Player $player); returns true if able to stop playing bragging, false if not.

$instance->getBraggingItem(Player $player); returns Item instance if player is bragging, null if not.
```

## Support
Reach out on discord `snare_gale` if having any issues or if you need help with configuration.
