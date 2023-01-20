<?php

	$address1=$_POST['modalAddress_1'];
	$address2=$_POST['modalAddress_2'];
	$city=$_POST['modalCity'];
	$state=$_POST['modalState'];
	$zipcode=$_POST['modalZipCode'];
    
    $databaseName="mailing_address";
    $databaseConnection=mysqli_connect("localhost","root","");
    mysqli_select_db($databaseConnection,$databaseName);

    $inserQuery="insert into address(address1, address2, city, state, zipcode)values('$address1', '$address2', '$city', '$state', '$zipcode')";

    $result=mysqli_query($databaseConnection,$inserQuery) or die('Query not executed');

    if($result>0)
    {
        echo "Data Inserted Successfully";
    }
    else
    {
        echo "Data Not Inserted";
    }

?>