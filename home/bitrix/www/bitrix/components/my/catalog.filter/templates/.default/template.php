<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<!--<pre style="text-align: left">--><?//print_r($arResult)?><!--</pre>-->
<div class="filter">
	<form method="get">
	<?foreach($arResult['FORMS'] as $html):?>
			<div class="item">
			<?=$html?>
			</div>
	<?endforeach?>
		<input type="submit" name="FILTER_ACTION" value="Подобрать">
	</form>
</div>