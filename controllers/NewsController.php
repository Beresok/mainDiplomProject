<?php

    include_once ROOT.'/models/News.php';

    class NewsController{

        public function actionIndex(){
            echo 'Просмотр списка новостей';
            return true;
        }

        public function actionView($category, $id){
            echo "<br>Категория: $category";
            echo "<br>id новости: $id";
            return true;
        }
    }
?>