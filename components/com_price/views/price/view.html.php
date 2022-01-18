<?php
/**
 * @package    [COM_PRICE]
 *
 * @author     user42
 * @copyright  РэдЛайн ( https://lred.ru | info@lred.ru )
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\MVC\View\HtmlView;

defined('_JEXEC') or die;

/**
 * Price view.
 *
 * @package   [PACKAGE_NAME]
 * @since     1.0.0
 */
class PriceViewPrice extends HtmlView
{
	private $_items = null;
	private $_three = null;

	function __constructor()
	{
		// $this->db = JFactory::getDbo();
	}

	public function display($tpl = null)
	{
		$this->items = $this->getPriceItems();
		$this->three = $this->getTreeItems();
		$this->uniqueItems = [
			"city" => $this->getUniqueItems("city"),
			"activity" => $this->getUniqueItems("activity"),
			"store" => $this->getUniqueItems("store"),
		];

		parent::display($tpl);
	}

	private function getPriceItems()
	{
		$this->db = JFactory::getDbo();

		if ($this->_items === null) {
			$query = $this->db->getQuery(true);

			$query = 'SELECT * FROM #__price_items';

			$this->db->setQuery($query);

			$this->_items = $this->db->loadObjectList();
		}

		return $this->_items;
	}

	private function getTreeItems()
	{
		$three = [];

		foreach ($this->getPriceItems() as $item) {
			if (!$this->isFieldInArr($three, "city", $item->city)) {
				$three[] = [
					"city" => $item->city,
					"activity" => $this->getActivitiesByCity($this->getPriceItems(), $item->city),
					"id" => $item->id,
				];
			}
		}

		if ($this->_three === null) {
			$this->_three = $three;
		}

		return $this->_three;
	}

	private function isFieldInArr($three, $field, $value)
	{
		foreach ($three as $item) {
			if ($item[$field] == $value) {
				return true;
			}
		}

		return false;
	}

	private function getStoresByActivityAndCity($items, $activity, $city)
	{
		$stores = [];

		foreach ($items as $item) {
			if (!in_array($item->store, $stores) && $item->activity == $activity && $item->city == $city) {
				$stores[] = $item->store;
			}
		}

		return $stores;
	}

	private function getActivitiesByCity($items, $city)
	{
		$activities = [];

		foreach ($items as $item) {
			if (!$this->isFieldInArr($activities, "activity", $item->activity) && $item->city == $city) {
				$activities[] = [
					"activity" => $item->activity,
					"store" => $this->getStoresByActivityAndCity($items, $item->activity, $item->city),
				];
			}
		}

		return $activities;
	}

	private function getUniqueItems($field)
	{
		$result = [];

		foreach ($this->getPriceItems() as $item) {
			if (isset($item->{$field})) {
				$result[] = $item->{$field};
			} else {
				throw new Exception("Unknown field \"$field\"");
			}
		}

		return array_unique($result);
	}
}
