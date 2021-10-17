<?php

namespace Electro\TellRaw;

use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;


class TellRaw extends PluginBase implements Listener{

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch($command->getName()) {
            case "tellraw":
                if (!$sender->hasPermission("tellraw.cmd")){
                    $sender->sendMessage("§cYou do not have permissions to use this command");
                    return true;
                }
                if (!isset($args[0])){
                    $sender->sendMessage("§l§cUsage: §r§a/tellraw <player> <message>");
                    return true;
                }
                if (!isset($args[1])){
                    $sender->sendMessage("§l§cUsage: §r§a/tellraw <player> <message>");
                    return true;
                }

                if ($args[0] === "all")
                {
                    $this->getServer()->broadcastMessage(implode(" ", array_slice($args, 1, 1000)));
                    return true;
                }

                if (!$this->getServer()->getPlayer($args[0]) instanceof Player) {
                    $sender->sendMessage("§l§cERROR: §r§aYou have entered an invalid Player Username.");
                    return true;
                }

                $player = $this->getServer()->getPlayer($args[0]);
                $player->sendMessage(implode(" ", array_slice($args, 1, 1000)));
        }

        return true;
    }

}
