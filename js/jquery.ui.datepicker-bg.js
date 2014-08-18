/* Bulgarian initialisation for the jQuery UI date picker plugin. */
jQuery(function($){
	$.datepicker.regional['bg'] = {
		closeText: 'Готово',
		prevText: 'Предишен',
		nextText: 'Следващ',
		currentText: 'Днес',
		monthNames: ['Януари','Февруари','Март','Април','Май','Юни',
		'Юли','Август','Септември','Октомври','Ноември','Декември'],
		monthNamesShort: ['Ян', 'Фев', 'Мар', 'Апр', 'Май', 'Юни',
		'Юли', 'Авг', 'Сеп', 'Окт', 'Ное', 'Дек'],
		dayNames: ['Неделя', 'Понеделник', 'Вторник', 'Сряда', 'Четвъртък', 'Петък', 'Събота'],
		dayNamesShort: ['Нед', 'Пон', 'Вт', 'Ср', 'Чт', 'Пет', 'Съб'],
		dayNamesMin: ['Н','Пн','В','С','Ч','Пт','Съ'],
		weekHeader: 'Сд',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['bg']);
});
