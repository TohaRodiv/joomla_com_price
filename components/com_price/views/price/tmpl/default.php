<?php

/**
 * @package    [COM_PRICE]
 *
 * @author     user42
 * @copyright  РэдЛайн ( https://lred.ru | info@lred.ru )
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * ==================================================
 * @var $item->id
 * @var $item->city
 * @var $item->activity
 * @var $item->store
 * @var $item->name
 * @var $item->price
 * @var $item->p_date
 * @var $item->created_at
 * @var $item->updated_at
 */

use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

// HTMLHelper::_('stylesheet', 'com_price/style.css', array('version' => 'auto', 'relative' => true));

?>
<div class="price-list">
	<form action="" class="price-list__form">
		<div class="price-list__form-item">
			<label class="price-list__form-label">
				<span class="price-list__form-label-text">Город</span>
				<select name="city" class="__price-form__sorter-element">
					<option value="__clear__">- Не выбрано -</option>
					<? foreach ($this->uniqueItems["city"] as $city) : ?>
						<option value="<?= $city ?>">
							<?= $city ?>
						</option>
					<? endforeach; ?>
				</select>
			</label>
			<label class="price-list__form-label">
				<span class="price-list__form-label-text">Направление деятельности</span>
				<select name="activity" class="__price-form__sorter-element">
					<option value="__clear__">- Не выбрано -</option>
					<? foreach ($this->uniqueItems["activity"] as $activity) : ?>
						<option value="<?= $activity ?>">
							<?= $activity ?>
						</option>
					<? endforeach; ?>
				</select>
			</label>
			<label class="price-list__form-label">
				<span class="price-list__form-label-text">Площадка</span>
				<select name="store" class="__price-form__sorter-element">
					<option value="__clear__">- Не выбрано -</option>
					<? foreach ($this->uniqueItems["store"] as $store) : ?>item): ?>
					<option value="<?= $store ?>">
						<?= $store ?>
					</option>
				<? endforeach; ?>
				</select>
			</label>
		</div>
	</form>

	<div class="table-responsive">
		<table class="__price-form__table">
			<caption>Цена указана за 1 т.</caption>
			<thead>
				<tr>
					<th>Название</th>
					<th>Склад</th>
					<th>Цена</th>
					<th>Дата прайса</th>
				</tr>
			</thead>
			<tbody>
				<? foreach ($this->items as $item) : ?>
					<tr data-id="<?= $item->id ?>" data-city="<?= $item->city ?>" data-activity="<?= $item->activity ?>" data-store="<?= $item->store ?>">
						<td>
							<span class="__price-list-value"><?= $item->name ?></span>
						</td>
						<td>
							<span class="__price-list-value">
								<a href="/index.php/contacts"><?= $item->store ?></a>
							</span>
						</td>
						<td>
							<span class="__price-list-value"><?= $item->price ?></span>
							&#8381;
						<td>
							<span class="__price-list-value"><?= $item->p_date ?></span>
						</td>
					</tr>
				<? endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<script>
	function getRalationTree () {
		return JSON.parse(`<?= json_encode($this->three) ?>`);
	}
</script>

<?php
	HTMLHelper::_('script', 'com_price/script.js', array('version' => 'auto', 'relative' => true));
?>