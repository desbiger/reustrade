<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
    <hr>

<?
    if ($_REQUEST['SECTION_ID']) {
        CModule::IncludeModule('iblock');
        $filter = array(
            'IBLOCK_ID' => 2,
            'SECTION_ID' => $_REQUEST['SECTION_ID']
        );
        $r = CIBlockSection::GetList(null, $filter);
        while ($t = $r->GetNext()) {
            $sections[] = $t;
        }
        $arResult['SECTIONS'] = $sections;
    }
?>
    <!--<pre style="text-align: left;">--><?// print_r($arResult['SECTIONS']) ?><!--</pre>-->


<? if (count($sections) > 0): ?>
    <div class="sections_link">
        <div class="cat_tit">
            <a class="nolist" href="#">Подразделы раздела</a> <img src="/bitrix/templates/Productions/img/marker2.png" alt="m2">
        </div>

        <? foreach ($sections as $value): ?>
            <? $img = CFile::ResizeImageGet($value['PICTURE'], array('width' => 200, 'height' => 200)) ?>
            <div class="section_div">
                <a href="/catalog/<?= $value['ID'] ?>/">
                    <div style="width: 200px; height: 150px; overflow: hidden;">
                        <img src="<?= $img['src'] ?>">
                    </div>
                    <?=$value['NAME']?></a>
            </div>
        <? endforeach ?>

    </div>
    <br>
    <hr>
<? endif ?>

<? if ($_REQUEST['ELEMENT_ID']): ?>
    <?$APPLICATION->IncludeComponent("bitrix:catalog.element", "detail_page_of_tovars", array(
            "IBLOCK_TYPE" => "products",
            "IBLOCK_ID" => "2",
            "ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
            "ELEMENT_CODE" => "",
            "SECTION_ID" => "",
            "SECTION_CODE" => "",
            "PROPERTY_CODE" => array(
                0 => "PRICECURRENCY",
                1 => "POPULAR",
                2 => "BRAND",
                3 => "LINE_NAME",
                4 => "LENGTH",
                5 => "WIDTH",
                6 => "HEIGHT",
                7 => "WES",
                8 => "TEMPERATURE",
                9 => "POWER",
                10 => "DETAIL_TEXT",
                11 => "",
            ),
            "SECTION_URL" => "",
            "DETAIL_URL" => "",
            "BASKET_URL" => "/personal/basket.php",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "CACHE_TYPE" => "N",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "META_KEYWORDS" => "-",
            "META_DESCRIPTION" => "-",
            "BROWSER_TITLE" => "NAME",
            "SET_TITLE" => "Y",
            "SET_STATUS_404" => "N",
            "ADD_SECTIONS_CHAIN" => "Y",
            "PRICE_CODE" => array(),
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "Y",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "PRODUCT_PROPERTIES" => array(),
            "USE_PRODUCT_QUANTITY" => "N",
            "LINK_IBLOCK_TYPE" => "",
            "LINK_IBLOCK_ID" => "",
            "LINK_PROPERTY_SID" => "",
            "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#"
        ),
        false
    );?>
<? else: ?>
    <div class="_catalog">
        <div class="cat_tit">
            <a href="#">Каталог товаров</a> <img src="/bitrix/templates/Productions/img/marker2.png" alt="m2">
        </div>


        <div class="cat_tov">
            <?foreach ($arResult['ITEMS'] as $item): ?>
                <?
                $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <? $file = CFile::ResizeImageGet($item['DETAIL_PICTURE']['ID'], array('width' => 150, 'height' => 150)); ?>

                <div class="tovar" id="<?= $this->GetEditAreaId($item['ID']); ?>">
                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><img src="<?= $file['src'] ?>" alt="1"></a>
                    <?=$item['NAME']?><br>
                    <br>
                                <span class="rr"> <?=$item['PROPERTIES']['PRICE']['VALUE']?> р.-</span>
                </div>

            <? endforeach?>

        </div>

        <p><?=$arResult["NAV_STRING"]?></p>
    </div>

<?endif ?>