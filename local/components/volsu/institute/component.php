<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

$arResult = $arParams;

Loader::includeModule('iblock');
$resPrograms = CIBlockElement::GetList([], [
    'IBLOCK_ID' => (int)$arParams['ID_Iprograms'],
    'ACTIVE' => 'Y'
]);
while ($obElement = $resPrograms -> GetNextElement()){
    $arItem = $obElement->GetFields();
    $arItem['PROP'] = $obElement->GetProperties();
    $arResult['PROGRAM'][] = $arItem;
}

$resDepartments = CIBlockElement::GetList([], [
    'IBLOCK_ID' => (int)$arParams['ID_Idepartments'],
    'ACTIVE' => 'Y'
]);
while ($obElement = $resDepartments -> GetNextElement()){
    $arItem = $obElement->GetFields();
    $arItem['PROP'] = $obElement->GetProperties();
    $arResult['DEPARTMENT'][] = $arItem;
}

$resDivisions = CIBlockElement::GetList([], [
    'IBLOCK_ID' => (int)$arParams['ID_Idivisions'],
    'ACTIVE' => 'Y'
]);
while ($obElement = $resDivisions-> GetNextElement()){
    $arItem = $obElement->GetFields();
    $arItem['PROP'] = $obElement->GetProperties();
    $arResult['DIVISION'][] = $arItem;
}

$resDeans = CIBlockElement::GetList([], [
    'IBLOCK_ID' => (int)$arParams['ID_Ideans'],
    'ACTIVE' => 'Y'
]);
while ($obElement = $resDeans-> GetNextElement()){
    $arItem = $obElement->GetFields();
    $arItem['PROP'] = $obElement->GetProperties();
    $arResult['DEAN'][] = $arItem;
}

$resSlider = CIBlockElement::GetList([], [
    'IBLOCK_ID' => (int)$arParams['ID_Islider'],
    'ACTIVE' => 'Y'
]);
while ($obElement = $resSlider -> GetNextElement()){
    $arItem = $obElement->GetFields();
    $arItem['PROP'] = $obElement->GetProperties();
    $arResult['SLIDER'][] = $arItem;
}

//Подключение 1С и получение данных

require_once $_SERVER["DOCUMENT_ROOT"] . $this->GetPath() . "/SoapConfig.php";
require_once $_SERVER["DOCUMENT_ROOT"] . $this->GetPath() . "/SoapClient.php";

use Volsu\Soap\SoapConfig;
use Volsu\Soap\SoapClient;

$cacheFileName = $_SERVER["DOCUMENT_ROOT"] . $this->GetPath() . "/cache/data.json";

$config = null;
$institutes = [];
$cache = [];
$cacheChange = false;

if ($_GET['clear_cache'] != '1') {
	$cache = (array)json_decode(file_get_contents($cacheFileName) ?? []);
} else {
	unlink($cacheFileName);
}

$configWS = new SoapConfig('http://is.volsu.ru/1csupertest/ws/ws1.1cws?wsdl', 'WebServices', '123');
$configPriem = new SoapConfig('http://is.volsu.ru/1csupertest/ws/priem.1cws?wsdl', 'WebServices', '123');

$id_institute = $arParams['NAME_OF_INSTITUTE'];
$arResult['NAME_OF_INSTITUTE'] = $cache['directions'][$id_institute]->FacultetName;

$arResult['DIRECTIONS'] = getDirection($arResult['NAME_OF_INSTITUTE'], $configWS, $cache, $cacheChange);

$departments = [];
foreach($arResult['DIRECTIONS'] as $direction){
    array_push($departments, $direction->Kafedra);
}
$departments = array_diff($departments, array(''));
$departments = array_unique($departments);
$arResult['DEPARTMENTS'] = $departments;


$directions = [];
foreach($arResult['DIRECTIONS'] as $ITEM){
    sortDirection($directions, $ITEM);
}
$arResult['DIRECTIONS'] = $directions;


if ($cacheChange) {
	file_put_contents($cacheFileName, json_encode($cache));
}

$this->IncludeComponentTemplate();

function sortDirection(&$array, $ITEM){
    for($i=0;$i<count($array);$i++){
        if($ITEM->EducationFormName == $array[$i]->EducationFormName &&
        $ITEM->EducationLevelName == $array[$i]->EducationLevelName &&
        $ITEM->SpecialityName == $array[$i]->SpecialityName){
            $array[$i]->FinanceName .= '/' . $ITEM->FinanceName;
            return;
        }
    }
    array_push($array, $ITEM);
}

function getDirection($institute, $configWS, &$cache, &$cacheChange){
    $directions = getAllDirections($configWS, $cache, $cacheChange);
    $array = [];
    foreach($directions as $direction){
        if($institute == $direction->FacultetName){
            $array[] = $direction;
        }
    }
    return $array;
}

function getAllDirections($configWS, &$cache, &$cacheChange) {
    if (!key_exists('directions', $cache) || $_GET['clear_cache'] == '1') {
        $client = new SoapClient($configWS, 'GetStringsPriema');
        $response = $client->getResponse();
        $cacheChange = true;
        $cache['directions'] = $response->StringsPlanPriema->StringPlanPriema;
        return $response->StringsPlanPriema->StringPlanPriema;
    } else {
        return $cache['directions'];
    }
}




?>