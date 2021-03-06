<?php
/*
  osCommerce Online Merchant $osCommerce-SIG$
  Copyright (c) 2010 osCommerce (http://www.oscommerce.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  use osCommerce\OM\Core\OSCOM;
?>

<div style="float: right;"><?php echo osc_link_object(OSCOM::getLink(null, null, $OSCOM_Product->getKeyword()), $OSCOM_Image->show($OSCOM_Product->getImage(), $OSCOM_Product->getTitle(), 'hspace="5" vspace="5"', 'mini')); ?></div>

<h1><?php echo $OSCOM_Template->getPageTitle() . ($OSCOM_Product->hasModel() ? '<br /><span class="smallText">' . $OSCOM_Product->getModel() . '</span>' : ''); ?></h1>

<?php
  if ( $OSCOM_MessageStack->exists('TellAFriend') ) {
    echo $OSCOM_MessageStack->get('TellAFriend');
  }
?>

<form name="tell_a_friend" action="<?php echo OSCOM::getLink(null, null, 'TellAFriend&Process&' . $OSCOM_Product->getKeyword()); ?>" method="post">

<div class="moduleBox">
  <em style="float: right; margin-top: 10px;"><?php echo OSCOM::getDef('form_required_information'); ?></em>

  <h6><?php echo OSCOM::getDef('customer_details_title'); ?></h6>

  <div class="content">
    <ol>
      <li><?php echo osc_draw_label(OSCOM::getDef('field_tell_a_friend_customer_name'), null, 'from_name', true) . osc_draw_input_field('from_name', ($OSCOM_Customer->isLoggedOn() ? $OSCOM_Customer->getName() : null)); ?></li>
      <li><?php echo osc_draw_label(OSCOM::getDef('field_tell_a_friend_customer_email_address'), null, 'from_email_address', true) . osc_draw_input_field('from_email_address', ($OSCOM_Customer->isLoggedOn() ? $OSCOM_Customer->getEmailAddress() : null)); ?></li>
    </ol>
  </div>
</div>

<div class="moduleBox">
  <h6><?php echo OSCOM::getDef('friend_details_title'); ?></h6>

  <div class="content">
    <ol>
      <li><?php echo osc_draw_label(OSCOM::getDef('field_tell_a_friend_friends_name'), null, 'to_name', true) . osc_draw_input_field('to_name'); ?></li>
      <li><?php echo osc_draw_label(OSCOM::getDef('field_tell_a_friend_friends_email_address'), null, 'to_email_address', true) . osc_draw_input_field('to_email_address'); ?></li>
    </ol>
  </div>
</div>

<div class="moduleBox">
  <h6><?php echo OSCOM::getDef('tell_a_friend_message'); ?></h6>

  <div class="content">
    <ol>
      <li><?php echo osc_draw_textarea_field('message', null, 40, 8, 'style="width: 98%;"'); ?></li>
    </ol>
  </div>
</div>

<div class="submitFormButtons">
  <span style="float: right;"><?php echo osc_draw_image_submit_button('button_continue.gif', OSCOM::getDef('button_continue')); ?></span>

  <?php echo osc_link_object(OSCOM::getLink(null, null, $OSCOM_Product->getKeyword()), osc_draw_image_button('button_back.gif', OSCOM::getDef('button_back'))); ?>
</div>

</form>
