<?php

$settings = get_option('settings', $params['id']);

$defaults = array(
    'title' => '',
    'icon'  => ''
);

$json = json_decode($settings, true);
if ($json==false){
    print lnotif("Click to edit tabs");

    return;
}

if (isset($json)==false or count($json)==0){
    $json = array(0 => $defaults);
}


?>
<script>
    $(document).ready(function () {
        mw.tabs({
            nav: '#mw-tabs-module-<?php print $params['id'] ?> .mw-ui-btn-nav-tabs a',
            tabs: '#mw-tabs-module-<?php print $params['id'] ?> .mw-ui-box-tab-content'
        });
    });
</script>

<div id="mw-tabs-module-<?php print $params['id'] ?>"
     class="mw-tabs-box-wrapper mw-module-tabs-skin-default">
  <div class="mw-ui-btn-nav mw-ui-btn-nav-tabs">
    <?php
        $count = 0;
        foreach ($json as $slide) {
            $count ++;


            ?>
    <a class="mw-ui-btn <?php if ($count==1){ ?> active <?php } ?>"
               href="javascript:;"><span class="fa <?php print $slide['icon']; ?>"></span><?php print $slide['title']; ?></a>
    <?php } ?>
  </div>
  <div class="mw-ui-box">
    <?php
        $count = 0;
        foreach ($json as $slide) {
            $count ++;
            ?>
    <div class="mw-ui-box-content mw-ui-box-tab-content"
                 style="<?php if ($count!=1){ ?> display: none; <?php } else { ?>display: block; <?php } ?>">
      <div class="edit allow-drop"
                     field="tab-item-<?php print $count ?>"
                     rel="module-<?php print $params['id'] ?>">
        <div class="element">Tab content <?php print $count ?></div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
