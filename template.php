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
/*		var tcollection = []; //new ymaps.GeoObjectCollection(null, { preset: "islands#redIcon" });
		var myMap = [];
		
		var premap_list = [];
		var use_premap_list = false;
	
		$( document ).ready(function(){
			var filter_data = {};
			$('#filter_text, #title-search-input').on("keyup", function() {	
				///premap.php?nfilter=за&PAGEN_1=2
				var filter_text = $(this).val();
				var PAGEN = '';
				var filter_data = {};
				if(filter_text != '') filter_data.nfilter = filter_text;
				//areanameshort
				
				if(PAGEN != '') filter_data.PAGEN_1 = PAGEN;
				
				$.ajax({
					type: "POST",
					url: "/premap.php ",
					data: filter_data,
					dataType: "json",
					success: function(json){ 
						//__p(json);
						console.log(json);
						premap_list = json;
						use_premap_list = true;

						console.log("#menu1').bind('click'");
						
						myMap.geoObjects.remove(tcollection);
						$("ul.menu").html("");
						createMenuGroup(groups[0]);
					}
				});	
				
				$.ajax({
					type: "POST",
					url: "/premap_count.php",
					data: filter_data,
					dataType: "json",
					success: function(json){
						console.log("premap_count");
						console.log(json);
						console.log(json.count);
						if(json != "" && json.count > 0){
							$("#naydeno_count").html("Найдено "+json.count+" новостроек");						
						}else{
							$("#naydeno_count").html("");	
						}
					}
				});	
				
				$.ajax({
					type: "POST",
					url: "/premap1.php",
					data: filter_data,
					dataType: "html",
					success: function(html){
						console.log("premap1");
						$("#show_main").html(html);						
					}
				});				
			});	
			
			
			$.ajax({
				type: "POST",
				url: "/premap.php ",
				data: filter_data,
				dataType: "json",
				success: function(json){ 
					console.log(json);
					premap_list = json;
					use_premap_list = true;
				}
			});
			
			ymaps.ready(init);
			//console.log("ymaps.ready(init);");
			
			$.ajax({
				type: "POST",
				url: "/premap_count.php",
				data: filter_data,
				dataType: "json",
				success: function(json){
					console.log("premap_count");
					console.log(json);
					console.log(json.count);
					if(json != "" && json.count > 0){
						$("#naydeno_count").html("Найдено "+json.count+" новостроек");						
					}else{
						$("#naydeno_count").html("");						
					}
				}
			});	
			
			
			//??????????????
			$.ajax({
				type: "POST",
				url: "/premap1.php ",
				data: filter_data,
				dataType: "html",
				success: function(html){
					console.log("premap1");
					$("#show_main").html(html);						
				}
			});				
		
		});		
		
		function init() {
		console.log("function init()");

			// Создание экземпляра карты.
			myMap = new ymaps.Map('map', {
					center: [55.755681, 37.648240],
					zoom: 10,
					controls: ['smallMapDefaultSet']
				}, {
					//searchControlProvider: 'yandex#search' 
				}),
				// Контейнер для меню.
				menu = $('<ul class="menu h-list"/>');
			myMap.behaviors.disable('scrollZoom'); 
				
			createMenuGroup(groups[0]);

			// Добавляем меню в тэг BODY.
			menu.appendTo($('#map_menu_container'));
			// Выставляем масштаб карты чтобы были видны все группы.
			myMap.setBounds(myMap.geoObjects.getBounds());
		console.log("myMap.setBounds(myMap.geoObjects.getBounds());");
			
		}	
		
		function createMenuGroup (group) {
		console.log("function createMenuGroup (group)");
				
				// Пункт меню.
//				var menuItem = $('<li><a href="#">' + group.name + '</a></li>'),
				var menuItem = $('<div></div>'),
				// Коллекция для геообъектов группы.
					collection = new ymaps.GeoObjectCollection(null, { preset: "islands#redIcon" }),
				// Контейнер для подменю.
					//submenu = $('<ul class="submenu"/>');
					submenu = $('<div class="submenu"/>');

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
					
				if(use_premap_list){
					console.log("use_premap_list");
					
					for (var i = 0, len = premap_list.length; i < len; i++) {
						var item1 = premap_list[i];
						if(item1.MAP_LON > 0 && item1.MAP_LAT > 0){
							item1.center=[item1.MAP_LON, item1.MAP_LAT];
							item1.name=item1.NAME;
							item1.id=item1.ID;
							createSubMenu(item1, collection, submenu);
							//createSubMenu({center: [item1.MAP_LON, item1.MAP_LAT], name: item1.NAME, id:item1.ID,}, collection, submenu);
						}
					}					
					
				}else{
					console.log("NOT use_premap_list");

				}	
				tcollection	= collection;
			}

			function createSubMenu (item, collection, submenu) {
			console.log("function createSubMenu (item, collection, submenu) {");
			//console.log(item);
				
//<li id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="a_baloon balloon<?= $arItem["ID"] ?>" style="cursor: pointer;">
//<span id="balloon_<?=$arItem["ID"]?>" class="header__address-tt2 <?=$color?>" style="cursor: pointer;"><?=$arItem["NAME"]?></span>				
				
				// Пункт подменю.
				var submenuItem = $('<li class="a_baloon balloon'+item.id+'"><span id="balloon_'+item.id+'class="header__address-tt2 >' + item.name + '</a></li>');
				// Создаем метку.
				var balloonContent = item.name;
///////////////	

							
					var props = {};
					
//					var item_text = item.name;
					var item_text = 
					"<a href='https://"+item.CODE+".2wk.ru'>"
					+"<div class='yamap_class'>"
					+"<img src='"+item.PREVIEW_PICTURE+"'>"
					+"<b>"+item.name+"</b><br/>"
					+ "от "+item.PRICE_FROM+" руб/м2"	
					+"</div>"
					+"</a>";					
					
					props.balloonContent = 
						'<style>'+
						'.baloon_map{font-size: 18px;}'+
						'.yamap_class img{    float: left;    height: 60px;    margin-right: 10px;}'+
						'.yamap_class {    min-width: 170px;}' +
						'</style>'+ 
						'<div id="balloon'+item.id+'" class="baloon_map" style="margin: 10px;">' +
							item_text.replace(/\n/g, '<br />')
						+'</div>';
					props.hintContent = item.name;
					
					var img_name = '';
					var iconImageSize = [26, 34];
					var iconImageOffset= [-13, -34];		
					img_name = "/img/map/map_cursor_sm.png";
					var option1 = { 
						balloonCloseButton: true,
						iconImageHref: img_name, 
						iconImageSize: iconImageSize,
						iconImageOffset: iconImageOffset,
						hideIconOnBalloonOpen: false,			
						//url: arPlacemark.URL,
						id: item.id,
					};			
					
///////////////					option
				var placemark = new ymaps.Placemark(item.center, props, option1);
			
				
				//var placemark = new ymaps.Placemark(item.center, { balloonContent: item.name });

				// Добавляем метку в коллекцию.
				collection.add(placemark);
				// Добавляем пункт в подменю.
				submenuItem
					.appendTo(submenu)
					// При клике по пункту подменю открываем/закрываем баллун у метки.
					.find('span')
					.bind('click', function () {
						if (!placemark.balloon.isOpen()) {
							placemark.balloon.open();
						} else {
							placemark.balloon.close();
						}
						return false;
					});
			} 
	
		
		


		
		
*/	
		
	</script>

    <style type="text/css">

            /* Оформление меню (начало)*/
/*        .menu {
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
        }*/
            /* Оформление меню (конец)*/
    </style>

	
	


<div class="c-shops-map__wrap"> 
    <div class="row">
	
		<div class="map-widget__wrap col-lg-3 col-sm-4 col-xs-12 minimized" style="padding: 0; display:none;">
			<div class="map-widget">	

				<style>
					.c-shops-map .map-widget {
						background-color: #F3F3F3;
					}
					.widget__address-wrap{
						overflow: auto;
						height: 500px;
						background: #f7f7f7;
					}
					#map {
						height: 500px;
					}					
					.widget__address-wrap .h-list {
						/*padding-top: 20px;*/
						padding-left: 0;
					}
					.widget__address-wrap .h-list li{
						list-style: none;
						margin-left: 10px;
						padding-left: 10px;
						padding-top: 10px;
						padding-bottom: 10px;
						
					}
					.header__address-tt2{
						color: #000;
						font-weight: bold;
						display: block;
					}
					.a_baloon:hover{
						/*box-shadow: 0px 0px 15px rgba(0,0,0,0.5);
						background: #fff;*/
						color: #0170db;
					}	
					.a_baloon:hover .header__address-tt2{
						color: #0170db;
					}					
					
					.a_baloon.active{
						color: #0170db;
						text-decoration: underline;
					}
					
					.a_baloon.active .header__address-tt2 {
						color: #0170db;
						text-decoration: underline;
					}					
					.filter_text{
						margin-top: 20px;
						margin-left: 20px;
						width: 86%;
						padding: 10px;
						padding-right: 10px;
						padding-right: 30px;
						background-image: url(/assets/img/icons/search.png);
						background-repeat: no-repeat;
						background-position: right center;
						border: 1px solid #ccc;
					}					
					
					
				</style>


				<? $arLine = array("1" => "red", "2" => "blue", "3" => "green", "4" => "yellow", "5" => "purple"); ?>
				<div class="widget__address-wrap" id="map_menu_container">
					<input type="text" id="filter_text" class="filter_text" placeholder="Введите название бизнес центра">
					<div id="map_menu_container">
					</div>					
				</div>
			</div> 
		</div>				

		<div class="map-elem__wrap col-lg-9 col-sm-8 col-xs-12" style="padding: 0;">
			<div class="bx-yandex-view-layout">
				<div class="bx-yandex-view-map" id="map">
				</div>
			</div>
		</div>
	</div>
</div>
	


<?//__p([$arResult['SELECTED'], $arResult['YANDEX_LAT'], $arResult['YANDEX_LON'], $arResult['YANDEX_SCALE']]);?>
<?//__p($arResult["PLACEMARKS"]);?>
	
	

