#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\customers\login\Login;
use App\customers\registration\Registration;

echo "1.Login\n";
echo "2.Register\n";

$user_code = readline("Enter a choice: ");

if($user_code == 1){

    $login = new Login();
    $login->login();
    
}elseif($user_code == 2){

    $registration = new Registration();
    $registration->register();

}else{
    echo "Wrong Input! Enter 1 or 2";
}