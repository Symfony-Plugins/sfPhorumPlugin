<?php

class sfPhorumForumActions extends sfActions
{
  public function executeIndex()
  {
    $this->forum = $this->getConnector();
    $this->getResponse()->setTitle($this->forum->getPageTitle());
    $css_url = $this->getContext()->getController()->genUrl('@sf_phorum_css', true);
    $this->getResponse()->addStylesheet($css_url);
  }

  public function executeCss()
  {
    $connector = $this->getConnector();
    $this->getResponse()->setContentType('text/css');
    $this->getResponse()->setContent( $connector->getCss() );
    return sfView::NONE;
  }

  public function getConnector()
  {
    if (!sfConfig::get('app_sfPhorum_vendor_dir'))
    {
      throw new sfException('You must define app_sfPhorum_vendor_dir');
    }
    global $PHORUM_CONNECTOR;
    $PHORUM_CONNECTOR = new sfPhorumPluginConnector();
    include sfConfig::get('app_sfPhorum_vendor_dir') . "/mods/embed_phorum/run_phorum.php";
    return $PHORUM_CONNECTOR;
  }
}
