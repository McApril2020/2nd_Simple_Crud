<?php
    session_start();
    include 'crud1_connection.php';

    //Insert
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];

        $sql = "INSERT INTO ope (name, username, email) VALUES ('$name', '$username', '$email')";
        mysqli_query($connection, $sql);

        $_SESSION['message'] = 'Successfully Added';
        $_SESSION['message-type'] = 'success';
    }
    //Delete
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $deleteQuery = "DELETE FROM ope WHERE id='$id'";
        $deleteResult = mysqli_query($connection, $deleteQuery);

        $_SESSION['message'] = 'Record Deleted!';
        $_SESSION['message-type'] = 'danger';


    }

    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $sql = "SELECT * FROM ope WHERE id='$id'";
        $res = mysqli_query($connection,$sql);
        $result = mysqli_fetch_array($res);
        if(count($result)) {
            $name = $result['name'];
            $username = $result['username'];
            $email = $result['email'];
        }
    }

    //Update
    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
      
        $sql1 = "UPDATE ope SET name='$name', username='$username', email='$email' WHERE id='$id'";
        $result1 = mysqli_query($connection, $sql1);

      echo '<script>alert("Successfully Updated")</script>';
      echo '<script>window.location = "crud2.php"</script>';    
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>

<?php
    if(isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?=$_SESSION['message-type']?> text-center">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php }?>

<div class="container">
    <div class="row justify-content-center">
                <form action="crud2.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" value="<?php echo $name ?>" name="name" placeholder="enter your name">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" value="<?php echo $username ?>" name="username" placeholder="enter username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" value="<?php echo $email ?>" name="email" placeholder="entrer email">
                    </div>
                    <div class="form-group">

                    <?php 

                        if($update == true): ?>
                            <button class="btn btn-info" type="submit" name="update">Update</button>
                        <?php else: ?>
                            <button class="btn btn-success" type="submit" name="submit">Submit</button>
                        <?php endif?>
          
                    </div>
                </form>
            </div>

            <?php

                $display = "SELECT * FROM ope";
                $displayQuery = mysqli_query($connection, $display);

            ?>

            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php while($res = mysqli_fetch_array($displayQuery)) { ?>

                        <tr>
                            <td><?php echo $res['name']?></td>
                            <td><?php echo $res['username']?></td>
                            <td><?php echo $res['email']?></td>
                            <td>
                                <a class="btn btn-info" href="crud2.php?edit=<?php echo $res['id']?>">Edit</a>
                                <a class="btn btn-danger" href="crud2.php?delete=<?php echo $res['id']?>">Delete</a>
                            </td>
                        </tr>

                    <?php }?>
                </table>
        </div>
</div>
</body>
</html>