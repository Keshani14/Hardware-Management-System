<?php
session_start();

if (isset($_SESSION['id'])) {
    header('Location: ./');
}
?>

<html>
    <head>
        <title>
            Log In | ABC Builders & Suppliers
        </title>
        <link rel="stylesheet" href="./styles/main.css" />
    </head>
    <body>
        <hr />
        <h1 id="header" style="margin: auto 0px; padding: 10px;">Log In<br />ABC Builders & Suppliers</h1>
        <hr />
        <nav>
            <a style="margin-left: 4px;" href="./index.php">Home</a>
            <a href="materials.php">Our Materials</a>
            <a href="manual.php">Help</a>
            <a class="log_link active" href="login-page.php">Log in</a>
        </nav>
        <hr />
        <div class="description">
            If you are already signed up in the site, use your username and password.
            Else, you can send a sign up request by clicking Sign up.
        </div>
        <form id="login_form" class="forms" action="login.php" method="post">
            <h2 class="header_2">Log in to the System</h2>
            <div class="input_div">
                <label for="username">Username</label>
                <input type="text" name="username" required />
            </div>
            <div class="input_div">
                <label for="password">Password</label>
                <input type="password" name="password" required />
            </div>
            <input type="submit" name="submit" value="Log in" class="send_button" />
            <div id="no_account">
                No account? <a href="./sign-up.php">Sign up</a>
            </div>
        </form>
        <footer>
            <hr />
            <strong>Copyright &copy; 2024 ABC Builders & Suppliers</strong>
            <hr />
        </footer>
    </body>
</html>
