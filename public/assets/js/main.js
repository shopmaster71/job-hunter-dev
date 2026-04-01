$(document).on('ready', function() {
	// Делитель разрядов
	$(function() {
		$(".diviger").each(function() {
			var a = $(this).html();
			$(this).html(a.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " "));
		});
	});

	//Выезжающая панель
	$(function () {
		$('.navicon').click(function () {
			$('.mobile_panel').addClass('panel_open');
			$("body").append("<div id='overlay'></div>");
			$('#overlay').show().css({'filter' : 'alpha(opacity=80)'});
			return false;
		});
		$('div.mobile_panel-close').click(function () {
			$(this).parent().removeClass('panel_open');
			$('#overlay').remove('#overlay');

		});
	});

	//Поиск региона в списке
	$("#geoSearch").on("keyup", function() {
		var  value = $(this).val().toLowerCase();
		$(".choose-region li").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	// Самые актуальные профессии
	$('.more-jobs').click(function(){
	 	var hBlock = $('.category_hide');
		$(this).toggleClass('active');
		$(this).text(hBlock.is(':visible') ? 'Ещё работодатели' : 'Скрыть');
		hBlock.slideToggle("slow");
		return false;
	});

	//Попапы
	$(function () {
		$('.open_popup').click(function () {
			$('.popup').hide();
			$('.mobile_panel').removeClass('panel_open');
			$('div.'+$(this).attr("rel")).fadeIn(500);
			$("body").append("<div id='overlay'></div>");
			$('#overlay').show().css({'filter' : 'alpha(opacity=80)'});
			return false;
		});
		$('div.close_popup').click(function () {
			$(this).parent().parent().fadeOut(100);
			$('#overlay').remove('#overlay');
			return false;
		});
	});

	// Аккордеон
  //$(".accordion > li:eq(0) a").addClass("faq_active").next().slideDown();
  $(".accordion a").click(function (j) {
    var dropDown = $(this).closest("li").find("p");
    $(this).closest(".accordion").find("p").not(dropDown).slideUp();
    if ($(this).hasClass("faq_active")) {
      $(this).removeClass("faq_active");
    } else {
      $(this)
      .closest(".accordion")
      .find("a.faq_active")
      .removeClass("faq_active");
      $(this).addClass("faq_active");
    }
    dropDown.stop(false, true).slideToggle();
    j.preventDefault();
  });

  // Стилизация селектов
    $('.select').each(function() {
        const _this = $(this),
            selectOption = _this.find('option'),
            selectOptionLength = selectOption.length,
            selectedOption = selectOption.filter(':selected'),
            duration = 450; // длительность анимации
        _this.hide();
				_this.wrap('<div class="select"></div>');
        $('<div>', {
            class: 'new-select',
            text: _this.children('option:selected').text() // Правка
        }).insertAfter(_this);
        const selectHead = _this.next('.new-select');
        $('<div>', {
            class: 'new-select__list'
        }).insertAfter(selectHead);
        const selectList = selectHead.next('.new-select__list');
        for (let i = 1; i < selectOptionLength; i++) {
            $('<div>', {
                class: 'new-select__item',
                html: $('<span>', {
                    text: selectOption.eq(i).text()
                })
            })
                .attr('data-value', selectOption.eq(i).val())
                .appendTo(selectList);
        }
        const selectItem = selectList.find('.new-select__item');
        selectList.slideUp(0);
        selectHead.on('click', function() {
            $('.new-select__list').hide();
            if ( !$(this).hasClass('on') ) {
                $(this).addClass('on');
                selectList.slideDown(duration);
                selectItem.on('click', function() {
                    let chooseItem = $(this).data('value');
                    _this.val(chooseItem).attr('selected', 'selected');
                    selectHead.text( $(this).find('span').text() );
                    selectList.slideUp(duration);
                    selectHead.removeClass('on');
                });
            } else {
                $(this).removeClass('on');
                selectList.slideUp(duration);
            }
        });
    });

    // Раскрытие фильтров
	$('.open-filters').click(function(){
		$(this).toggleClass('active');
		$('.hid-filters').slideToggle("slow");
		return false;
	});

  //Маска телефона
  $(function ($) {
    $(".phone").mask("+7(999) 999-99-99");
  });

  //День рождения
  $(function ($) {
    $(".birtday").mask("9999-99-99");
  });
  //Период
  $(function ($) {
    $(".period").mask("9999-99");
  });


$(function() {
	var tab = $('#tabs .tabs-items > div');
	tab.hide().filter(':first').show();

	// Клики по вкладкам.
	$('#tabs .tabs-nav a').click(function(){
		tab.hide();
		tab.filter(this.hash).show();
		$('#tabs .tabs-nav a').removeClass('active');
		$(this).addClass('active');
		return false;
	}).filter(':first').click();

	// Клики по якорным ссылкам.
	$('.tabs-target').click(function(){
		$('#tabs .tabs-nav a[href=' + $(this).attr('href')+ ']').click();
	});

	// Отрытие вкладки из хеша URL
	if(window.location.hash){
		$('#tabs-nav a[href=' + window.location.hash + ']').click();
		window.scrollTo(0, $("#" . window.location.hash).offset().top);
	}
});


// Только цифры
    $('body').on('input', '.input-number', function(){
        this.value = this.value.replace(/[^0-9.]/g, '');
    });

});

// Cookie
function getCookie(name) {
	let matches = document.cookie.match(new RegExp(
	"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}
let cookiecook = getCookie("cookiecook"),
cookiewin = document.getElementsByClassName('cookie_notice')[0];
if (cookiecook != "no") {
	cookiewin.style.display="block";
	document.getElementById("cookie_close").addEventListener("click", function(){
		cookiewin.style.display="none";
		let date = new Date;
		date.setDate(date.getDate() + 1);
		document.cookie = "cookiecook=no; path=/; expires=" + date.toUTCString();
	});
}


// Ползунки

    document.addEventListener('DOMContentLoaded', function () {
    const minHandle = document.getElementById('minHandle');
    const maxHandle = document.getElementById('maxHandle');
    const minLabel = document.getElementById('minLabel');
    const maxLabel = document.getElementById('maxLabel');
    const trackFill = document.getElementById('trackFill');

    if (!minHandle || !maxHandle || !minLabel || !maxLabel || !trackFill) {
      return; // Просто выходим
    }

    function formatNumber(num) {
      return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }

    function updateSlider() {
      let minVal = parseInt(minHandle.value);
      let maxVal = parseInt(maxHandle.value);

      if (minVal >= maxVal) {
        minHandle.value = maxVal - parseInt(minHandle.step);
        minVal = parseInt(minHandle.value);
      }
      if (maxVal <= minVal) {
        maxHandle.value = minVal + parseInt(maxHandle.step);
        maxVal = parseInt(maxHandle.value);
      }

      minLabel.textContent = formatNumber(minVal);
      maxLabel.textContent = formatNumber(maxVal);

      const total = parseInt(minHandle.max) - parseInt(minHandle.min);
      const percentMin = ((minVal - parseInt(minHandle.min)) / total) * 100;
      const percentMax = ((maxVal - parseInt(minHandle.min)) / total) * 100;

      trackFill.style.left = percentMin + '%';
      trackFill.style.width = (percentMax - percentMin) + '%';
    }

    minHandle.addEventListener('input', updateSlider);
    maxHandle.addEventListener('input', updateSlider);
    updateSlider();
  });
































