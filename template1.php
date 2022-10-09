<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);






?>
    <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <!--script src="groups.js" type="text/javascript"></script-->
    <script src="/bitrix/templates/2wk/components/bitrix/catalog.section/map1/groups.js" type="text/javascript"></script>
	
	
	
	<script>
		ymaps.ready(init);
		console.log("ymaps.ready(init);");
		
		function init() {
		console.log("function init()");

			// Создание экземпляра карты.
			var myMap = new ymaps.Map('map', {
		/*$yandex_lat = 55.755681;
		$yandex_lon = 37.648240;
		$yandex_scale = 10;				
				*/
					center: [55.755681, 37.648240],
					zoom: 10
				}, {
					searchControlProvider: 'yandex#search'
				}),
				// Контейнер для меню.
				menu = $('<ul class="menu"/>');
				
			for (var i = 0, l = groups.length; i < l; i++) {
				createMenuGroup(groups[i]);
			}

			function createMenuGroup (group) {
		console.log("function createMenuGroup (group)");
				
				// Пункт меню.
				var menuItem = $('<li><a href="#">' + group.name + '</a></li>'),
				// Коллекция для геообъектов группы.
					collection = new ymaps.GeoObjectCollection(null, { preset: group.style }),
				// Контейнер для подменю.
					submenu = $('<ul class="submenu"/>');

				// Добавляем коллекцию на карту.
				myMap.geoObjects.add(collection);
				// Добавляем подменю.
				menuItem
					.append(submenu)
					// Добавляем пункт в меню.
					.appendTo(menu)
					// По клику удаляем/добавляем коллекцию на карту и скрываем/отображаем подменю.
					.find('a')
					.bind('click', function () {
						if (collection.getParent()) {
							myMap.geoObjects.remove(collection);
							submenu.hide();
						} else {
							myMap.geoObjects.add(collection);
							submenu.show();
						}
					});
				for (var j = 0, m = group.items.length; j < m; j++) {
					createSubMenu(group.items[j], collection, submenu);
				}
			}

			function createSubMenu (item, collection, submenu) {
		console.log("function createSubMenu (item, collection, submenu) {");
				
				// Пункт подменю.
				var submenuItem = $('<li><a href="#">' + item.name + '</a></li>'),
				// Создаем метку.
					placemark = new ymaps.Placemark(item.center, { balloonContent: item.name });

				// Добавляем метку в коллекцию.
				collection.add(placemark);
				// Добавляем пункт в подменю.
				submenuItem
					.appendTo(submenu)
					// При клике по пункту подменю открываем/закрываем баллун у метки.
					.find('a')
					.bind('click', function () {
						if (!placemark.balloon.isOpen()) {
							placemark.balloon.open();
						} else {
							placemark.balloon.close();
						}
						return false;
					});
			}

			// Добавляем меню в тэг BODY.
			menu.appendTo($('body'));
			// Выставляем масштаб карты чтобы были видны все группы.
			myMap.setBounds(myMap.geoObjects.getBounds());
		console.log("myMap.setBounds(myMap.geoObjects.getBounds());");
			
		}		
		
	</script>

    <style type="text/css">
        html, body, #map {
            width: 100%; padding: 0; margin: 0;
            font-family: Arial;
        }

        #map {
            height: 250px;
        }
            /* Оформление меню (начало)*/
        .menu {
            list-style: none;
            padding: 5px;

            margin: 0;
        }
        .submenu {
            list-style: none;

            margin: 0 0 0 20px;
            padding: 0;
        }
        .submenu li {
            font-size: 90%;
        }
            /* Оформление меню (конец)*/
    </style>


<div id="map"></div>

<div id="menu"></div>	
<?//__p([$arResult['SELECTED'], $arResult['YANDEX_LAT'], $arResult['YANDEX_LON'], $arResult['YANDEX_SCALE']]);?>

<?__p($arResult["PLACEMARKS"]);?>
	
	

