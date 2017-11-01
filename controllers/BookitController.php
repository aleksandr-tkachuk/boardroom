<?php
class BookitController extends BaseController{

    public function index(){

        $user = Employeelist::model()->find($_SESSION['userId']);  
        $this->render("index", ["user"=> $user]);

    }
}
