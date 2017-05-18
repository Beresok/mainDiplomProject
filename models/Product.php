<?php


class Product {

    const SHOW_BY_DEFAULT = 10;

    public static function getLastesProducts($count = self::SHOW_BY_DEFAULT){

        $count = intval($count);

        $db = Db::getConnection();
        $productsList = array();

        $result = $db->query('SELECT id, name, price, image, is_new  FROM product '
            .'WHERE status = "1" ORDER BY id DESC LIMIT '. $count);

        $i = 0;
        while ($row = $result->fetch()){
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productsList;

    }

    public static function getProductByCategory($categoryId = false){

        if ($categoryId){

            $db = Db::getConnection();
            $categoryProduct = array();

            $result = $db->query('SELECT id, name, price, image, is_new FROM product '
                . 'WHERE status = "1" AND category_id = '.$categoryId.' ORDER BY id DESC LIMIT '. self::SHOW_BY_DEFAULT);

            $i = 0;
            while ($row = $result->fetch()){
                $categoryProduct[$i]['id'] = $row['id'];
                $categoryProduct[$i]['name'] = $row['name'];
                $categoryProduct[$i]['price'] = $row['price'];
                $categoryProduct[$i]['image'] = $row['image'];
                $categoryProduct[$i]['is_new'] = $row['is_new'];
                $i++;
            }

            return $categoryProduct;

        }
    }

    public static function getProductById($productId){

        $productId = intval($productId);

        if ($productId){

            $db = Db::getConnection();
            $result = $db->query('SELECT * FROM product WHERE id = '.$productId);
            $result->setFetchMode(PDO::FETCH_ASSOC);

        }

        return $result->fetch();

    }

}