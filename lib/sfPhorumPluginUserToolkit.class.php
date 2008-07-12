<?php

  class sfPhorumPluginUserToolkit
  {
    public static function SyncUser($syncuser)
    {
      global $PHORUM;
      // FIXME: fix paths
      require_once (dirname(__FILE__) . "/vendor/phorum/mods/embed_phorum/syncuser.php");
      require_once (dirname(__FILE__) . "/vendor/phorum/include/users.php");
//        require_once (dirname(__FILE__) . "/vendor/phorum/include/cache/file.php");
      embed_phorum_syncuser($syncuser);
      return $syncuser['user_id'];
    }
  }
