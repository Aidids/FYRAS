<?php
    require_once('db_connection.php');

    $encryptedID = myUrlEncode($_GET['id']);
	
	function myUrlEncode($string) {
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		return str_replace($entities, $replacements, urlencode($string));
	}

    // echo $encryptedID;
    
	// Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';
    // Store the decryption key
    $decryption_key = openssl_digest(php_uname(), 'MD5', TRUE); 
	// Store cipher method 
	$ciphering = "AES-128-CTR"; 
	$options = 0; 

	// Use openssl_decrypt() function to decrypt the data
    $del_prog_id = openssl_decrypt ($encryptedID, $ciphering,
    $decryption_key, $options, $decryption_iv);

    $stmtDel = $db->prepare("DELETE FROM PROGRAMME WHERE PROGRAMME_ID = :prog_id");
    $stmtDel->bindParam(":prog_id", $del_prog_id);

    $stmtDel->execute();

    $countDelete = $stmtDel->rowCount();

    if($countDelete > 0){
        echo "<script language = 'javascript'> window.location = '../OWNER/list_programme'</script>";
    }
    else{
        echo "error";
        print_r($db->errorInfo());
    }

?>