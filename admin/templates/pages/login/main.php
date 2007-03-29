<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<div class="infoBoxHeading"><?php echo osc_icon('people.png') . ' ' . $osC_Language->get('action_heading_login'); ?></div>
<div class="infoBoxContent">
  <form name="login" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&action=process'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction'); ?></p>

  <table border="0" width="100%" cellspacing="0" cellpadding="2">
    <tr>
      <td width="40%"><?php echo '<b>' . $osC_Language->get('field_username') . '</b>'; ?></td>
      <td width="60%"><?php echo osc_draw_input_field('user_name', null, 'style="width: 100%;"'); ?></td>
    </tr>
    <tr>
      <td width="40%"><?php echo '<b>' . $osC_Language->get('field_password') . '</b>'; ?></td>
      <td width="60%"><?php echo osc_draw_password_field('user_password', 'style="width: 100%;"'); ?></td>
    </tr>
  </table>

  <p align="center"><?php echo '<input type="submit" value="' . $osC_Language->get('button_login') . '" class="operationButton" />'; ?></p>

  </form>
</div>

<script language="javascript" type="text/javascript">
<!--
  document.login.user_name.focus();
//-->
</script>
