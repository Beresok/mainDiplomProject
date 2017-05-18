<?php

require_once (ROOT.'/models/Category.php');
require_once (ROOT.'/models/Product.php');

    class CatalogController {

        public function actionIndex(){

            $categoryList = array();
            $categoryList = Category::getCategoryList();

            $productsList = array();
            $productsList = Product::getLastesProducts(12);

            require_once (ROOT.'/views/catalog/index.php');

            return true;
        }

        public function actionCategory($categoryId){

            $categoryList = array();
            $categoryList = Category::getCategoryList();

            $categoryProduct = array();
            $categoryProduct = Product::getProductByCategory($categoryId);


            require_once (ROOT.'/views/catalog/category.php');

            return true;


        }

    }
?>