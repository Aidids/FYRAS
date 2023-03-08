<?php
   try{
        $db = new PDO('mysql:host=localhost;dbname=fyras',"root","");

        // echo "SUCCESFULLY CONNECT!";
    }
    catch(PDOException $e){
        print "Error!: ". $e->getMessage(). "<br/>";
        die();
    }
?>