(() => {

	document.addEventListener("DOMContentLoaded", () => {

		const filterElements = document.querySelectorAll(".__price-form__sorter-element");
		const sorterableTable = document.querySelector(".__price-form__table");
		const activeFilters = {};
		const MARK_CLEARED = "__clear__";

		if (!filterElements.length) {
			throw new Error("Sorter elements not found!");
		}

		if (!sorterableTable) {
			throw new Error("Sorter table not found!");
		}

		const filterableItems = sorterableTable.querySelectorAll("tbody > tr");

		/**
		 * Иницализация активных фильтров
		 */
		filterElements.forEach(filterElement => {
			const name = filterElement.getAttribute("name");
			const defaultValue = filterElement.value;
			activeFilters[name] = defaultValue;
		});


		function executeFilterTable(filterableItems, activeFilters) {
			filterableItems.forEach(filterableItem => {
				let isValidItem = true;

				Object
					.entries(activeFilters)
					.filter(([key, value]) => value != MARK_CLEARED)
					.forEach(([filterName, filterValue]) => {
						if (filterableItem.dataset[filterName] != filterValue) {
							isValidItem = false;
						}
					});

				if (isValidItem) {
					filterableItem.removeAttribute("hidden");
				} else {
					filterableItem.setAttribute("hidden", "");
				}
			});
		}

		function setActiveRelationships(filterableField, filterableValue) {
			let options = {};

			// По каждому фильтру
			Object
				.entries(activeFilters)
				.forEach(([fieldName, fieldValue], index) => {

					// Отбор активных полей
					filterableItems.forEach(filterableItem => {
						if (!filterableItem.hidden) {

							// По кажому фильтрующему полю
							filterElements.forEach(filterElement => {
								if (filterElement.getAttribute("name") != filterableField && filterElement.getAttribute("name") != "city") {

									filterElement
										.querySelectorAll("option")
										.forEach(option => {
											if (option.value == MARK_CLEARED) {
												return;
											}

											option.hidden = true;

											if (option.value == filterableItem.dataset[fieldName]) {

												if (Array.isArray(options[fieldName])) {
													if (options[fieldName].filter(opt => opt.value == option.value).length == 0) {
														options[fieldName].push(option);
													}
												} else {
													options[fieldName] = [option];
												}
											}

										});
								}
							});

						}
					});

				});

			Object
				.entries(options)
				.forEach(([fieldName, fieldOptions]) => {
					fieldOptions.forEach(option => {
						option.hidden = false;
					});
				});

		}

		function handleChangeSort(event) {
			const target = event.target;
			const filterableField = target.getAttribute("name");
			const filterableValue = target.value;

			if (!filterableField) {
				throw new Error("Sorter field name is required!");
			}

			if (!filterableValue) {
				throw new Error("Sorter value not found!");
			}

			activeFilters[filterableField] = filterableValue;

			executeFilterTable(filterableItems, activeFilters);
			setActiveRelationships(filterableField, filterableValue);
		}


		filterElements.forEach(sorter => {
			sorter.addEventListener("change", handleChangeSort);
		});

	});

})();