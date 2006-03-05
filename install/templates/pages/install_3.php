<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 osCommerce

  Released under the GNU General Public License
*/
?>

<script language="javascript" type="text/javascript" src="../includes/javascript/xmlhttp/xmlhttp.js"></script>
<script language="javascript" type="text/javascript">
<!--

  var dbServer = "<?php echo $_POST['DB_SERVER']; ?>";
  var dbUsername = "<?php echo $_POST['DB_SERVER_USERNAME']; ?>";
  var dbPassword = "<?php echo $_POST['DB_SERVER_PASSWORD']; ?>";
  var dbName = "<?php echo $_POST['DB_DATABASE']; ?>";
  var dbClass = "<?php echo $_POST['DB_DATABASE_CLASS']; ?>";
  var dbPrefix = "<?php echo $_POST['DB_TABLE_PREFIX']; ?>";

  var formSubmited = false;

  function handleHttpResponse() {
    if (http.readyState == 4) {
      if (http.status == 200) {
        var result = http.responseText.split(':osCRPC:', 2);

        if (result[0] == '1') {
          document.getElementById('mBoxContents').innerHTML = '<p><img src="images/success.gif" align="right" hspace="5" vspace="5" border="0" /><?php echo $osC_Language->get('rpc_database_sample_data_imported'); ?></p>';

          setTimeout("document.getElementById('installForm').submit();", 2000);
        } else {
          document.getElementById('mBoxContents').innerHTML = '<p><img src="images/failed.gif" align="right" hspace="5" vspace="5" border="0" /><?php echo $osC_Language->get('rpc_database_sample_data_import_error'); ?></p>'.replace('%s', result[1]);
        }
      }

      formSubmited = false;
    }
  }

  function prepareDB() {
    if (document.getElementById("cfg_dbimport").checked) {
      if (formSubmited == true) {
        return false;
      }

      formSubmited = true;

      showDiv(document.getElementById('mBox'));

      document.getElementById('mBoxContents').innerHTML = '<p><img src="images/progress.gif" align="right" hspace="5" vspace="5" border="0" /><?php echo $osC_Language->get('rpc_database_sample_data_importing'); ?></p>';

      loadXMLDoc("rpc.php?action=dbImportSample&server=" + urlEncode(dbServer) + "&username=" + urlEncode(dbUsername) + "&password=" + urlEncode(dbPassword) + "&name=" + urlEncode(dbName) + "&class=" + urlEncode(dbClass) + "&prefix=" + urlEncode(dbPrefix), handleHttpResponse);
    } else {
      document.getElementById('installForm').submit();
    }
  }

//-->
</script>

<div class="mainBlock">
  <div class="stepsBox">
    <ol>
      <li><?php echo $osC_Language->get('box_steps_step_1'); ?></li>
      <li><?php echo $osC_Language->get('box_steps_step_2'); ?></li>
      <li><?php echo $osC_Language->get('box_steps_step_3'); ?></li>
      <li style="font-weight: bold;"><?php echo $osC_Language->get('box_steps_step_4'); ?></li>
      <li><?php echo $osC_Language->get('box_steps_step_5'); ?></li>
    </ol>
  </div>

  <h1><?php echo $osC_Language->get('page_title_installation'); ?></h1>

  <?php echo $osC_Language->get('text_installation'); ?>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3><?php echo $osC_Language->get('box_info_step_4_title'); ?></h3>

    <div class="infoPaneContents">
      <?php echo $osC_Language->get('box_info_step_4_text'); ?>
    </div>
  </div>

  <div id="mBox">
    <div id="mBoxContents"></div>
  </div>

  <div class="contentPane">
    <h2><?php echo $osC_Language->get('page_heading_step_4'); ?></h2>

    <form name="install" id="installForm" action="install.php?step=4" method="post" onsubmit="prepareDB(); return false;">

    <table border="0" width="99%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo $osC_Language->get('param_store_name') . '<br />' . osc_draw_input_field('CFG_STORE_NAME', '', 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo $osC_Language->get('param_store_name_description'); ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo $osC_Language->get('param_store_owner_name') . '<br />' . osc_draw_input_field('CFG_STORE_OWNER_NAME', '', 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo $osC_Language->get('param_store_owner_name_description'); ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo $osC_Language->get('param_store_owner_email_address') . '<br />' . osc_draw_input_field('CFG_STORE_OWNER_EMAIL_ADDRESS', '', 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo $osC_Language->get('param_store_owner_email_address_description'); ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo $osC_Language->get('param_administrator_username') . '<br />' . osc_draw_input_field('CFG_ADMINISTRATOR_USERNAME', '', 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo $osC_Language->get('param_administrator_username_description'); ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo $osC_Language->get('param_administrator_password') . '<br />' . osc_draw_input_field('CFG_ADMINISTRATOR_PASSWORD', '', 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo $osC_Language->get('param_administrator_password_description'); ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo osc_draw_checkbox_field('DB_INSERT_SAMPLE_DATA', 'true', true, 'id="cfg_dbimport"') . '&nbsp;' . $osC_Language->get('param_database_import_sample_data'); ?></td>
        <td class="inputDescription"><?php echo $osC_Language->get('param_database_import_sample_data_description'); ?></td>
      </tr>
    </table>

    <p align="right"><?php echo '<input type="image" src="templates/' . $template . '/languages/' . $osC_Language->getDirectory() . '/images/buttons/continue.gif" border="0" alt="' . $osC_Language->get('image_button_continue') . '" />'; ?>&nbsp;&nbsp;<?php echo '<a href="index.php"><img src="templates/' . $template . '/languages/' . $osC_Language->getDirectory() . '/images/buttons/cancel.gif" border="0" alt="' . $osC_Language->get('image_button_cancel') . '" /></a>'; ?></p>

<?php
  foreach ($_POST as $key => $value) {
    if (($key != 'x') && ($key != 'y')) {
      if (is_array($value)) {
        for ($i=0, $n=sizeof($value); $i<$n; $i++) {
          echo osc_draw_hidden_field($key . '[]', $value[$i]);
        }
      } else {
        echo osc_draw_hidden_field($key, $value);
      }
    }
  }
?>

    </form>
  </div>
</div>
