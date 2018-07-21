<?php

class Subject{
		//database connection and table name

private $conn;
private $table_name="subjects";

//object properties

public $subject_name;
public $subject_category;

public function __construct($db){
	$this->conn=$db;
}

//create user
function create(){
	//write query

try{
	$query="INSERT INTO ". $this->table_name . "(subject_name,subject_category) values(?,?)";
	$stmt=$this->conn->prepare($query);

	//bind values
	
	$stmt->bindParam(1,$this->subject_name);
	$stmt->bindParam(2,$this->subject_category);
	
	if($stmt->execute()){
		return true;
	}
	else{
		return false;
	}
	}
	
catch(Exception $ex){
	return $ex.errorMessage();
}

}

//select all data
function readAll(){
	$query="SELECT * FROM ". $this->table_name;
	$stmt=$this->conn->query($query);
	$output=array();
	$output=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $output;
}

function getLanguages(){
	$query="SELECT * FROM ". $this->table_name. " where subject_category='L'";
	$stmt=$this->conn->query($query);
	$output=array();
	$output=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $output;
}

function filterSubjects(){
	$query="SELECT * FROM ". $this->table_name. " where subject_category=?";
	$stmt=$this->conn->prepare($query);
	$stmt->bindParam(1,$this->subject_category);
	$output=array();
	$stmt->execute();
	$output=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $output;
}

function editSubjectName($oldsubject){
	$query="UPDATE ".$this->table_name." set subject_name=? where subject_name=?";
	$stmt=$this->conn->prepare($query);

	//bind values
	
	$stmt->bindParam(1,$this->subject_name);
	$stmt->bindParam(2,$oldsubject);
	
	if($stmt->execute()){
		return true;
	}
	else{
		return false;
	}
}

}