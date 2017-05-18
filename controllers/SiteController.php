<?php

require_once (ROOT.'/models/Category.php');
require_once (ROOT.'/models/Product.php');


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