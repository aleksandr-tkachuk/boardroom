<?php
class EmployeelistController extends BaseController{

    /*
    * employer list
    */
    public function index(){
        $users = User::model()->findAll();
        $errorDeleteUser = (isset($_SESSION["errorDeleteUser"])) ? $_SESSION["errorDeleteUser"] : "";
        unset($_SESSION["errorDeleteUser"]);

        $this->render("index", ["users"=> $users, 'errors' => $errorDeleteUser]);

    }

    /*
    * employer update form
    */
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

    /*
    * employer delete
    */
    public function remove() {
        if(isset($_GET['users_id'])){
            $countAdmins = sizeof(Employeelist::model()->findAll(["users_role" => 1]));
            $users = Employeelist::model()->find($_GET['users_id']);

            if($countAdmins == 1 && $users->users_role == 1 ){
                $_SESSION["errorDeleteUser"] = "Can't delete last admin";
                header('Location: index.php?c=employeelist&a=index');
            }else {
                // print_r($users);
                $users->delete();
            }
        }
       header('Location: index.php?c=employeelist&a=index');

    }

    /*
    * employer create
    */
    public function create() {
        $formError = '';
        if(isset($_POST['submit'])){
            $user = User::model()->findByLogin($_POST["login"]);

            if($user != null){
                $formError = 'Login is exists';
            }else{
                $users = new User();
                $users->users_name = $_POST['name'];
                $users->users_login = $_POST['login'];
                $users->users_password = md5($_POST['password']);
                $users->users_role = $_POST['role'];

                $users->save();
                header('Location: index.php?c=employeelist&a=index');
            }

        }
        $this->render("create", ['formError' => $formError]);
    }

}
