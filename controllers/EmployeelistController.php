<?php
class EmployeelistController extends BaseController{

    public function index(){

        $Employeelist = Employeelist::model()->findAll();            
        $this->render("index", ["Employeelist"=> $Employeelist]);

    }

    public function update() {
        if(isset($_POST['submit'])){     
            $Employeelist = Employeelist::model()->find($_POST['hidden']); 
            $Employeelist->users_name = $_POST['users'];
            $Employeelist->save();
            //print_r($Employeelist);
            header('Location: index.php?c=employeelist');
        }
        $editId = (isset($_GET['users_id'])) ? $_GET['users_id'] : 0;
        $edits = new Employeelist();
        $Employeelist = $edits->find($editId);
        $result = [];

        foreach ($Employeelist as $list => $value){
            $result[$list] = $value;

        }

        $this->render("update", ["employeelist"=> $result]); 
    }

    public function delete() {

        if(isset($_GET['users_id'])){
            $author = Employeelist::model()->find($_GET['users_id']); 
            $author->delete();
        }
        header('Location: index.php?c=employeelist');

    }

    public function create() {

        if(isset($_POST['submit'])){ 
            $employeelist = new Employeelist();
            $employeelist->users_name = $_POST['users'];
            $author->save();
            header('Location: index.php?c=employeelist');
        }
        $this->render("create", []);
    }
