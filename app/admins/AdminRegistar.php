<?php
namespace App\admins;

class AdminRegistar{

    public function adminRegistar(){
        
echo "Create Admin:\n";
$admin_email = readline("Enter email: ");
$admin_password = readline("Enter password: ");

if(!empty($admin_email && $admin_password )){
    //create txt file for admin
    $create_admin_file = fopen("./storages/admin_lists/$admin_email.txt", "x") or die("Unable to create admin file!");
    
    $admin_info = fopen("./storages/admin_lists/$admin_email.txt", "w") or die("Unable to open admin file!");
    fwrite($admin_info, "$admin_email\n");
    fwrite($admin_info, "$admin_password\n");
    fclose($admin_info);

        if(file_exists("./storages/admin_lists/$admin_email.txt")){
            echo "Successfully admin created!";
        }else{
            echo "Sorry admin not created! ";
        }

    }else{
        echo "Please Enter Email and Password";
    }

 }
    
}

?>