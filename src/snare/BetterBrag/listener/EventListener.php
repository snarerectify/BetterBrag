<?php

declare(strict_types = 1);

namespace snare\BetterBrag\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use snare\BetterBrag\BetterBrag;

class EventListener implements Listener
{
    /**
     * @param PlayerQuitEvent $event
     */
    public function onLeave(PlayerQuitEvent $event) : void
    {
        BetterBrag::getBetterBrag()->stopBragging($event->getPlayer());
    }
}