<?
    class AdminController extends AdminBase {

        public function actionIndex(){

            self::checkAdmin();

            include_once (ROOT.'/views/admin/index.php');

            return true;
        }

    }
?>