<?php

namespace snare\BetterBrag\command\subCommand;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use snare\BetterBrag\BetterBrag;

class BragListSubCommand extends BaseSubCommand
{
    public function __construct()
    {
        parent::__construct("list", "List all current bragging players & corresponding items.");
    }

    public function prepare(): void
    {
        $this->setPermission("brag.command.list");
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        if(empty(BetterBrag::getBetterBrag()->getBragItems())) {
            $sender->sendMessage(BetterBrag::getBetterBrag()->getConfig()->get("no-items-bragged"));
            return;
        }

        $sender->sendMessage(BetterBrag::getBetterBrag()->getConfig()->get("bragging-list-title"));

        foreach (BetterBrag::getBetterBrag()->getBragItems() as $id => $item) {
            $sender->sendMessage(str_replace(["{PLAYER}", "{ITEM}"], [BetterBrag::getBetterBrag()->getServer()->getPlayerByRawUUID($id)->getName(), $item->getName()], BetterBrag::getBetterBrag()->getConfig()->get("brag-entry")));
        }
    }

}