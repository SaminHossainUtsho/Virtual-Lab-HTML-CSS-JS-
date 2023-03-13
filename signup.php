<?php
require_once 'db.php';
if (isset($_POST['email']))
{
    $email = $_POST['email'];
    $psw = $_POST['psw'];
    $rpsw = $_POST['psw-repeat'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid Email syntax.<br>";
        echo '<a href="Sign Up.html">Sign Up again?</a>';
    }


    if ($psw == $rpsw)
    {
        $psw_hash = password_hash($psw, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (email, password)
            VALUES ('$email', '$psw_hash')";

        if (mysqli_query($conn, $sql)) {
            echo "Your account created successfully.<br>";
            echo '<a href="Log in.html">Login now?</a>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            echo '<a href="Sign Up.html">Sign Up again?</a>';
        }
    } else {
        echo "Password didn't match.<br>";
        echo '<a href="Sign Up.html">Sign Up again?</a>';
    }
}
?>