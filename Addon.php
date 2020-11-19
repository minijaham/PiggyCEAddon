<?php

namespace //;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\item\Item;
use pocketmine\command\ConsoleCommandSender;
use DaPigGuy\PiggyCustomEnchants\CustomEnchantManager;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchantIds;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Addon implements Listener {

public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents(($this), $this);
    }
public function itemHeld(PlayerItemHeldEvent $event) {
    $item = $event->getItem();
    $player = $event->getPlayer();
    foreach ($event->getItem()->getEnchantments() as $enchantmentInstance) {
        $enchantment = $enchantmentInstance->getType();
        if ($event->getItem()->getId() === 403 && $enchantment instanceof CustomEnchant) {
                $enchant = CustomEnchantManager::getEnchantmentByName($enchantment->getDisplayName());
                $lore = [
                        " ",
                        TextFormat::RESET . TextFormat::YELLOW . $enchant->getDescription()
                        ];
                        if ($event->getItem()->getLore() !== $lore){ 
                            $player->getInventory()->removeItem($item);
                            $item = $event->getItem()->setLore($lore);
                            $player->getInventory()->addItem($item);
                        }
                    }
                }
            }
