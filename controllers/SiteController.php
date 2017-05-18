<?php

require_once (ROOT.'/models/Category.php');

    class SiteController{
        public function actionIndex(){

            $categoryList = array();
            $categoryList = Category::getCategoryList();

            require_once (ROOT.'/views/site/index.php');

            return true;
        }
    }
?>