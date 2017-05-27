<?php
    class CatalogController {

        public function actionIndex(){

            $categoryList = array();
            $categoryList = Category::getCategoryList();

            $productsList = array();
            $productsList = Product::getLastesProducts(12);

            require_once (ROOT.'/views/catalog/index.php');

            return true;
        }

        public function actionCategory($categoryId, $page = 1){

            echo "<br>Category: $categoryId";
            echo "<br>Page: $page";

            $categoryList = array();
            $categoryList = Category::getCategoryList();

            $categoryProduct = array();
            $categoryProduct = Product::getProductByCategory($categoryId, $page);

            $total = Product::getTotalProductsInCategory($categoryId);

            // Создание объекта Pagination - постраничная навигация
            $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

            require_once (ROOT.'/views/catalog/category.php');

            return true;


        }

    }
?>