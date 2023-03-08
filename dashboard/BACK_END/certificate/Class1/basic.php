<?php
    require('../fpdf/fpdf.php');
    require_once('../../db_connection.php');

    $encryptedID = myUrlEncode($_GET['id']);
	
	function myUrlEncode($string) {
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		return str_replace($entities, $replacements, urlencode($string));
	}

    //$name = text to be added, $x= x cordinate, $y = y coordinate, $a = alignment , $f= Font Name, $t = Bold / Italic, $s = Font Size, $r = Red, $g = Green Font color, $b = Blue Font Color
    function AddText($pdf, $text, $x, $y, $a, $f, $t, $s, $r, $g, $b) {
        $pdf->SetFont($f,$t,$s);	
        $pdf->SetXY($x,$y);
        $pdf->SetTextColor($r,$g,$b);
        $pdf->Cell(0,10,$text,0,0,$a);	
    }

    function split6($text)
    {
        $array = array();
        foreach(explode(' ',$text) as $i=>$word)
        {
            if($i%6) {
                $array[floor($i/6)] .= ' '.$word;
            } else {
                $array[$i/6] = $word;
            }
        }
        return $array;
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
    $cert_id = openssl_decrypt ($encryptedID, $ciphering,
    $decryption_key, $options, $decryption_iv);

    $stmt = $db->prepare("SELECT * FROM CERTIFICATE_DATA CD 
    JOIN RESEARCH_PROJECT RP ON CD.PROJECT_ID = RP.PROJECT_ID 
    JOIN PROGRAMME P ON RP.PROGRAMME_ID = P.PROGRAMME_ID 
    JOIN STUDENT S ON RP.STUDENT_ID = S.STUD_ID 
    WHERE CD.CERT_ID = :cert_id;");
    $stmt->bindParam(":cert_id", $cert_id);
    $stmt->execute(); 
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $ic = $row["STUD_IC"];
    // $ic = "000823-10-1735";

    $programme1 = strtoupper($row["PROGRAMME_NAME"]);
    // $programme1 = strtoupper("Bachelor of Sports Management (Hons.)");
    $cert_title = strtoupper("Research Project in Sport and Recreation");

    $original_stud_name = $row["STUD_NAME"];
    // $original_stud_name = "MUHAMMAD AIDID AIZAD BIN ABD RAHIM BIN IZMIR HARIZE";
    $stud_name = split6($original_stud_name);
    $size = sizeof($stud_name);


    $title = strtoupper($row["PROJECT_TITLE"]);
    // $title = strtoupper("Requirements Engineering for Barbershop System");
    $title_sp = split6($title);
    $size_title = sizeof($title_sp);

    $year = date('Y',strtotime($row['PROJECT_SUBMISSION_DATE']));;

    // echo $programme1 . "<br/>";
    // echo $original_stud_name . "<br/>";
    // echo $ic . "<br/>";
    // echo $title . "<br/>";

    // $counter=0; $cell = 80;
    // for($counter = 0; $counter < $size; $counter++){
    //     echo $stud_name[$counter] . "<br>";

    //     $cell += 10;
    // }

    //Create A 4 Landscape page
    $pdf = new FPDF('L','mm','A4'); //for landscape orientation
    // $pdf = new FPDF('P','mm','A4'); //for portrait orientation
    

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->SetCreator($original_stud_name);
    // Add background image for PDF
    $pdf->Image('../template_sijil2.png',0,0,0);	
    // $pdf->Image('../../../../dashboard_plugin/images/FYRAS-removebg-preview.png', 135, 150, -400);

    
    AddText($pdf,ucwords($cert_title), 10, 55, 'C', 'Times','B',20,0,0,0);
    //Add Student Name to the certificate
    $counter=0; $cell = 85;
    for($counter = 0; $counter < $size; $counter++){
        AddText($pdf,ucwords($stud_name[$counter]), 10, $cell, 'C', 'Times','B',26,0,0,0);

        $cell += 10;
    }
    AddText($pdf,ucwords($ic), 10, $cell, 'C', 'Times','i',20,0,0,0);
    AddText($pdf,ucwords($programme1), 10, $cell+10, 'C', 'Times','',20,0,0,0);
    AddText($pdf,ucwords("YEAR ".$year), 10, $cell+20, 'C', 'Times','',20,0,0,0);
    AddText($pdf,ucwords("(DEAN OF FSR)"), 10, $cell+70, 'C', 'Times','',20,0,0,0);

    // $cell = $cell + 40;
    // for($counter = 0; $counter < $size_title; $counter++){
    //     AddText($pdf,ucwords($title_sp[$counter]), 10, $cell, 'C', 'Times','B',20,0,0,0);

    //     $cell += 10;
    // }
    
    $pdf->Output();
?>