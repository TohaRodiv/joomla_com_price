<?php

/**
 * @package    [COM_PRICE]
 *
 * @author     user42
 * @copyright  РэдЛайн ( https://lred.ru | info@lred.ru )
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

HTMLHelper::_('script', 'com_price/administrator/script.js', array('version' => 'auto', 'relative' => true));

?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
	<form id="upload-price-form" action="<?php echo JRoute::_('index.php?option=com_price&task=price.upload'); ?>" method="POST">
		<input type="file" name="price-file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
		<button type="submit">Загрузить</button>
	</form>
	<hr />
</div>