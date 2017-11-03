<?php
class BookitController extends BaseController{

    public function index(){

        $user = Employeelist::model()->find($_SESSION['userId']);
        $users = Employeelist::model()->findAll();
        $this->render("index", ["user"=> $user,"users"=>$users]);

    }
}
