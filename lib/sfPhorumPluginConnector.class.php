<?php

class sfPhorumPluginConnector extends PhorumConnectorBase
{
    var $name = "symfony_connector";

    public $elements = array();

    function get_template()
    {
        return "embed_default";
    }

    // Return the user_id for the logged in user.
    function get_user_id()
    {

      $user = sfContext::getInstance()->getUser();
      // if the user is currently logged in
      // create the profile
      if ($user->isAuthenticated())
      {
        if (sfConfig::get('app_sfPhorum_auto_usersync', true))
        {
          $syncuser = array(
            'user_id' => $user->getGuardUser()->getId(),
            'username' => $user->getGuardUser()->getUsername(),
            'real_name' => 'FIXME',
            'email'     => 'FIXME@FIXME.com',
            'admin'     => true,
          );
          sfPhorumPluginUserToolkit::SyncUser($syncuser);
        }
        return $user->getGuardUser()->getId();
      }

      return null;
    }

    // Setup Phorum's page elements in the master templating system.
    function process_page_elements($elements)
    {
      $this->elements = $elements;
    }

    // Return an array of user fields that may be edited through
    // Phorum's user control center.
    function get_slave_fields()
    {
      $defaults = array (
        // "real_name",
        "signature",
        // "email",
        "hide_email",
        "hide_activity",
        "moderation_email",
        "tz_offset",
        "is_dst",
        "user_language",
        "user_template",
        "threaded_list",
        "threaded_read",
        "email_notify",
        "show_signature",
        "pm_email_notify",
      );
      $ret = sfConfig::get('app_sfPhorum_slave_fields', $defaults);
      return $ret;
    }

    /**
     * added for symfony
     */
    public function getPageBody()
    {
      return  $this->elements['body_data'];
    }

    /**
     * added for symfony
     */
    public function getPageTitle()
    {
      return $this->elements['title'];
    }

    /**
     * added for symfony
     */
    public function getCss()
    {
      return preg_replace('#<style type="text/css">(.*)</style>#ms', '$1', $this->elements['style']);
    }

}

