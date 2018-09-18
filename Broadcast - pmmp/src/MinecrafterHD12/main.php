<?php
namespace MinecrafterHD12;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmien\event\player\PlayerJoinEvent;
use pocketmien\event\player\PlayerQuitEvent;
use pocketmine\scheduler\Task;
use pocketmine\utils\Config;

class main extends PluginBase implements Listener {

    public $prefix = "§3 Rewinside §7|§f";

  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->initConfig();
    
    $config = new Config($this->getServer()->getDataPath()."/plugins/Broadcast/broadcast.yml");
    $repeating = $config->get("Timer") * 20;
    $this->getServer()->getScheduler()->scheduleRepeatingTask(new caster($this),$repeating);
  }

  public function onJoin(PlayerJoinEvent event) {

    $event->setJoinMessage(null)

} 

public function onJoin(PlayerQuitEvent event) {

    $event->setQuitMessage(null)

} 
  
  public function initConfig(){
    @mkdir($this->getServer()->getDataPath()."/plugins/Broadcast");
    $config = new Config($this->getServer()->getDataPath()."/plugins/Broadcast/broadcast.yml");
    if(!$config->exists("Prefix")){
      $config->set("Timer", "60");
      $config->set("Broadcast", ["Test"]);
      $config->save();
    }
  }
}

class caster extends Task {
  public $allBroadcast = array();
  public $prefix = "§3 Rewinside §7|§f";
  
  public function __construct($plugin){
    $this->plugin = $plugin;
    parent::__construct($plugin);
  }
  
  public function onRun($tick){
    $config = new Config($this->plugin->getDataFolder()."broadcast.yml");
    $allBroadcast = $config->get("Broadcast");
    
    $broadcast = array_rand($allBroadcast);
    $this->plugin->getServer()->broadcastMessage($this->plugin->prefix . " " . $allBroadcast[$broadcast]);
  }
}