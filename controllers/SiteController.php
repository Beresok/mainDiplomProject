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

        public function actionContact(){

            $userEmail = '';
            $userText = '';

            $result = false;

            if (isset($_POST['submit'])){

                $userEmail = $_POST['userEmail'];
                $userText = $_POST['userText'];

                $errors = false;

                if (!User::checkEmail($userEmail)){
                    $errors[] = 'Неправильный E-mail';
                }

                if ($errors == false){

                    $mail = 'dzakob@mail.ru';
                    $subject = "Тема письма {$userText}. От {$userEmail}.";
                    $message = 'Текст сообщения';
                    $result = mail($mail,$subject,$message);
                    $result = true;

                }
            }

            require_once (ROOT.'/views/site/contact.php');

            return true;
        }
    }
?>