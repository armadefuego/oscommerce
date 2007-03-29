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

  $osC_ObjectInfo = new osC_ObjectInfo(osC_Language_Admin::getData($_GET['lID']));
?>

<h1><?php echo osc_link_object(osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ($osC_MessageStack->size($osC_Template->getModule()) > 0) {
    echo $osC_MessageStack->output($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('export.png') . ' ' . $osC_ObjectInfo->get('name'); ?></div>
<div class="infoBoxContent">
  <form name="lExport" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page'] . '&lID=' . $osC_ObjectInfo->get('languages_id') . '&action=export'); ?>" method="post">

  <p><?php echo $osC_Language->get('introduction_export_language'); ?></p>

<?php
  $Qgroups = $osC_Database->query('select distinct content_group from :table_languages_definitions where languages_id = :languages_id order by content_group');
  $Qgroups->bindTable(':table_languages_definitions', TABLE_LANGUAGES_DEFINITIONS);
  $Qgroups->bindInt(':languages_id', $osC_ObjectInfo->get('languages_id'));
  $Qgroups->execute();

  $groups_array = array();

  while ($Qgroups->next()) {
    $groups_array[] = array('id' => $Qgroups->value('content_group'),
                            'text' => $Qgroups->value('content_group'));
  }
?>

  <p>(<a href="javascript:selectAllFromPullDownMenu('groups');"><u><?php echo $osC_Language->get('select_all'); ?></u></a> | <a href="javascript:resetPullDownMenuSelection('groups');"><u><?php echo $osC_Language->get('select_none'); ?></u></a>)<br /><?php echo osc_draw_pull_down_menu('groups[]', $groups_array, array('account', 'checkout', 'general', 'index', 'info', 'order', 'products', 'search'), 'id="groups" size="10" multiple="multiple" style="width: 100%;"'); ?></p>

  <p><?php echo osc_draw_checkbox_field('include_data', array(array('id' => '', 'text' => $osC_Language->get('field_export_with_data'))), true); ?></p>

  <p align="center"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . $osC_Language->get('button_export') . '" class="operationButton" /> <input type="button" value="' . $osC_Language->get('button_cancel') . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&page=' . $_GET['page']) . '\';" class="operationButton" />'; ?></p>

  </form>
</div>
