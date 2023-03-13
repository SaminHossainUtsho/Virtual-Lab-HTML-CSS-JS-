<?php
// php -S localhost:8000
require_once 'db.php';
if (isset($_POST['email']))
{
    $email = $_POST['email'];
    $psw = $_POST['psw'];

    $sql = "SELECT * FROM users 
            WHERE email = '$email' LIMIT 1";

    if ($res = mysqli_query($conn, $sql)) {
        $row = mysqli_fetch_assoc($res);
        if(password_verify($psw, $row['password']))
        {
            echo 'Successfully logged in.<br>';
            echo '<a href="/">Go to Home</a>';
        } else {
            echo "Password didn't match.<br>";
            echo '<a href="Log in.html">Log in again?</a>';
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo '<a href="Sign Up.html">Sign Up again?</a>';
    }
    // if ($psw == $rpsw)
    // {
        
        
    
}
?>