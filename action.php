<?php session_start(); 
if(isset($_SESSION['test'])){
    echo $_SESSION['test'];
}unset($_SESSION['test']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>action</title>
</head>

<body>
    <form action="testing.php" method="POST">
        <input type="email" placeholder="Current Email" name="c_email">
        <input type="email" placeholder="Enter new email" name="email">
        <button type="submit">submit</button>
    </form>
</body>

</html>