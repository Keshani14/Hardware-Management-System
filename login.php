<?php
    if(isset($_POST['submit'])) {
        require_once('connect.php');
        $name = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT password, id,  role
                FROM users
                WHERE username = '" . $name . "';";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = $result -> fetch_assoc();
            if ($row['password'] === $password) {
                echo "Log in successful!";
                $role = $row['role'];
                session_start();
                $_SESSION['id'] = $row['id']; 
                $connection -> close();
                if ($role != "delivery"){
                    header("Location: index.php");
                }
                else{
                    header("Location: ./deliveries.php");
                }
            }
                else{
                    echo "Your password is incorrect. Try again!";
                }
        }
        else{
            echo "You are not registered. Please sign up first!";
        }
    }
    else {
        echo "Enter your username and password!";
    }
?>