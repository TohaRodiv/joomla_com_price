
document.addEventListener("DOMContentLoaded", () => {

	const uploadPriceForm = document.getElementById("upload-price-form");
	const domParser = new DOMParser();

	function renderMessage(message, type) {
		if (type == "error") {
			Joomla.renderMessages({
				error: [message],
			});
		} else if (type == "success") {
			Joomla.renderMessages({
				success: [message],
			});
		} else if (type == "info") {
			Joomla.renderMessages({
				info: [message],
			});
		}
	}

	uploadPriceForm.addEventListener("submit", e => {
		e.preventDefault();

		const target = e.target;
		const method = target.getAttribute("method");
		const action = target.getAttribute("action");
		const data = new FormData(target);

		fetch(action, {
			method,
			body: data,
		})
			.then(response => response.text())
			.then(resultText => {

				let document = domParser.parseFromString(resultText, "text/html");
				let message = document.title;

				if (message != null) {
					if (message.indexOf("ООО «Дальвтормет» - Панель управления") >= 0) {
						renderMessage("Файл успешно загружен", "success");
					} else {
						renderMessage(message, "error");
					}
				} else {
					renderMessage("Не удалось найти ответ!", "error");
				}
			})
			.catch(error => {
				console.log(error);
				renderMessage("Перезагрузите страницу или повторно выбирите файл.", "info");
			});

	});

});