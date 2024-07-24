<?php

declare(strict_types = 1);

namespace snare\BetterBrag\command\subCommand;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use snare\BetterBrag\BetterBrag;

class BragStopSubCommand extends BaseSubCommand
{
    public function __construct()
    {
        parent::__construct(BetterBrag::getBetterBrag(), "stop", "Stop bragging about the item you are currently bragging about.");
    }

    public function prepare(): void
    {
        $this->setPermission("betterbrag.command.stop");
    }

    /**
     * @param CommandSender $sender
     * @param string $aliasUsed
     * @param array $args
     */
    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        if(!$sender instanceof Player) return;

        if(!BetterBrag::getBetterBrag()->stopBragging($sender)) {
            $sender->sendMessage(BetterBrag::getBetterBrag()->getConfig()->get("not-bragging"));
        } else {
            $sender->sendMessage(BetterBrag::getBetterBrag()->getConfig()->get("stopped-bragging"));
        }
    }
}