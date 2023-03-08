<?php
    $ic = "000823101735";

    $ic = substr_replace($ic, "-", 6, 0);
    $ic = substr_replace($ic, "-", 9, 0);

    echo $ic;
?>