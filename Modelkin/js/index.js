//начало фунции
$(function() {

	// тип слайдера
	$t = "slide"; // опции - fade и slide
	
	// переменные
	$f = 1000,  // скорость появления/исчезновения (для fade)
	$s = 1000,  // скорость перехода (для слайдов)
	$d = 5000;  // продолжительность показа слайда
	
	$n = $('.slide').length;  // количество слайдов
	$w = $('.slide').width(); // ширина слайда
	$c = $('.container').width(); // ширина контейнера
	$ss = $n * $w; // ширина слайдшоу

	//фунция таймера
		function timer() {
			$('.timer').animate({"width":$w}, $d);
			$('.timer').animate({"width":0}, 0);
	}


// функция появления/исчезновения
	function fadeInOut() {
// вызываем функцию, отвечающую за анимацию таймера
		timer();
			$i = 0;   
// устанавливаем CSS для всех слайдов 
			var setCSS = {
					'position' : 'absolute',
					'top' : '0',
					'left' : '0'
			}        
			
			$('.slide').css(setCSS);
			
			// показываем первый слайд
			$('.slide').eq($i).show();
			
// устанавливаем интервал для перехода между слайдами
			setInterval(function() {
// вызываем функцию, отвечающую за анимацию таймера
				timer();
// скрываем текущий слайд
					$('.slide').eq($i).fadeOut($f);
// определяем следующий слайд
					if ($i == $n - 1) {
							$i = 0;
					} else {
							$i++;
					}
// показываем следующий слайд
					$('.slide').eq($i).fadeIn($f, function() {
							$('.timer').css({'width' : '0'});
					});

			}, $d);
			
	}
	
	function slide() { // вызываем функцию, отвечающую за анимацию таймера
		timer();
// устанавливаем CSS для всех слайдов
			var setSlideCSS = {
					'float' : 'left',
					'display' : 'inline-block',
					'width' : $c
			}
// устанавливаем CSS для слайдшоу
			var setSlideShowCSS = {
					'width' : $ss // устанавливаем ширину контейнера для слайдшоу
			}
			$('.slide').css(setSlideCSS);
			$('.slideshow').css(setSlideShowCSS); 
			
			// устанавливаем интервал для перехода между слайдами
			setInterval(function() {
// вызываем функцию, отвечающую за анимацию таймера
					timer();
					$('.slideshow').animate({"left": -$w}, $s, function(){
							// для создания бесконечного цикла
							$('.slideshow').css('left',0).append( $('.slide:first'));
					});
			}, $d);
			
	}
	
	if ($t == "fade") {
// если слайдер типа "fade", вызываем соответствующую функцию
			fadeInOut();
			
	} if ($t == "slide") {
// если слайдер типа "slide", вызываем соответствующую функцию
			slide();
			
	} else {
		
	}
});
