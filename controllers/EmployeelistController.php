<?php
class EmployeelistController extends BaseController{

    public function index(){

        $users = User::model()->findAll();
        $this->render("index", ["users"=> $users]);

    }

    public function update() {
        $user = Employeelist::model()->find($_GET['users_id']);
        print_r($user);

    }

    public function remove() {
        if(isset($_GET['users_id'])){
            $users = Employeelist::model()->find($_GET['users_id']);
            $users->delete();
        }
        header('Location: index.php?c=employeelist&a=index');

    }

    public function create() {

        if(isset($_POST['submit'])){
            $users = new User();
            $users->users_name = $_POST['author'];
            $users->save();
            header('Location: index.php?c=index');
        }
        $this->render("create", []);
    }
}