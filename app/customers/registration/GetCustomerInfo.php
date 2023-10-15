<?php
namespace App\customers\registration;

class GetCustomerInfo{

    public $customer_name;
    public $customer_email;
    public $customer_password;
    public $customer_opening_deposite;


    public function getCustomerInfo($name, $email, $password, $deposite = 0 ){

    $this->customer_name = $name;
    $this->customer_email = $email;
    $this->customer_password = $password;
    $this->customer_opening_deposite = $deposite;

    }

    public function setCustomerInfo(){     
    $profile_info = [
        "name" => "$this->customer_name",
        "email" => "$this->customer_email",
        "password" => "$this->customer_password",
        "deposite" => "$this->customer_opening_deposite"
    ];

    $profile_info = serialize($profile_info);
    file_put_contents("./app/customers/registration/temp_data.txt", "$profile_info");
}

 
}

