<?
	if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
		die();
	}
	include_once('classes/forms.php');
	include_once('classes/filter.php');
	include_once('config/fields_type.php');


	CModule::IncludeModule('iblock');
	$section_id = $_REQUEST['SECTION_ID'];
	$q          = "
SELECT
  *
FROM
  `b_iblock_element_property` AS prop
WHERE prop.`IBLOCK_ELEMENT_ID` IN
  (SELECT
    el.`ID`
  FROM
    `b_iblock_element` AS el
  WHERE el.`IBLOCK_SECTION_ID` = {$section_id})
    AND NOT ISNULL(prop.`DESCRIPTION`)
GROUP BY prop.`DESCRIPTION`
	";

	$t = $DB->Query($q);
	while ($temp = $t->Fetch()) {
		$value[$temp['DESCRIPTION']]              = filter::GetValues($temp['DESCRIPTION']);
		$arResult['ITEMS'][]                      = $temp;
		$arResult['VALUES'][$temp['DESCRIPTION']] = $value[$temp['DESCRIPTION']];
	}


	$i = 0;
	foreach ($arResult['ITEMS'] as $de) {
		$i++;
		$description         = $de['DESCRIPTION'];
		$values              = $arResult['VALUES'][$description];
		$arResult['FORMS'][] = filter::GetHTMLForm($description, $values, "XML_PROP_{$i}",$types);
	}


	$this->IncludeComponentTemplate();


?>