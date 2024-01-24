<?php
 require_once 'commonfiles/db.php';
 //connection name = $conn


function selectFromDB($columns=[],$table='',$whereColumns=[],$condition='OR',$orderBy=''){
	if( empty($table)){
		return [
		'success'=>false,
		'data'=>''
		];
	}
	if(is_array($columns) &&!empty($columns)){
		$columns = implode('`, `',$columns);
	}
	else{
		$columns =" *";
	}
	
	$sql = "SELECT `".$columns."` FROM `".$table."` ";
	
	if(is_array($whereColumns) &&!empty($whereColumns)){
		$i=0;
		$where = " WHERE ";
		foreach($whereColumns as $key =>$val){
			if($i>0 ){
				$where.= " ".$condition." ";
			}
			$where.= $key." = ".$val;
	
		$i++;
		}
		$sql.= $where;
	}
	return $sql ;
	
}

function getDateFromDb($query,$getResult=true){
	$result= mysqli_query(DB_CONN,$query);
	if($getResult){
		if(mysqli_num_rows($result)>0){
		return mysqli_fetch_assoc( $result);
	}
	}else{
		return $result;
	}

	return '';
}

function updateInDB($columns=[],$table='',$whereColumns=[]){
	if((empty($columns)&& !is_array($columns)) || empty($table) || empty($whereColumns)){
		return;
	}
	$dbsolumns= '';
	$i=0;
	foreach($columns as $name=>$value){
		$dbsolumns.= "`".$name."` = '".$value."' , ";
	}
	
		if(is_array($whereColumns) &&!empty($whereColumns)){
		$i=0;
		$where = " WHERE ";
		foreach($whereColumns as $key =>$val){
			if($i>0 ){
				$where.= " ".$condition." ";
			}
			$where.= $key." = ".$val;
	
		$i++;
		}
	}
	$sql = "UPDATE ".$table. " SET ".rtrim($dbsolumns," , ").$where;
	return getDateFromDb($sql,false);
}

//setDBQuery(["education"=>"edu","address"=>"address","skills"=>"skill"],'user_details',["user_id"=>'2 ']);

function checkUserExistOrNot($whereColumns=[],$table=''){
		if(empty($whereColumns) || empty($table) || !is_array($whereColumns)){
		return;
	}
	if(count($whereColumns)>0){
		$condition='AND';
	}
	else{
		$condition='';
	}
	$selectQuery = selectFromDB(['id'],$table,$whereColumns,$condition);
	$result = getDateFromDb($selectQuery);
	if(!empty($result)){
		return true;
	}else{
		return false;
	}
}

function makeInsertQuery($columns=[],$table=''){
	
	if(empty($columns) || empty($table) || !is_array($columns)){
		return;
	}
	$keys= array_keys($columns);
	$dbColumns = implode('`, `',$keys);
	
		$values= array_values($columns);
	$dbColumnsValues = implode("', '",$values);
	
	$sql = "INSERT INTO `".$table."` (`".$dbColumns."`) VALUES('".$dbColumnsValues."')";
	
	getDateFromDb($sql,false);
	print_r($sql);
}

