<?php

/**
 * @package    [COM_PRICE]
 *
 * @author     user42
 * @copyright  РэдЛайн ( https://lred.ru | info@lred.ru )
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\MVC\Controller\AdminController;
use \Joomla\CMS\Response\JsonResponse;

defined('_JEXEC') or die;

/**
 * Price Controller.
 *
 * @package   [PACKAGE_NAME]
 * @since     1.0.0
 */
class PriceControllerPrice extends AdminController
{
	const UPLOAD_FILE_NAME = 'price-file';
	const VALID_MIME_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

	public function upload()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (isset($_FILES[self::UPLOAD_FILE_NAME])) {
				if ($_FILES[self::UPLOAD_FILE_NAME]["type"] == self::VALID_MIME_TYPE) {

					$result = $this->getModel()->uploadPrice($_FILES[self::UPLOAD_FILE_NAME]['tmp_name']);

					return "Файл успешно загружен!";
				}

			}
		}
	}
}
