<?php 
session_start();
require '../db.php';

    // Meal Account -----------------
if(isset($_POST['f_submit'])){
    $active_user = $_POST['name'];
    $f_money = $_POST['f_money'];
    $f_reason = 'My personal data update for: '.$_POST['f_reason'];

    $meal_sql = "INSERT INTO users_account (user, money, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($meal_sql);
    $stmt->bind_param("sds", $active_user, $f_money, $f_reason);
    $stmt->execute();
    $stmt->close();
    
    $meal_sql_history = "INSERT INTO history (user, money, description) VALUES (?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($meal_sql_history);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    // Bind the parameters (s = string, d = double)
    $stmt->bind_param("sds", $active_user, $f_money, $f_reason);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['meal_success'] = 'Your money has benn added!';
    } else {
        $_SESSION['meal_error'] = 'Something went wrong!';
    }

    // Close the statement
    $stmt->close();

    // Redirect to index.php
    header('location:../index.php');

}
?>