<?php

declare(strict_types = 1);

namespace snare\BetterBrag\command\subCommand;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\block\BlockTypeIds;
use pocketmine\command\CommandSender;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use snare\BetterBrag\BetterBrag;

class BragStartSubCommand extends BaseSubCommand
{
    public function __construct()
    {
        parent::__construct(BetterBrag::getBetterBrag(), "start", "Start bragging about the item within your hand.");
    }

    public function prepare() : void
    {
        $this->setPermission("betterbrag.command.start");
    }

    /**
     * @param CommandSender $sender
     * @param string $aliasUsed
     * @param array $args
     */
    public function onRun(CommandSender $sender, string $aliasUsed, array $args) : void
    {
        if(!$sender instanceof Player) return;

        if($sender->getInventory()->getItemInHand()->getTypeId() === VanillaItems::AIR()->getTypeId()) {
            $sender->sendMessage(BetterBrag::getBetterBrag()->getConfig()->get("empty-hand"));
            return;
        }

        BetterBrag::getBetterBrag()->stopBragging($sender);
        BetterBrag::getBetterBrag()->startBragging($sender);

        $sender->sendMessage(str_replace("{ITEM}", $sender->getInventory()->getItemInHand()->getName(), BetterBrag::getBetterBrag()->getConfig()->get("started-bragging")));

        if(BetterBrag::getBetterBrag()->getConfig()->get("broadcast-brag") === true) {
            BetterBrag::getBetterBrag()->getServer()->broadcastMessage(str_replace(["{ITEM}", "{PLAYER}"], [$sender->getInventory()->getItemInHand()->getName(), $sender->getName()], BetterBrag::getBetterBrag()->getConfig()->get("brag-broadcast-message")));
        }
    }
}