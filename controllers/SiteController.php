<?php
    class SiteController{
        public function actionIndex(){

            $categoryList = array();
            $categoryList = Category::getCategoryList();

            $productsList = array();
            $productsList = Product::getLastesProducts();

            require_once (ROOT.'/views/site/index.php');

            return true;
        }
    }
?>