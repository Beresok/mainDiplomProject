<?php

    include_once ROOT.'/models/News.php';

    class NewsController{

        public function actionIndex(){

            $newsList = array();
            $newsList = News::getNewsList();
            include_once (ROOT.'/views/news/index.php');

            return true;

        }

        public function actionView($id){
            $newsItem = News::getNewsById($id);
            include_once (ROOT.'/views/news/view.php');

            return true;
        }
    }
?>