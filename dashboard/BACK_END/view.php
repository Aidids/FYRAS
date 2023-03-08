<?php
	session_start();
	require 'db_connection.php'; 
?>
<html>
	<head>
		<title>
			<?php
				// echo $doc_name[1];
			?>
		</title>
	</head>
</html>
<?php
	$encryptedID = myUrlEncode($_GET['id']);
	
	function myUrlEncode($string) {
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		return str_replace($entities, $replacements, urlencode($string));
	}

    // echo $encryptedID;

	/*##########DECRYPTING DOC_ID*#############*/
	// Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';
    // Store the decryption key
    $decryption_key = openssl_digest(php_uname(), 'MD5', TRUE); 
	// Store cipher method 
	$ciphering = "AES-128-CTR"; 
	$options = 0; 

	// Use openssl_decrypt() function to decrypt the data
    $doc_id = openssl_decrypt ($encryptedID, $ciphering,
    $decryption_key, $options, $decryption_iv);
	/*##########ENCRYPTING DOC_ID*#############*/

	// echo "<br>" . $doc_id;

	$stmtID = $db->prepare("SELECT PROJECT_ID FROM FILE WHERE FILE_ID = :doc_id");
	$stmtID->bindParam(':doc_id', $doc_id);
	$stmtID->execute();
	$rowID = $stmtID->fetch(PDO::FETCH_ASSOC);
	$project_id = $row["PROJECT_ID"];


	$stmtUpdate = $db->prepare("UPDATE RESEARCH_PROJECT SET PROJECT_VIEW_TOTAL = PROJECT_VIEW_TOTAL + 1 
	WHERE PROJECT_ID = :project_id");
	$stmtUpdate->bindParam(':project_id', $project_id);
	$stmtUpdate->execute();


	
	$sql = $db->prepare("SELECT * FROM FILE WHERE FILE_ID = :doc_id");
	$sql->bindParam(':doc_id',$doc_id);
	$sql->execute();

    while($row = $sql->fetch(PDO::FETCH_ASSOC)){
        $file = '../../Documents/';
        $filename = $row['FILE_NAME'];

		$doc_name = explode('-', $filename);

		// Header content type
		header('Content-type: application/pdf');
		// header('Content-Disposition: inline; filename='.$doc_name[1]);
		header('Content-Disposition: inline; filename="' . $doc_name[1] . '"');
		header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

		// Read the file
		@readfile($file.$filename); 
    }
?>

