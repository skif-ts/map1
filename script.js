/*

function init() {
console.log("function init()");

    // �������� ���������� �����.
    var myMap = new ymaps.Map('map', {
            center: [50.443705, 30.530946],
            zoom: 14
        }, {
            searchControlProvider: 'yandex#search'
        }),
        // ��������� ��� ����.
        menu = $('<ul class="menu"/>');
        
    for (var i = 0, l = groups.length; i < l; i++) {
        createMenuGroup(groups[i]);
    }

    function createMenuGroup (group) {
console.log("function createMenuGroup (group)");
		
        // ����� ����.
        var menuItem = $('<li><a href="#">' + group.name + '</a></li>'),
        // ��������� ��� ����������� ������.
            collection = new ymaps.GeoObjectCollection(null, { preset: group.style }),
        // ��������� ��� �������.
            submenu = $('<ul class="submenu"/>');

        // ��������� ��������� �� �����.
        myMap.geoObjects.add(collection);
        // ��������� �������.
        menuItem
            .append(submenu)
            // ��������� ����� � ����.
            .appendTo(menu)
            // �� ����� �������/��������� ��������� �� ����� � ��������/���������� �������.
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
		
        // ����� �������.
        var submenuItem = $('<li><a href="#">' + item.name + '</a></li>'),
        // ������� �����.
            placemark = new ymaps.Placemark(item.center, { balloonContent: item.name });

        // ��������� ����� � ���������.
        collection.add(placemark);
        // ��������� ����� � �������.
        submenuItem
            .appendTo(submenu)
            // ��� ����� �� ������ ������� ���������/��������� ������ � �����.
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

    // ��������� ���� � ��� BODY.
    menu.appendTo($('body'));
    // ���������� ������� ����� ����� ���� ����� ��� ������.
    myMap.setBounds(myMap.geoObjects.getBounds());
console.log("myMap.setBounds(myMap.geoObjects.getBounds());");
	
}*/