<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<!--<pre style="text-align: left">--><?//print_r($arResult)?><!--</pre>-->
<div class="filter">
	<?foreach($arResult['FORMS'] as $html):?>
			<div class="item">
			<?=$html?>
			</div>
	<?endforeach?>
</div>