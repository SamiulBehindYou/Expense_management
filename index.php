<?php 
require 'header.php';
require 'function.php';

if (!isset($_SESSION['login_status'])){
    header('location:login.php');
}

// Meal Lifetime expenses
$per_head = 0;
$meal = "SELECT user, money, datetime FROM m_account";
$result = $conn->query($meal);
$meal_lifetime = 0;
if ($result->num_rows > 0) {
    while($meal_row = $result->fetch_assoc()) {					
        $meal_lifetime += $meal_row['money'];
    }
    
    $per_head = $meal_lifetime / 3;

} 

// Meal Monthly
$m_meal = "SELECT money, datetime FROM m_account WHERE MONTH(datetime) = MONTH(NOW())";
$m_result = mysqli_query($conn, $m_meal);
$meal_monthly = 0;
foreach($m_result as $m){
    $meal_monthly += $m['money']; //Calculating total ammount of each month!
}

if($meal_monthly == 0){
    $meal_monthly = "No expenses on this month!";
}else{
    $meal_monthly = $meal_monthly." TK";
}


// Meal Today
// $t_meal = "SELECT money, datetime FROM m_account ORDER BY id DESC LIMIT 1";
$gd = getdate(); //getting todays current date

if(strlen("$gd[mon]") == 1){  ////Making date 0000-0-0 to 0000-00-00
    $ymd = "$gd[year]-0$gd[mon]-$gd[mday]";
    if(strlen("$gd[mday]") == 1){
        $ymd = "$gd[year]-0$gd[mon]-0$gd[mday]";
    }
}
elseif(strlen("$gd[mday]") == 1){
    $ymd = "$gd[year]-$gd[mon]-0$gd[mday]";
    if(strlen("$gd[mon]") == 1){
        $ymd = "$gd[year]-0$gd[mon]-0$gd[mday]";
    }
}
else{
    $ymd = "$gd[year]-$gd[mon]-$gd[mday]";
}

$t_meal = "SELECT money, datetime FROM m_account WHERE datetime LIKE '{$ymd}%'";

$t_result = mysqli_query($conn, $t_meal);
$meal_today = 0;
foreach($t_result as $t){
    $meal_today += $t['money'];
}

if($meal_today == 0){
    $meal_today = "No expenses on this today!";
}else{
    $meal_today = $meal_today." TK";
}


// USER 1 Lifetime
$s_user = "SELECT id, user, money, description FROM users_account";
$s_result = $conn->query($s_user);
$s_lifetime = 0;
if ($s_result->num_rows > 0) {
    while($s_row = $s_result->fetch_assoc()){ 
         
        if($s_row['user'] == 'Samiul'){
            $s_lifetime += $s_row['money'];
        }
    }
} 
$s_balance = $s_lifetime - $per_head;
$s_due = 0;
if($s_balance < 0){
    $s_due = $s_balance;
    $s_balance = 0;
}

// USER 2 Lifetime
$f_user = "SELECT id, user, money, description FROM users_account";
$f_result = $conn->query($f_user);
$f_lifetime = 0;
if ($f_result->num_rows > 0) {
    while($f_row = $f_result->fetch_assoc()){ 
         
        if($f_row['user'] == 'Faruk'){
            $f_lifetime += $f_row['money'];
        }
    }
} 
$f_balance = $f_lifetime - $per_head;
$f_due = 0;
if($f_balance < 0){
    $f_due = $f_balance;
    $f_balance = 0;
}
// USER 3 Lifetime
$r_user = "SELECT id, user, money, description FROM users_account";
$r_result = $conn->query($s_user);
$r_lifetime = 0;
if ($r_result->num_rows > 0) {
    while($r_row = $r_result->fetch_assoc()){ 
         
        if($r_row['user'] == 'Ridoy'){
            $r_lifetime += $r_row['money'];
        }
    }
} 
$r_balance = $r_lifetime - $per_head;
$r_due = 0;
if($r_balance < 0){
    $r_due = $r_balance;
    $r_balance = 0;
}
?>
  <div class="container">
        <div class="row mt-3">
            <div class="col-lg-6 m-auto">
            <?php if(isset($_SESSION['success'])){ ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success'] ?>
                    </div>
            <?php } unset($_SESSION['success']) ?>
            <?php if(isset($_SESSION['meal_success'])){ ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['meal_success'] ?>
                    </div>
            <?php } unset($_SESSION['meal_success']) ?>
                <div class="card border-3 border-info">
                    <!----------------- Meal Account --------------->
                    <form action="function/m_function.php" method="POST">
                        <div class="card-head bg-info p-2">
                            <h1 class="text-center text-white">Meal Account</h1>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">

                            <?php
                            
                            ?>

                                <label for="" class="form-label">Lifetime Cost: <?= $meal_lifetime ?> TK</label>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Monthly Cost: <?= $meal_monthly ?></label>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Todays Cost: <?= $meal_today ?></label>
                            </div>
                            <div class="mb-3">
                                <label>Add Money</label>
                                <input type="text" name="name" hidden value="<?= $row['name'] ?>" required class="form-control">
                                <input type="number" name="meal_money" required class="form-control"  placeholder="Enter Ammount">
                            </div>
                            <div class="mb-3">
                                <label>Reason</label>
                                <input type="text" name="meal_reason" required class="form-control"  placeholder="Enter reason here...">
                            </div>
                            <?php if(isset($_SESSION['meal_error'])){ ?>
                                <div class="mb-3">
                                    <strong class="alert alert-danger">
                                        <?= $_SESSION['meal_error'] ?>
                                    </strong>
                                </div>
                            <?php } unset($_SESSION['meal_error']) ?>
                            <div class="mb-3">
                                <input type="submit" name="meal_submit" value="Add" class="btn btn-info">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-4 mb-3">

                <!----------------- Users Account --------------->
                <div class="card border-info border-3">
                    <div class="card-head">
                        <h1 class="text-center text-white bg-info p-1">Samiul</h1>
                    </div>
                    <div class="card-body">

                <!-------------- User form 01 --------------->
                        <form action="function/s_function.php" method="POST">
                        <div class="mb-3">
                            <label for="" class="form-label">Lifetime Balance: <?= $s_lifetime ?></label>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Total Balance: <?= $s_balance ?></label>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Total Due: <?= $s_due ?></label>
                        </div>
                        <?php if($row['id'] == 1){ ?>

                        <div class="mb-3">
                            <label>Add Money</label>
                            <input type="text" name="name" hidden value="<?= $row['name'] ?>" required class="form-control">
                            <input type="number" name="s_money" class="form-control"  placeholder="Enter Ammount">
                        </div>
                        <div class="mb-3">
                            <label>Reason</label>
                            <input type="text" name="s_reason" required class="form-control"  placeholder="Enter reason here...">
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="s_submit" value="Add" class="btn btn-info">
                        </div>

                        <?php }else{ ?>

                            <div class="mb-3">
                                <label>Add Money</label>
                                <input type="text" disabled name="#" class="form-control"  placeholder="Enter Ammount">
                            </div>
                            <div class="mb-3">
                                <label>Reason</label>
                                <input type="text" disabled name="#" required class="form-control"  placeholder="Enter reason here...">
                            </div>
                            <div class="mb-3">
                                <input type="submit" disabled name="#" value="Add" class="btn btn-info">
                            </div>

                        <?php } ?>
                        </form>


                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="card border-info border-3">
                    <div class="card-head">
                        <h1 class="text-center text-white bg-info p-1">Faruk</h1>
                    </div>
                    <div class="card-body">

                    <!-------------- User form 02 --------------->
                    <form action="function/f_function.php" method="POST">
                        <div class="mb-3">
                            <label for="" class="form-label">Lifetime Balance: <?= $f_lifetime ?></label>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Total Balance: <?= $f_balance ?></label>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Total Due: <?= $f_due ?></label>
                        </div>
                        <?php if($row['id'] == 2){ ?>

                            <div class="mb-3">
                                <label>Add Money</label>
                                <input type="text" name="name" hidden value="<?= $row['name'] ?>" required class="form-control">
                                <input type="number" name="f_money" class="form-control"  placeholder="Enter Ammount">
                            </div>
                            <div class="mb-3">
                                <label>Reason</label>
                                <input type="text" name="f_reason" required class="form-control"  placeholder="Enter reason here...">
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="f_submit" value="Add" class="btn btn-info">
                            </div>

                        <?php }else{ ?>

                            <div class="mb-3">
                                <label>Add Money</label>
                                <input type="text" disabled name="#" class="form-control"  placeholder="Enter Ammount">
                            </div>
                            <div class="mb-3">
                                <label>Reason</label>
                                <input type="text" disabled name="#" required class="form-control"  placeholder="Enter reason here...">
                            </div>
                            <div class="mb-3">
                                <input type="submit" disabled name="#" value="Add" class="btn btn-info">
                            </div>

                        <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <div class="card border-info border-3">
                    <div class="card-head">
                        <h1 class="text-center text-white bg-info p-1">Ridoy</h1>
                    </div>
                    <div class="card-body">

                    <!-------------- User form 03 --------------->
                    <form action="function/r_function.php" method="POST">
                        <div class="mb-3">
                            <label for="" class="form-label">Lifetime Balance: <?= $r_lifetime ?></label>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Total Balance: <?= $r_balance ?></label>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Total Due: <?= $r_due ?></label>
                        </div>

                        <?php if($row['id'] == 3){ ?>

                            <div class="mb-3">
                                <label>Add Money</label>
                                <input type="text" name="name" hidden value="<?= $row['name'] ?>" required class="form-control">
                                <input type="number" name="r_money" class="form-control"  placeholder="Enter Ammount">
                            </div>
                            <div class="mb-3">
                                <label>Reason</label>
                                <input type="text" name="r_reason" required class="form-control"  placeholder="Enter reason here...">
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="r_submit" value="Add" class="btn btn-info">
                            </div>

                        <?php }else{ ?>

                            <div class="mb-3">
                                <label>Add Money</label>
                                <input type="text" disabled name="#" class="form-control"  placeholder="Enter Ammount">
                            </div>
                            <div class="mb-3">
                                <label>Reason</label>
                                <input type="text" disabled name="#" required class="form-control"  placeholder="Enter reason here...">
                            </div>
                            <div class="mb-3">
                                <input type="submit" disabled name="#" value="Add" class="btn btn-info">
                            </div>

                        <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
<!-- Container END -->

        <!----------------------- History Section ---------------------->

        <div class="row mt-5">
            <div class="col-lg-11 m-auto">
                <h1 class="text-center rounded text-white bg-info p-2">History</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-11 m-auto">
                
                <table class="table text-center">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User</th>
                    <th scope="col">Money added</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date Time</th>
                    </tr>
                </thead>
                <tbody>

                <?php 
                $sql = "SELECT id, user, money, description, datetime FROM history ORDER BY id DESC LIMIT 10";
                $result = $conn->query($sql);
                $sl = 0;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $sl+=1?>					
                <tr>
                <th width="5%" scope="row"><?= $sl ?></th>
                <td width="10%"><?= $row["user"] ?></td>
                <td width="10%"><?= $row["money"] ?></td>
                <td width="55%"><?= $row["description"] ?></td>
                <td width="20%"><?= $row["datetime"] ?></td>
                </tr>
                <?php 
                    }
                } else {
                    ?>
                </tbody>
                </table>
                <div class="alert alert-danger">
                        <h1 class="text-center text-white">No data found!</h1>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- history condition -->
        <?php if($sl == 10){ ?>
        <a href="history.php" class="btn btn-info mb-2">See all history</a>
        <?php } ?>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>