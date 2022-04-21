$(function () {
	let utm='utm_medium';
	
	if( window.location.toString().indexOf(utm +'=') != -1) {
	  
		let number=(window.location.toString().substr(window.location.toString().indexOf(utm+'=')+ utm.length+1,50)).toLowerCase();  
		
		if( number.indexOf('&') != -1) {
			number=(number.substr(0,number.indexOf('&')));
		}
		
		if(number == 'terra') {
		    $('.multi-title').html('Бизнес класс на Черной речке от 6.6 млн.<br>Дом, в котором двор переходит в парк');
		} else if(number == 'belart') {
		    $('.multi-title').html('Бизнес класс в окружении 3 парков от 6.5 млн. м Лесная');
		} else if(number == 'modum') {
		    $('.multi-title').html('Бизнес класс в Приморском р-не со SPA-комплексом.<br>От 6.3 млн. руб.<br>Первый взнос от 0%');
		} else if(number == 'prok') {
		    $('.multi-title').html('Дом комфорт класса с отделкой под ключ от 3.6 млн.<br>Первый взнос от 10%');
		} else if(number == 'nevaresid') {
		    $('.multi-title').html('Премиальный ЖК на берегу Петровского ос-ва от 9.1 млн.<br>Первый взнос от 10%');
		}
		
	}
});