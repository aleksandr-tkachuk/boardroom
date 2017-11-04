<?php
class EmployeelistController extends BaseController{


    public function index(){
        $this->showBackButton = true;
        $users = User::model()->findAll();
        $this->render("index", ["users"=> $users]);

    }

    public function update() {
        $this->showBackButton = true;
        if(isset($_POST['submit'])){  
            $user = Employeelist::model()->find($_POST['hidden']); 
            $user->users_name = $_POST['user'];
            $user->save();
            header('Location: index.php?c=employeelist&a=index');
        }
        $users = Employeelist::model()->find($_GET['users_id']);
        $this->render('update', ['user'=>$users]);

    }

    public function remove() {
        if(isset($_GET['users_id'])){
            $users = Employeelist::model()->find($_GET['users_id']);
            $users->delete();
        }
        header('Location: index.php?c=employeelist&a=index');

    }

    public function create() {
        $this->showBackButton = true;
        if(isset($_POST['submit'])){
            $users = new User();
            $users->users_name = $_POST['name'];
            $users->users_login = $_POST['login'];
            $users->users_password = md5($_POST['password']);
            $users->users_role = $_POST['role'];

           // var_dump($users);
            $users->save();
            header('Location: index.php?c=employeelist&a=index');
        }
        $this->render("create", []);
    }

}
