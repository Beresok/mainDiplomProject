<?
    class CartController{
        public function actionAdd($id){

            // Добавляем товар в корзину
            Cart::addProduct($id);

            // Возвращаем на страницу с которой пользователь пришел
            $referrer = $_SERVER['HTTP_REFERER'];
            header("Location: $referrer");
        }

        public function actionAddAjax($id){
            // Добавление товара в корзину
            echo Cart::addProduct($id);

            return true;
        }

        public function actionDelete($id){
            Cart::deleteProduct($id);
            header('Location: /cart/');
        }

        public function actionIndex(){

            $categories = array();
            $categories = Category::getCategoryList();

            $productsInCart = false;

            // Получаем данные из корзины
            $productsInCart = Cart::getProducts();

            if ($productsInCart){
                // Получаем полную информацию о товарах для списка
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);

                // Получаем общую стоимость товаров
                $totalPrice = Cart::getTotalPrice($products);
            }

            require_once (ROOT.'/views/cart/index.php');

            return true;
        }

        public function actionCheckout(){

            // Получаем список категорий
            $categories = array();
            $categories = Category::getCategoryList();

            // Статус успешного оформления заказа
            $result = false;

            if (isset($_POST['submit'])){
                $userName = $_POST['userName'];
                $userPhone = $_POST['userPhone'];
                $userComment = $_POST['userComment'];

                // Валидация полей

                $errors = false;

                if (!User::checkName($userName)){
                    $errors[] = 'Неправильное имя';
                }

                if (!User::checkPhone($userPhone)){
                    $errors[] = 'Неправильный телефон';
                }

                // Форма заполнена корректно
                if ($errors == false){
                    $productsInCart = Cart::getProducts();
                    if (User::isGuest()){
                        $userId = false;
                    } else {
                        $userId = User::checkLogged();
                    }

                    // Сохраняем заказ в БД
                    $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                    if ($result){
                        $adminEmail = 'dzakob@mail.ru';
                        $message = 'Сообщение';
                        $subject = 'Тема';

                        mail($adminEmail,$subject,$message);

                        Cart::clear();
                    }
                } else {
                    $productsInCart = Cart::getProducts();
                    $productsIds = array_keys($productsInCart);
                    $products = Product::getProductsByIds($productsIds);
                    $totalPrice = Cart::getTotalPrice($products);
                    $totalQuantity = Cart::countItem();
                }
            } else {
                $productsInCart = Cart::getProducts();
                if ($productsInCart == false){
                    header('Location: /');
                } else {
                    $productsIds = array_keys($productsInCart);
                    $products = Product::getProductsByIds($productsIds);
                    $totalPrice = Cart::getTotalPrice($products);
                    $totalQuantity = Cart::countItem();

                    $userName = false;
                    $userPhone = false;
                    $userComment = false;

                    if (User::isGuest()){

                    } else {
                        $userId = User::checkLogged();
                        $user = User::getUserById($userId);

                        $userName = $user['name'];
                    }
                }
            }

            require_once (ROOT.'/views/cart/checkout.php');

            return true;
        }
    }
?>