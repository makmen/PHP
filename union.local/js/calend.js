	function mycalendar()
	{
		$('#calend').append("<tr></tr>"); 
		$('#calend tr:last').append("<th>Пн</th><th>Вт</th><th>Ср</th><th>Чт</th><th>Пт</th><th>Сб</th><th>Вс</th>");  
		var mon = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
		var date = new Date();
		var day = date.getDate();   
		var month = mon[date.getMonth()];  
		var year  = date.getFullYear();    
		var str = month + ' ' + year; 
		$('#calendp').html('<strong>' + str + '</strong>');
		var firstDay = new Date(year, date.getMonth(), 1);
		var first = firstDay.getDay();
		var firstDay = new Date(year, date.getMonth() + 1, 0);
		var last = firstDay.getDate();
		if (!first) first = 7;
		$('#calend').append("<tr></tr>"); 
		for (i = 0, j = 0; i < 7; i++) {
			first--;    
			if (first > 0) {				$('#calend tr:last').append("<td>&nbsp</td>");  
				continue; 			}           
			++j;    
			if (j == day) { 				$('#calend tr:last').append("<td class='today'>" + j + "</td>"); 			} else {				$('#calend tr:last').append("<td>" + j + "</td>"); 			}
		}   
		for (i = ++j, k = 0, count = 35 + j; i < count; i++, k++ ) {      
			if (k % 7 == 0) { 				$('#calend').append("<tr></tr>"); 
				k = 0;			}			if (i <= last) {   
				if (i == day) { 
				   $('#calend tr:last').append("<td class='today'>" + i + "</td>"); 
				} else {  
					$('#calend tr:last').append("<td>" + i + "</td>"); 
				}
			} else { 				$('#calend tr:last').append("<td>&nbsp</td>");  			}
		}


	}
