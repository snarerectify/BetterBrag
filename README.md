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
$manager = $instance->getDataSessionManager(); // returns an instance of the DataSessionManager class.

$session = $manager->getSession(string $name); // returns a DataSession instance if found, null if not.

$session->setRank(string $rank); // sets a players rank, the same can be done with prestige & blocks broken.

$session->getRank(); // returns the players rank, the same can be down with prestige & blocks broken.

$instance->getBraggingItem(Player $player); // returns Item instance if player is bragging, null if not.
```

## Setup
 - In order to utilise the block-requirement features for prestiging, the worlds in which players are mining in
 must have names a-z, being any single letter between a and z, this is to indicate that they are mines.
 - Occasionally the ScoreHud ceases to work, if this occurs, simply restart your server.

## Support
Reach out on discord `snare_gale` if having any issues or if you need help with configuration.
