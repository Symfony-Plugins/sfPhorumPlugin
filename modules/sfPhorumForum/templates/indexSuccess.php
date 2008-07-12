<?php
  echo $forum->getPageBody();

  slot('sfPhorum');
    echo $forum->elements["rss_link"];
  end_slot();

?>
