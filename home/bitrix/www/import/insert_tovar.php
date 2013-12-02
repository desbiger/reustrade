<?
	require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");?>

<? require_once($_SERVER["DOCUMENT_ROOT"] . "/import/class/import.php"); ?>
<? require_once($_SERVER["DOCUMENT_ROOT"] . "/import/class/entero.php"); ?>
<?


	$arResult = entero::ListTovars();
	if (count($arResult) > 2) {
		foreach ($arResult as $key => $vol) {
			if ($key > 1) {

				$array = unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT']. "/import/tovars/{$vol}"));
				echo import::TovarAdd($array, $vol);
			}
		}
	}

?>
<!--	<pre>--><?//print_r($array)?><!--</pre>-->
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>