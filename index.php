<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
//we are going to use session variables so we need to enable sessions
session_start();
$totalValue = 0;
$sent = " ";
$totalstr = strval($totalValue);
$cookie_name = "totalValue";
$cookie_value = $totalstr;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

$food = "1";

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
//your products with their price.

if(isset($_GET["food"])){
    $food = $_GET["food"];
};

if ($food == "1"){
        $products = [
            ['name' => 'Club Ham', 'price' => 3.20],
            ['name' => 'Club Cheese', 'price' => 3],
            ['name' => 'Club Cheese & Ham', 'price' => 4],
            ['name' => 'Club Chicken', 'price' => 4],
            ['name' => 'Club Salmon', 'price' => 5]
        ];
} else {
        $products = [
            ['name' => 'Cola', 'price' => 2],
            ['name' => 'Fanta', 'price' => 2],
            ['name' => 'Sprite', 'price' => 2],
            ['name' => 'Ice-tea', 'price' => 3],
        ];
    };

$emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = $orderErr = $lolErr = "";
$email = $street = $streetnumber = $city = $zipcode = $order = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
            $emailErr = "Missing";
        }
        else {
        $_SESSION["email"] = $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
          }
        }
        if (empty($_POST["street"]))  {
            $streetErr = "Missing";
        }
        else {
            if (!preg_match("/^[a-zA-Z ]*$/",$street)) {
                $streetErr = "Only letters and white space allowed";
              }
            $_SESSION["street"] = $street = $_POST["street"];
        }
        if (empty($_POST["streetnumber"])) {
            $streetnumberErr = "Missing";
        }
        else {
            $_SESSION["streetnumber"] = $streetnumber = $_POST["streetnumber"];
        }
        if (empty($_POST["city"])) {
            $cityErr = "Missing";
        }
        else {
            $_SESSION["city"] = $city = $_POST["city"];
        }
        if (empty($_POST["zipcode"])) {
            $zipcodeErr = "Missing";
        }
        else {
            $_SESSION["zipcode"] = $zipcode = $_POST["zipcode"];
        }
        if (empty($_POST["order"])) {
            $orderErr = "please select a delivery method";
        }
        else {
            $_SESSION["order"] = $zipcode = $_POST["order"];
        }
        if ($cityErr == "" && $emailErr == "" && $streetErr == "" && $orderErr == "" && $streetnumberErr == "" && $zipcodeErr == ""){
            $lolErr = "lol"; 
            $totalValue = $_POST['products'];
        };
    };



    if ($cityErr == "" && $emailErr == "" && $streetErr == "" && $orderErr == "" && $streetnumberErr == "" && $zipcodeErr == "" && $lolErr == "lol" ){
        $sent = "Your order has been sent";

    } else {
        $sent = "";
    };
echo($totalValue);
var_dump($_POST);
require 'form-view.php';