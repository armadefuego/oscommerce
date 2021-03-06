<?php
/*
  osCommerce Online Merchant $osCommerce-SIG$
  Copyright (c) 2010 osCommerce (http://www.oscommerce.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License v2 (1991)
  as published by the Free Software Foundation.
*/

  namespace osCommerce\OM\Core\Site\Shop\Application\Account\Action\Notifications;

  use osCommerce\OM\Core\ApplicationAbstract;
  use osCommerce\OM\Core\Registry;
  use osCommerce\OM\Core\OSCOM;

  class Process {
    public static function execute(ApplicationAbstract $application) {
      $OSCOM_Database = Registry::get('Database');
      $OSCOM_Customer = Registry::get('Customer');
      $OSCOM_MessageStack = Registry::get('MessageStack');

      $updated = false;

      if ( isset($_POST['product_global']) && is_numeric($_POST['product_global']) ) {
        $product_global = (int)$_POST['product_global'];
      } else {
        $product_global = 0;
      }

      if ( isset($_POST['products']) ) {
        (array)$products = $_POST['products'];
      } else {
        $products = array();
      }

// HPDL Should be moved to the customers class!
      $Qglobal = $OSCOM_Database->query('select global_product_notifications from :table_customers where customers_id = :customers_id');
      $Qglobal->bindInt(':customers_id', $OSCOM_Customer->getID());
      $Qglobal->execute();

      if ( $product_global !== $Qglobal->valueInt('global_product_notifications') ) {
        $product_global = (($Qglobal->valueInt('global_product_notifications') === 1) ? 0 : 1);

        $Qupdate = $OSCOM_Database->query('update :table_customers set global_product_notifications = :global_product_notifications where customers_id = :customers_id');
        $Qupdate->bindInt(':global_product_notifications', $product_global);
        $Qupdate->bindInt(':customers_id', $OSCOM_Customer->getID());
        $Qupdate->execute();

        if ( $Qupdate->affectedRows() === 1 ) {
          $updated = true;
        }
      } elseif ( count($products) > 0 ) {
        $products_parsed = array_filter($products, 'is_numeric');

        if ( count($products_parsed) > 0 ) {
          $Qcheck = $OSCOM_Database->query('select count(*) as total from :table_products_notifications where customers_id = :customers_id and products_id not in :products_id');
          $Qcheck->bindInt(':customers_id', $OSCOM_Customer->getID());
          $Qcheck->bindRaw(':products_id', '(' . implode(',', $products_parsed) . ')');
          $Qcheck->execute();

          if ( $Qcheck->valueInt('total') > 0 ) {
            $Qdelete = $OSCOM_Database->query('delete from :table_products_notifications where customers_id = :customers_id and products_id not in :products_id');
            $Qdelete->bindInt(':customers_id', $OSCOM_Customer->getID());
            $Qdelete->bindRaw(':products_id', '(' . implode(',', $products_parsed) . ')');
            $Qdelete->execute();

            if ( $Qdelete->affectedRows() > 0 ) {
              $updated = true;
            }
          }
        }
      } else {
        $Qcheck = $OSCOM_Database->query('select count(*) as total from :table_products_notifications where customers_id = :customers_id');
        $Qcheck->bindInt(':customers_id', $OSCOM_Customer->getID());
        $Qcheck->execute();

        if ( $Qcheck->valueInt('total') > 0 ) {
          $Qdelete = $OSCOM_Database->query('delete from :table_products_notifications where customers_id = :customers_id');
          $Qdelete->bindInt(':customers_id', $OSCOM_Customer->getID());
          $Qdelete->execute();

          if ( $Qdelete->affectedRows() > 0 ) {
            $updated = true;
          }
        }
      }

      if ( $updated === true ) {
        $OSCOM_MessageStack->add('Account', OSCOM::getDef('success_notifications_updated'), 'success');
      }

      osc_redirect(OSCOM::getLink(null, null, null, 'SSL'));
    }
  }
?>
