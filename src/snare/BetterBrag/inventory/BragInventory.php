<?php

declare(strict_types = 1);

namespace snare\BetterBrag\inventory;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\item\Item;
use pocketmine\player\Player;
use snare\BetterBrag\BetterBrag;

class BragInventory extends InvMenu
{
    /**
     * @param Player $player
     * @param Item $item
     */
    public function __construct(Player $player, Item $item)
    {
        parent::__construct(InvMenuHandler::getTypeRegistry()->get(self::TYPE_HOPPER));
        $this->setName(str_replace(["{PLAYER}", "{ITEM}"], [$player->getName(), $item->getName()], BetterBrag::getBetterBrag()->getConfig()->get("brag-inventory-name")));
        $this->getInventory()->setItem(2, $item);
        $this->setListener(self::readonly());
    }
}