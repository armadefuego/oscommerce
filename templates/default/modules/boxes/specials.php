<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2005 osCommerce

  Released under the GNU General Public License
*/
?>

<!-- box specials start //-->

<div class="boxNew">
  <div class="boxTitle"><?php echo '<a href="' . $osC_Box->getTitleLink() . '">' . $osC_Box->getTitle() . '</a>'; ?></div>

  <div class="boxContents" style="text-align: center;"><?php echo $osC_Box->getContent(); ?></div>
</div>

<!-- box specials end //-->