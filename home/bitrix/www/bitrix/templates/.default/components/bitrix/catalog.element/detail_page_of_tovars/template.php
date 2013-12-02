<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
} ?>
<? $arResult['DETAIL_TEXT'] = str_replace("[br]", "<br>", $arResult['DETAIL_TEXT']); ?>
<? //print_r($arResult)?>
<!--<pre style = "text-align: left">--><?//print_r($arResult)?><!--</pre>-->
<div style = "overflow: hidden;">
	<h1><?=$arResult['NAME']?></h1><br>
	<hr>
	<div style = "float: left;">
		<div style = "width:500px; overflow:hidden; padding-top:10px;">
			<?$img = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'],array('width' => 400,'height'=> 500))?>
			<a class="fancy" href="<?=$arResult['DETAIL_PICTURE']['SRC']?>"><img title = "<?= $arResult['NAME'] ?>" src = "<?= $img['src']
				?>"/></a>
		</div>
	</div>
	<div style = "float: left; width: 300px; margin: 30px;">
		<div class="catalog-price">
			<?=$arResult['PROPERTIES']['PRICE']['VALUE']?> р.
		</div>

		<span style = "text-align:left;"><h2>Описание</h2></span>
		<br>
		<table class="properties">
			<?foreach ($arResult['PROPERTIES']['XML_PROP']['DESCRIPTION'] as $key => $vol): ?>
				<tr>
					<td><?=$vol?></td>
					<td><?=$arResult['PROPERTIES']['XML_PROP']['VALUE'][$key]?></td>
				</tr>
			<? endforeach?>
		</table>
		<div style = "text-align:left; width:400px;">
			<?=str_replace("\n", "<br>", $arResult['~DETAIL_TEXT'])?>
		</div>

	</div>


	<!--    <h3>Производитель: --><?//=strip_tags($arResult['DISPLAY_PROPERTIES']['BRAND']['DISPLAY_VALUE'])?><!--</h3>-->
</div>



