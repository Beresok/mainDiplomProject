<?
    class UserController {

        public function actionRegister(){

            $name = '';
            $email = '';
            $password = '';
            $result = false;


            if (isset($_POST['submit'])){

                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $errors = false;

                if (!User::checkName($name)){
                    $errors[] = 'Имя не должно быть короче 2-х символов';
                }

                if (!User::checkPassword($password)){
                    $errors[] = 'Пароль не должен быть короче 6-ти символов';
                }

                if (!User::checkEmail($email)){
                    $errors[] = 'Неправильный e-mail';
                }

                if (!User::checkEmailExist($email)){
                    $errors[] = 'Такой e-mail уже существует';
                }

                if ($errors == false){
                    $result = User::register($name, $email, $password);
                }

            }

            require_once(ROOT.'/views/user/register.php');

            return true;
        }

        public function actionlogin(){

            $email = '';
            $password = '';

            if (isset($_POST['submit'])){
                $email = $_POST['email'];
                $password = $_POST['password'];

                $errors = false;

                //Валидация полей
                if (!User::checkEmail($email)){
                    $errors[] = 'Неправильный email';
                }

                if (!User::checkPassword($password)){
                    $errors[] = 'Пароль не должен быть короче 6-ти символов';
                }

                // Проверяем существует ли пользователь
                $userId = User::checkUserData($email, $password);

                if ($userId == false){
                    $errors[] = 'неправильные данные для входа на сайт';
                } else {
                    User::auth($userId);
                    header("Location: /cabinet/");
                }

            }

            require_once(ROOT.'/views/user/login.php');

            return true;
        }

        public static function actionLogout(){
            unset($_SESSION['user']);
            header("Location: / ");
        }

    }
?>