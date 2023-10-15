#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\admins\AdminSignIn;

class AdminLogin{

    public function adminLogin(){
        
    $admin_login_email = readline("Enter Admin Email: ");
    $admin_login_password = readline("Enter Admin Password: ");

     if($admin_login_email && $admin_login_password !==null){

       if(file_exists("./storages/admin_lists/$admin_login_email.txt")) {

        $open_admin_file    = file("./storages/admin_lists/$admin_login_email.txt");
        $admin_email    = "$open_admin_file[0]";
        $admin_password = "$open_admin_file[1]";
        $admin_email = trim($admin_email );
        $admin_password = trim($admin_password);
            if( $admin_login_email === $admin_email && $admin_login_password === $admin_password){              

                $admin_sign_in = new AdminSignIn();
                $admin_sign_in->runTotalAmount();
               
                echo "\n";
                echo "Admin Logined: $admin_email \n\n";
                echo "1.See All Transactions \n";
                echo "2.See Transactions Of Specific Customer\n";
                echo "3.Customer List\n";
                
                $user_input = readline("Enter a Code: ");
                
                //1.See All Transactions 
                if($user_input == 1){

                // Transaction of all user 
                $admin_sign_in = new AdminSignIn();
                $admin_sign_in->showAllTransaction();

                //2.See Transactions Of Specific
                }elseif($user_input == 2){

                $admin_sign_in = new AdminSignIn();
                $admin_sign_in->specificUserTransaction();

                    //3.Customer list                       
                    }elseif($user_input == 3){
                $admin_sign_in = new AdminSignIn();
                $admin_sign_in->customerList();
                    }else{
                        echo "Enter Correct Number, 1/2/3";
                    }
            }else{
                echo "Enter correct email and password";
            }

       }else{
        echo "Email and password not found in database";
       }

     }else{
        echo "Enter Admin Email and Password";
     }
  
    }
}

$admin_login =  new AdminLogin();
$admin_login->adminLogin();