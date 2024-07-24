<?php

declare(strict_types = 1);

namespace snare\BetterBrag\command\subCommand;

use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseSubCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use snare\BetterBrag\BetterBrag;
use snare\BetterBrag\inventory\BragInventory;

class BragViewSubCommand extends BaseSubCommand
{
    public function __construct()
    {
        parent::__construct(BetterBrag::getBetterBrag(), "view", "View the item a player is bragging about.");
    }

    /**
     * @throws ArgumentOrderException
     */
    public function prepare(): void
    {
        $this->setPermission("betterbrag.command.view");
        $this->registerArgument(0, new RawStringArgument("player"));
    }

    /**
     * @param CommandSender $sender
     * @param string $aliasUsed
     * @param array $args
     */
    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        if(!$sender instanceof Player) return;

        if(!isset($args["player"]) || ($player = BetterBrag::getBetterBrag()->getServer()->getPlayerExact($args["player"])) === null) {
            $sender->sendMessage(BetterBrag::getBetterBrag()->getConfig()->get("specify-valid-player"));
            return;
        }

        if(!BetterBrag::getBetterBrag()->isBragging($player)) {
            $sender->sendMessage(str_replace("{PLAYER}", $player->getName(), BetterBrag::getBetterBrag()->getConfig()->get("player-not-bragging")));
            return;
        }

        (new BragInventory($player, BetterBrag::getBetterBrag()->getBraggingItem($player)))->send($sender);
    }
}