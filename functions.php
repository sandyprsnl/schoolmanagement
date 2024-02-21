<?php
 require_once 'commonfiles/db.php';
 //connection name = $conn
 require_once "commonfiles/phpMailer/PHPMailer.php";
 require_once "commonfiles/phpMailer/SMTP.php";


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
		$columns ="*";
	}
	$DBcolumns= ($columns=="*")?$columns:"`".$columns."`";
	$sql = "SELECT ".$DBcolumns." FROM `".$table."` ";
	
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

function redirect($filename) {
    if (!headers_sent())
        header('Location: '.$filename);
    else {
        echo '<script type="text/javascript">';
        echo 'window.location.href = \''.$filename.'\';';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=\''.$filename.'\'" />';
        echo '</noscript>';
    }
    exit();
}

function sendMail($userMail,$userName,$subject,$hTMLbody,$noHTMLbody=''){
	$mail = new PHPMailer(true);
					// Server settings
    //$mail->SMTPDebug = 2;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'sandbox.smtp.mailtrap.io';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = '797ab74371109a';                     // SMTP username
    $mail->Password   = '1a17f789bf7d1d';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 2525;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    // Recipients
    $mail->setFrom('info@dashboard.com', 'Information');
    $mail->addAddress($userMail, $userName);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@dashboard.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $hTMLbody;
    $mail->AltBody = $noHTMLbody;

    $mail->send();
    echo 'Message has been sent';
}
