<?php
    class Category {
        public static function getCategoryList(){
            $db = Db::getConnection();
            $categoryList = array();

            $result = $db->query('SELECT id, name FROM category WHERE status = "1" '
            .' ORDER BY sort_order ASC',PDO::FETCH_ASSOC);

            $i = 0;

            while ($row = $result->fetch()){
                $categoryList[$i]['id'] = $row['id'];
                $categoryList[$i]['name'] = $row['name'];
                $i++;
            }

            return $categoryList;

        }

        public static function getCategoryListAdmin(){

            $db = Db::getConnection();

            $result = $db->query('SELECT id, name, sort_order, status FROM category'
                .' ORDER BY sort_order ASC',PDO::FETCH_ASSOC);

            $categoryList = array();
            $i = 0;

            while ($row = $result->fetch()){
                $categoryList[$i]['id'] = $row['id'];
                $categoryList[$i]['name'] = $row['name'];
                $categoryList[$i]['sort_order'] = $row['sort_order'];
                $categoryList[$i]['status'] = $row['status'];
                $i++;
            }

            return $categoryList;
        }

        public static function getStatusText($statusFlag){
            if ($statusFlag == 1){
                $statusText = 'Активна';
                return $statusText;
            }
            $statusText = 'Не активна';
            return $statusText;
        }

        public static function getCategoryById($id){
            // Соединение с БД
            $db = Db::getConnection();
            // Текст запроса к БД
            $sql = 'SELECT * FROM category WHERE id = :id';
            // Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            // Выполняем запрос
            $result->execute();
            // Возвращаем данные
            return $result->fetch();
        }

        public static function updateCategoryById($id, $name, $sort_order, $status){

            $db = Db::getConnection();
            $sql = 'UPDATE category SET name = :name, sort_order = :sort_order, status = :status WHERE id = :id';

            $result = $db->prepare($sql);

            $result->bindParam(':id', $id, PDO::PARAM_INT);

            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
            $result->bindParam(':status', $status, PDO::PARAM_STR);

            $result->execute();

            return $result->execute();
        }

        public static function deleteCategoryById($id){

            $db = Db::getConnection();
            $sql = 'DELETE FROM category WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            $result->execute();

            return $result->execute();
        }

        public static function createCategory($name, $sort_order, $status){

            $db = Db::getConnection();
            $sql = 'INSERT INTO category (name, sort_order, status) VALUES (:name, :sort_order, :status)';

            $result = $db->prepare($sql);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':sort_order', $sort_order, PDO::PARAM_INT);
            $result->bindParam(':status', $status, PDO::PARAM_INT);

            if ($result->execute()) {
                return $db->lastInsertId();
            }
            return 0;
        }

    }
?>