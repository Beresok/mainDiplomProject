<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->AddHeadScript('/bitrix/templates/sky_cars_main/js/fancybox/jquery.fancybox.pack.js');
$APPLICATION->SetAdditionalCSS("/bitrix/templates/sky_cars_main/js/fancybox/jquery.fancybox.css");

if($_GET['PAGEN_1']) $APPLICATION->SetPageProperty("title", "Отзывы стр. ".$_GET['PAGEN_1'] );



?>
<script type="text/javascript">$('a.fb, a.fancyB').fancybox();</script>


<div class="CONTENT CONTENT_PAGE">

    <section id="svc-pages">
        <h1>Отзывы о дилерском центре <?=$INFO_SITE['SITE_NAME']['VALUE']?></h1>



        <? if(empty($_GET['PAGEN_1'])) $APPLICATION->IncludeFile("/includes/tpl_content/reviews/video_rewiev.php", array(), array());?>
        <? if(empty($_GET['PAGEN_1'])) $APPLICATION->IncludeFile("/includes/tpl_content/reviews/video_rewiev_footer.php", array(), array());?>


        <?$kcdrt = 0;?>
        <div class="reviewFlex">
            <?foreach($arResult["ITEMS"] as $arItem):?>

                <?$kcdrt++;
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>

                <?if(!empty($arItem['PROPERTIES']['VIDEO_OTZYV']['VALUE'])){?>
                    <div class="ReviewItem" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <? if ($arItem['NAME']) { ?>
                            <h2 class="ReviewItem_Name" ><?=$arItem['NAME']?></h2>
                        <? } ?>
                        <video style="background: #000;" title="<?=$arItem['NAME']?>" class="videReviews" controls  src="<?=CFile::GetPath($arItem['PROPERTIES']['VIDEO_OTZYV']['VALUE']);?>" width="100%" height="420"></video>
                        <?=$arItem['DETAIL_TEXT']?>
                    </div>

                <?}else{?>

                    <div class="ReviewItem" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                        <div class="ReviewItem_imagesBlock">
                            <?if ($arItem['DETAIL_PICTURE']['SRC']) { ?>
                                <a class="fancyB reviewLink" rel="group<?=$kcdrt;?>"   href="<?=$arItem['DETAIL_PICTURE']['SRC']?>">
                                    <? $ava = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width'=>200, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                                    <img class="img_ava_otz"   src="<?=$ava['src']?>"   >
                                </a>
                            <? } ?>
                            <?if ($arItem['PREVIEW_PICTURE']['SRC']) { ?>
                                <a class="fancyB reviewLink" rel="group<?=$kcdrt;?>" href="<?=$arItem['PREVIEW_PICTURE']['SRC']?>">
                                    <? $pismo = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>200, 'height'=>300), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
                                    <img class="img_ava_otz_rew" src="<?=$pismo['src']?>"  />
                                </a>
                            <? } ?>
                        </div>

                        <div class="ReviewItem_infoText" >
                            <div class="ReviewItem_Name"><?=$arItem['NAME']?></div>
                            <div class="ReviewItem_descript"><?=$arItem['DETAIL_TEXT']?></div>
                        </div>

                    </div>

                <?}?>
            <?endforeach;?>
        </div>

        <div style="clear: both;">
            <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                <?=$arResult["NAV_STRING"]?>
            <?endif;?>

            <div style="height: 30px; clear: both"></div>
    </section>
</div>

