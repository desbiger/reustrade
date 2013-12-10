<?
include_once($_SERVER['DOCUMENT_ROOT']."/import/class/entero.php");

$result = entero::GetItemReg('/item/32903');
//$result = entero::GetItems('869');
//$result = entero::GetItemsReg('869');
//$result = entero::GetItemsFromOnePage("/list/698");
?>
<pre><?print_r($result)?></pre>