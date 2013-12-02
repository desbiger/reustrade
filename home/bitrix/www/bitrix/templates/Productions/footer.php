</div>
<!-- #content-->
<?//$APPLICATION->IncludeComponent("bitrix:catalog.section", "brands", array(
//	"IBLOCK_TYPE" => "BRANDS",
//	"IBLOCK_ID" => "5",
//	"SECTION_ID" => "",
//	"SECTION_CODE" => "",
//	"SECTION_USER_FIELDS" => array(
//		0 => "",
//		1 => "",
//	),
//	"ELEMENT_SORT_FIELD" => "sort",
//	"ELEMENT_SORT_ORDER" => "asc",
//	"FILTER_NAME" => "arrFilter",
//	"INCLUDE_SUBSECTIONS" => "Y",
//	"SHOW_ALL_WO_SECTION" => "Y",
//	"PAGE_ELEMENT_COUNT" => "30",
//	"LINE_ELEMENT_COUNT" => "",
//	"PROPERTY_CODE" => array(
//		0 => "ABOUT_BRAND",
//		1 => "",
//	),
//	"SECTION_URL" => "",
//	"DETAIL_URL" => "",
//	"BASKET_URL" => "/personal/basket.php",
//	"ACTION_VARIABLE" => "action",
//	"PRODUCT_ID_VARIABLE" => "id",
//	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
//	"PRODUCT_PROPS_VARIABLE" => "prop",
//	"SECTION_ID_VARIABLE" => "SECTION_ID",
//	"AJAX_MODE" => "N",
//	"AJAX_OPTION_JUMP" => "N",
//	"AJAX_OPTION_STYLE" => "Y",
//	"AJAX_OPTION_HISTORY" => "N",
//	"CACHE_TYPE" => "N",
//	"CACHE_TIME" => "36000000",
//	"CACHE_GROUPS" => "N",
//	"META_KEYWORDS" => "-",
//	"META_DESCRIPTION" => "-",
//	"BROWSER_TITLE" => "-",
//	"ADD_SECTIONS_CHAIN" => "N",
//	"DISPLAY_COMPARE" => "N",
//	"SET_TITLE" => "Y",
//	"SET_STATUS_404" => "N",
//	"CACHE_FILTER" => "N",
//	"PRICE_CODE" => array(),
//	"USE_PRICE_COUNT" => "N",
//	"SHOW_PRICE_COUNT" => "1",
//	"PRICE_VAT_INCLUDE" => "Y",
//	"PRODUCT_PROPERTIES" => array(),
//	"USE_PRODUCT_QUANTITY" => "N",
//	"DISPLAY_TOP_PAGER" => "N",
//	"DISPLAY_BOTTOM_PAGER" => "Y",
//	"PAGER_TITLE" => "Товары",
//	"PAGER_SHOW_ALWAYS" => "Y",
//	"PAGER_TEMPLATE" => "",
//	"PAGER_DESC_NUMBERING" => "N",
//	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
//	"PAGER_SHOW_ALL" => "Y",
//	"AJAX_OPTION_ADDITIONAL" => ""
//), false);?>
<!-- logos -->

</div>
<!-- #container-->


<div class = "sidebar" id = "sideLeft">

	<div class = "left">

		<div class = "left_index">

			<h3>Каталог товаров</h3>


			<div class = "_news">
				<?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel_general", array(
					"ROOT_MENU_TYPE" => "razdels",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(),
					"MAX_LEVEL" => "3",
					"CHILD_MENU_TYPE" => "razdels",
					"USE_EXT" => "N",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "Y"
				), false);?>

				<?$APPLICATION->IncludeComponent("bitrix:news.list", "news_base", array(
					"IBLOCK_TYPE" => "news",
					"IBLOCK_ID" => "1",
					"NEWS_COUNT" => "3",
					"SORT_BY1" => "ACTIVE_FROM",
					"SORT_ORDER1" => "DESC",
					"SORT_BY2" => "",
					"SORT_ORDER2" => "",
					"FILTER_NAME" => "",
					"FIELD_CODE" => array(
						0 => "",
						1 => "",
					),
					"PROPERTY_CODE" => array(
						0 => "",
						1 => "",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => "N",
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"PAGER_TITLE" => "Новости",
					"PAGER_SHOW_ALWAYS" => "Y",
					"PAGER_TEMPLATE" => "",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "Y",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"AJAX_OPTION_ADDITIONAL" => ""
				), false);?>
			</div>
			<br/><br/>

		</div>
	</div>
</div>
<!-- .sidebar#sideLeft -->

</div>
<!-- #middle-->

</div>
<!-- #wrapper -->
<div id = "footer">
	<div class = "foot_line"></div>
	<div class = "copyright">
		© Rustrade.su 2011<br/>
		Все права защищены.<br/>
		Контактная информация<br/>
	</div>
	<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu", array(
		"ROOT_MENU_TYPE" => "general",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	), false);?>
</div>
<!-- #footer -->

</body>
</html>