<?php
session_start();
require_once('../model/database.php');
//getting data from form
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$version = filter_input(INPUT_POST, 'version');
$release = filter_input(INPUT_POST, 'date', );


// code to save data to SQL database
//validating the inputs from add_contact_form
if ($code == null || $name == null || $version == null || $release == null) {
    $_SESSION['error'] = 'Invalid data. Please make sure all fields are filled';
    //redirecting to an error page
    $url = "../errors/error.php";
    header("Location: " . $url); //header is the method to redirect
    die(); // similar to return or break 
} else {

    //adding data to the database
    $query = "INSERT INTO products (productCode, name, version, releaseDate) VALUES (:code, :name, :version, :releaseDate)";
    $statement = $db->prepare($query);

    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':releaseDate', $release);

      $statement->execute();
      $statement->closeCursor();

}

$_SESSION['product'] = $name . ', version of (' . $version . ')';

// redirecting to confirmation page
header("Location: confirmation.php");
die();
?>
