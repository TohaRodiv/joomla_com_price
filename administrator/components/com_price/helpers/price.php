<?php
/**
 * @package    [COM_PRICE]
 *
 * @author     user42
 * @copyright  РэдЛайн ( https://lred.ru | info@lred.ru )
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

/**
 * Price helper.
 *
 * @package   [PACKAGE_NAME]
 * @since     1.0.0
 */
class PriceHelper
{
	/**
	 * Render submenu.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function addSubmenu($vName)
	{

		HTMLHelper::_('sidebar.addEntry', "Загрузить", 'index.php?option=com_price&view=price', $vName === 'price');
	}
}
