<?php 
require 'db.php';
require 'header.php';

?>
<!----------------------- History Section ---------------------->

<div class="row mt-2">
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
        $sql = "SELECT id, user, money, description, datetime FROM history ORDER BY id DESC";
        $result = $conn->query($sql);
        $sl = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $sl+=1?>					
        <tr>
        <th scope="row"><?= $sl ?></th>
        <td><?= $row["user"] ?></td>
        <td><?= $row["money"] ?></td>
        <td><?= $row["description"] ?></td>
        <td><?= $row["datetime"] ?></td>
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