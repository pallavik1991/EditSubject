<?php
include_once '/config/database.php';
include_once '/objects/subject.php';

$database=new Database();
$db=$database->getConnection();

//create Subject object
$subject=new Subject($db);
$msg="";

//fetch html input
 try{

        
    	if (empty($_POST["param_newsubject"])) 
               $msg.= "<br> Subject Name is required ";
        else if (!preg_match ("/^[a-zA-Z\s.]{3,20}$/",$_POST["param_newsubject"]))
              $msg.="Subject Name should be between 3-20 alphabets";
        else
            $subject->subject_name=$_POST["param_newsubject"];
        
    	$oldsubject=$_POST["param_oldsubject"];
    	
    	if(empty($msg))
        {
    	   $msg=$subject->editSubjectName($oldsubject);
           if($msg==true)
                $msg="Subject updated successfully";
            else
                $msg="Subject not updated";
            echo $msg;
        }
        else
        {
            //send validation errrors
           echo $msg;
        }
        
        

    }
    catch(Exception $ex)
    {
        $msg=$ex.errorMessage();
         echo $msg;
    }
     
 
?>