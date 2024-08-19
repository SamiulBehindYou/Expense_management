<?php 
require 'db.php';
require 'header.php';

if(isset($_POST['submit'])){
    $id = $_SESSION['user_id'];
    $password = $_POST['password'];
    // $after_implode = explode('',$password);
    if(!empty($password)){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
        $update = "UPDATE users SET password = '$password_hash' WHERE id = $id";

        if($conn->query($update)){
            $_SESSION['updated_success'] = 'Password successfully updated!';
        }
        else{
            $_SESSION['updated_error'] = 'Something went wrong!';
        }
    }
    else{
        $_SESSION['updated_error']= 'Input password!';
    }
    
}


?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card mt-2">
                <div class="card-header bg-info">
                    <h1 class="text-center text-white">Update user profile</h1>
                </div>
                <div class="card-body">
                <?php if(isset($_SESSION['updated_success'])){ ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['updated_success'] ?>
                    </div>
                <?php } unset($_SESSION['updated_success']) ?>
                    <form action="" method="POST">
                        <div class="mb-2">
                            <label class="form-label">Username</label>
                            <input type="text" readonly value="<?= $row['name'] ?>" class="form-control bg-white">
                            <small>Usename is not changable!</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" required name="password" class="form-control" placeholder="Input new password!">
                            <?php if(isset($_SESSION['updated_error'])){ ?>
                                <strong class="alert alert-danger">
                                    <?= $_SESSION['updated_error'] ?>
                                </strong>
                            <?php } unset($_SESSION['updated_error']) ?>
                        </div>
                        <div class="mb-0">
                            <input type="submit" name="submit" class="btn btn-info">
                            <a href="index.php" type="button" class="btn btn-outline-secondary m-2">Back to home!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>