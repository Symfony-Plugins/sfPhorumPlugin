<?php

if (sfConfig::get('app_sfPhorum_routes_register', true) && in_array('sfPhorumForum', sfConfig::get('sf_enabled_modules')))
{
  $r = sfRouting::getInstance();
  $r->prependRoute('sf_phorum_forum', '/phorum', array('module' => 'sfPhorumForum', 'action' => 'index'));
  $r->prependRoute('sf_phorum_css', '/phorum_css', array('module' => 'sfPhorumForum', 'action' => 'css'));
}

