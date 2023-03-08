<?php
    session_start();
    require_once('db_connection.php');

    $encryptedID = myUrlEncode($_GET['id']);
	
	function myUrlEncode($string) {
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		return str_replace($entities, $replacements, urlencode($string));
	}

    /*##########DECRYPTING DOC_ID*#############*/
	// Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';
    // Store the decryption key
    $decryption_key = openssl_digest(php_uname(), 'MD5', TRUE); 
	// Store cipher method 
	$ciphering = "AES-128-CTR"; 
	$options = 0; 

	// Use openssl_decrypt() function to decrypt the data
    $project_id = openssl_decrypt ($encryptedID, $ciphering,
    $decryption_key, $options, $decryption_iv);
	/*##########ENCRYPTING DOC_ID*#############*/

    // echo $project_id;


    $sql1 = $db->prepare("DELETE FROM CERTIFICATE_DATA WHERE PROJECT_ID = :project_id");
    $sql1->bindParam(':project_id', $project_id);
    $sql1->execute();
    $countCert = $sql1->rowCount();

    $sql2 = $db->prepare("DELETE FROM FILE WHERE PROJECT_ID = :project_id");
    $sql2->bindParam(':project_id', $project_id);
    $sql2->execute();
    $countFile = $sql2->rowCount();

    $sql3 = $db->prepare("DELETE FROM RESEARCH_PROJECT WHERE PROJECT_ID = :project_id");
    $sql3->bindParam(':project_id', $project_id);
    $sql3->execute();
    $countProject = $sql3->rowCount();


    if($countCert>0 && $countProject || $countFile > 0){
        echo "<script language = 'javascript'> window.location = '../SUPERVISOR/list_res_project'</script>";
    }
    else{
        var_dump($db->errorInfo());
        echo "<br>";
        // print_r($stmtRP->errorInfo());
    }

?>