<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//Make all properties present in order
//to prevent html table corruption
foreach($arResult["ITEMS"] as $key => $arElement)
{
	$arRes = array();
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$arRes[$pid] = CIBlockFormatProperties::GetDisplayValue($arElement, $arElement["PROPERTIES"][$pid], "catalog_out");
	}
	$arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"] = $arRes;
	
	
	$lon_lat = explode (",", $arElement["PROPERTIES"]["MAP"]["VALUE"]);
	$lon = $lon_lat[0];
	$lat = $lon_lat[1];
	$PRICE_FROM = $arElement["PROPERTIES"]["PRICE_FROM"]["VALUE"];
	if($PRICE_FROM == '' || $PRICE_FROM == 0) $PRICE_FROM = 1500;
	
	$arResult["PLACEMARKS"][$arElement["ID"]] = [
		"NAME"=>$arElement["NAME"],
		"ID"=>$arElement["ID"],
		"URL"=>$arElement["DETAIL_PAGE_URL"],
		"CODE"=>$arElement["CODE"],

		"DETAIL_PICTURE"=>$arElement["DETAIL_PICTURE"]["SRC"],
		"PREVIEW_PICTURE"=>$arElement["PREVIEW_PICTURE"]["SRC"],
		
		"TYPE"=>$arElement["PROPERTIES"]["TYPE"]["VALUE_ENUM"],
		"TYPE"=>$arElement["PROPERTIES"]["TYPE"]["VALUE_ENUM"],
		"PRICE_FROM"=>$PRICE_FROM,
		"MAP"=>$arElement["PROPERTIES"]["MAP"]["VALUE"],
		"MAP_LON"=>$lon,
		"MAP_LAT"=>$lat,
	];
}


$IBLOCK_ID = $arParams["IBLOCK_ID"]; //Магазины
$arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', 'ID'=>$arParams['SELECTED_ID']);
$arSelect = Array("*");

$db_list = CIBlockElement::GetList(array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);
while($ar_result = $db_list->GetNextElement()){ //GetNext
	$ar_result1 = $ar_result->getFields();
	$ar_prop = $ar_result->getProperties();
	
	$lon_lat = explode (",", $ar_prop["MAP"]["VALUE"]);
	$arResult['YANDEX_LAT'] = $lon_lat[1];
	$arResult['YANDEX_LON'] = $lon_lat[0];
	
	$arResult["SELECTED"] = array(
		"NAME"=>$ar_result1["NAME"],
		"ID"=>$ar_result1["ID"],
		"URL"=>$ar_result1["DETAIL_PAGE_URL"],
		"PREVIEW_TEXT"=>$ar_result1["PREVIEW_TEXT"],
		"PREVIEW_TEXT_TYPE"=>$ar_result1["PREVIEW_TEXT_TYPE"],
		"CITY"=>$ar_prop["CITY"]["VALUE"],
		"ADDRESS"=>$ar_prop["ADDRESS"]["VALUE"],
		"PHONE"=>$ar_prop["PHONE"]["VALUE"],
		"MAP"=>$lon_lat, 
		"IS_STIHL"=>$ar_prop["IS_STIHL"]["VALUE"]=="Y"?true:false,
		"IS_VIKING"=>$ar_prop["IS_VIKING"]["VALUE"]=="Y"?true:false,
		"IS_SERVICE"=>$ar_prop["IS_SERVICE"]["VALUE"]=="Y"?true:false,
		"IS_MOYKA"=>$ar_prop["IS_MOYKA"]["VALUE"]=="Y"?true:false,
	);
		
}




?>