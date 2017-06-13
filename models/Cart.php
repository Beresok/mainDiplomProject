<?
    class Cart{
        public static function addProduct($id){
            $id = intval($id);

            // Пустой массив для товаров в корзине
            $productInCart = array();

            // Если в корзине уже есть товары, они хранятся в сессии
            if (isset($_SESSION['products'])){
                // То заполним наш массив товарами
                $productInCart = $_SESSION['products'];
            }

            // Если товар есть в корзине, но был добавлен ещё раз, то добавляем количество
            if (array_key_exists($id, $productInCart)){
                $productInCart[$id]++;
            } else {
                // добавляем новый товар в корзину
                $productInCart[$id] = 1;
            }

            $_SESSION['products'] = $productInCart;

            return self::countItem();
        }

        public static function countItem(){
            if (isset($_SESSION['products'])){
                $count = 0;
                foreach ($_SESSION['products'] as $id => $quantity){
                    $count += $quantity;
                }
                return $count;
            } else {
                return 0;
            }
        }

        public static function getProducts(){
            if (isset($_SESSION['products'])){
                return $_SESSION['products'];
            }
            return false;
        }

        public static function getTotalPrice($products){

            $productsInCart = self::getProducts();
            $total = 0;

            if ($productsInCart){
                foreach ($products as $item){
                    $total += $item['price'] * $productsInCart[$item['id']];
                }
            }
            return $total;
        }
    }
?>