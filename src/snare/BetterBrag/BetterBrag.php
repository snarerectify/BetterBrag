<?php

declare(strict_types = 1);

namespace snare\BetterBrag;

use CortexPE\Commando\exception\HookAlreadyRegistered;
use CortexPE\Commando\PacketHooker;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use snare\BetterBrag\command\BragCommand;
use snare\BetterBrag\listener\EventListener;

class BetterBrag extends PluginBase
{
    /** @var BetterBrag */
    private static BetterBrag $betterBrag;

    /** @var Item[] */
    private array $bragItems;

    public function onLoad(): void
    {
        self::$betterBrag = $this;
    }

    /**
     * @throws HookAlreadyRegistered
     */
    public function onEnable(): void
    {
        if(!PacketHooker::isRegistered()) PacketHooker::register($this);
        if(!InvMenuHandler::isRegistered()) InvMenuHandler::register($this);

        $this->saveDefaultConfig();

        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->getServer()->getCommandMap()->register("BetterBrag", new BragCommand());
    }

    /**
     * @return BetterBrag
     */
    public static function getBetterBrag() : BetterBrag
    {
        return self::$betterBrag;
    }

    /**
     * @return Item[]
     */
    public function getBragItems() : array
    {
        return $this->bragItems;
    }

    /**
     * @param Player $player
     * @return bool
     */
    public function isBragging(Player $player) : bool
    {
        return isset($this->bragItems[$player->getUniqueId()->toString()]);
    }

    /**
     * @param Player $player
     */
    public function startBragging(Player $player) : void
    {
        $this->bragItems[$player->getUniqueId()->toString()] = $player->getInventory()->getItemInHand();
    }

    /**
     * @param Player $player
     * @return bool
     */
    public function stopBragging(Player $player) : bool
    {
        if($this->isBragging($player)) {
            unset($this->bragItems[$player->getUniqueId()->toString()]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param Player $player
     * @return Item|null
     */
    public function getBraggingItem(Player $player) : ?Item
    {
        return $this->isBragging($player) ? $this->bragItems[$player->getUniqueId()->toString()] : null;
    }
}