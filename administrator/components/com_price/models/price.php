<?php

/**
 * @package    [COM_PRICE]
 *
 * @author     user42
 * @copyright  РэдЛайн ( https://lred.ru | info@lred.ru )
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

require $_SERVER['DOCUMENT_ROOT'] . '/administrator/components/com_price/vendor/autoload.php';

use Joomla\CMS\MVC\Model\ListModel;

defined('_JEXEC') or die;

/**
 *
 * @package   COM_PRICE
 * @since     1.0.0
 */
class PriceModelPrice extends ListModel
{

	const TABLE_NAME = '#__price_items';


	public function uploadPrice($file)
	{

		/** Create a new Xls Reader  **/
		// $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xml();
		//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Ods();
		//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Slk();
		//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Gnumeric();
		//    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		/** Load $inputFileName to a Spreadsheet Object  **/

		$worksheet = $reader->load($file)->getActiveSheet();
		$data = $worksheet->toArray();
		$headers = array_shift($data);

		$this->checkRequiedFields($headers);
		$this->loadToDatabase($data);
	}

	protected function checkRequiredField($name, $fieldName) {
		if ($name != $fieldName) {
			throw new \Exception("Field \"$fieldName\" is required! Given gield name: \"$name\"");
		}
	}

	protected function checkRequiedFields($headers)
	{
		$this->checkRequiredField($headers[0], 'Город');
		$this->checkRequiredField($headers[1], 'Деятельность');
		$this->checkRequiredField($headers[2], 'Склад');
		$this->checkRequiredField($headers[3], 'Название');
		$this->checkRequiredField($headers[4], 'Цена');
		$this->checkRequiredField($headers[5], 'Дата');
	}

	private function loadToDatabase($data)
	{
		$db = $this->getDbo();

		$db->setQuery('TRUNCATE TABLE '. self::TABLE_NAME . '')->execute();

		foreach ($data as $_key => $value) {
			list($city, $activity, $store, $name, $price, $date) = array_map(function ($fieldValue) {
				return trim($fieldValue);
			}, $value);

			if (empty($name)) {
				continue;
			}

			$columnsWithData = [
				$db->quoteName('city') => $db->quote($city),
				$db->quoteName('activity') => $db->quote($activity),
				$db->quoteName('store') => $db->quote($store),
				$db->quoteName('name') => $db->quote($name),
				$db->quoteName('price') => $db->quote($price),
				$db->quoteName('p_date') => $db->quote($date),
			];

			$query = $db->getQuery(true);

			$query
				->insert(self::TABLE_NAME)
				->columns(array_keys($columnsWithData))
				->values(implode(',', array_values($columnsWithData)));
			
			$db->setQuery($query)->execute();		
		}
	}
}
