<?php
require 'db.php';
require 'header.php';
$user_name = "SELECT id, name FROM users";
$users = mysqli_query($conn, $user_name);
?>

<div class="container">
    <div class="row mt-3">
        <div class="col-lg-6 m-auto">
            <div class="card rounded border-3 border-info">
                <div class="card-head">
                    <h1 class="text-center text-white bg-info p-2">Login to Access.</h1>
                </div>
                <div class="card-body">
        <!-----------  login form  ------------->
                    <form action="" method="POST">
                        <div class="mb-3">
                        <select class="form-select form-control <?= (isset($_SESSION['user_error']))? 'border-3 border-danger': ''?>" name="id" aria-label="Default select example">
                            <option value="" <?= (!isset($_SESSION['selected_id'])  ) ? 'selected':'' ?>>Open this select user</option>
                            <?php foreach($users as $us){ ?>
                            <option value="<?= $us['id'] ?>" <?php if(isset($_SESSION['selected_id']) && $_SESSION['selected_id'] == $us['id']){echo 'selected';} ?>><?= $us['name'] ?></option>
                            <?php } ?>
                        </select>
                        <strong class="text-danger"><?= (isset($_SESSION['user_error']))? $_SESSION['user_error']: ''?></strong>
                        <?php unset($_SESSION['user_error']); ?>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Enter password</label>
                            <input type="password" required name="password" placeholder="Enter your password" class="form-control">
                            <input type="number" name="login_attempt" hidden value="<?= (isset($_SESSION['login_attempt']))? $_SESSION['login_attempt']: 1 ?>" placeholder="Enter your password" class="form-control">
                            <strong class="text-danger"><?= (isset($_SESSION['password_error']))? $_SESSION['password_error']: ''; unset($_SESSION['password_error'])?></strong>
                            <?php if(isset($_SESSION['login_attempt']) && $_SESSION['login_attempt'] <= 5){ ?>
                            <strong class="text-danger"><?= 6 - $_SESSION['login_attempt'] . ' attempt left out of 5!'?></strong>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="submit" class="btn btn-info">Login</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>


<!-- PHP code here -->

<?php
require 'db.php';

if(isset($_POST['submit'])){
    $user_id = $_POST['id'];
    $password = $_POST['password'];
    $login_attempt = $_POST['login_attempt'];
    $login_attempt ++;

    if($user_id != null){
        $data = "SELECT COUNT(*) FROM users WHERE id = $user_id";
        $result = mysqli_query($conn, $data);
        // $_SESSION['login_status'] = false;

        if($result->num_rows == 1){
            $data2 = "SELECT * FROM users WHERE id = $user_id";
            $result2 = $conn->query($data2);
            $row = $result2->fetch_assoc();

            if(password_verify($password, $row['password'])){
                $_SESSION['success'] = 'You are successfully logged in!';
                $_SESSION['login_status'] = true;
                $_SESSION['user_id'] = $user_id;
                header('location:index.php'); 
            }
            else{
                $_SESSION['selected_id'] = $row['id'];
                if($_SESSION['login_attempt'] >= 5){
                    $_SESSION['password_error'] = 'Login expired! Try again later with currect password!';
                }
                else{
                    $_SESSION['password_error'] = 'Wrong password!';
                }
                $_SESSION['login_attempt'] = $login_attempt;
                header('location:login.php');
            }
        }
        else{
            $_SESSION['user_error'] = 'You are not registerd user!';
            header('location:login.php');
            $_SESSION['login_attempt'] = $login_attempt;
        }
    }
    else{
        $_SESSION['user_error'] = 'You forget to select user!';
        header('location:login.php');
    }
}


?>