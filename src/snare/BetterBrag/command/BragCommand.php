<?php

namespace snare\BetterBrag\command;

use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;
use snare\BetterBrag\BetterBrag;
use snare\BetterBrag\command\subCommand\BragListSubCommand;
use snare\BetterBrag\command\subCommand\BragStartSubCommand;
use snare\BetterBrag\command\subCommand\BragStopSubCommand;
use snare\BetterBrag\command\subCommand\BragViewSubCommand;

class BragCommand extends BaseCommand implements PluginOwned
{
    use PluginOwnedTrait;

    public function __construct()
    {
        parent::__construct(BetterBrag::getBetterBrag(), "brag", "Brag management command.");
        $this->setPermission("betterbrag.brag.command");
    }

    /**
     * @param CommandSender $sender
     * @param string $aliasUsed
     * @param array $args
     */
    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        $this->sendUsage();
    }

    public function prepare() : void
    {
        $this->registerSubCommand(new BragListSubCommand());
        $this->registerSubCommand(new BragStartSubCommand());
        $this->registerSubCommand(new BragStopSubCommand());
        $this->registerSubCommand(new BragViewSubCommand());
    }

    /**
     * @return Plugin
     */
    public function getOwningPlugin(): Plugin
    {
        return BetterBrag::getBetterBrag();
    }
}