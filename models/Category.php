<?php
    class Category {
        public static function getCategoryList(){
            $db = Db::getConnection();
            $categoryList = array();

            $result = $db->query('SELECT id, name FROM category'
            .' ORDER BY sort_order ASC',PDO::FETCH_ASSOC);

            $i = 0;

            while ($row = $result->fetch()){
                $categoryList[$i]['id'] = $row['id'];
                $categoryList[$i]['name'] = $row['name'];
                $i++;
            }

            return $categoryList;

        }
    }
?>