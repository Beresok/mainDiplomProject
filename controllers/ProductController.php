<?php
class ProductController{

        public function actionView($productId){

            $categoryList = array();
            $categoryList = Category::getCategoryList();

            $product = Product::getProductById($productId);

            require_once (ROOT.'/views/product/view.php');

            return true;

        }

    }
?>