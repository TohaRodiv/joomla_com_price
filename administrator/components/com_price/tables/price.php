<?php
/**
 * @package    [COM_PRICE]
 *
 * @author     user42
 * @copyright  РэдЛайн ( https://lred.ru | info@lred.ru )
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Table\Table;

defined('_JEXEC') or die;

/**
 * Price table.
 *
 * @package   [PACKAGE_NAME]
 * @since     1.0.0
 */
class TablePrice extends Table
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  $db  Database driver object.
	 *
	 * @since   1.0.0
	 */
	public function __construct(JDatabaseDriver $db)
	{
		parent::__construct('#__price_items', 'item_id', $db);
	}
}