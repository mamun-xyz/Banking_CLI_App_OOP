<?php
namespace App\customers\login;
use App\customers\login\ShowCustomerInfo;

class Login{
    public function login(){
        $login_email = readline("Enter Your Login Email: ");
        $login_password = readline("Enter Your Login Password: ");
   
        if($login_email && $login_password !==null){
   
          if(file_exists("./storages/customer_lists/$login_email")) {

            file_put_contents("./app/customers/login/temp_data.txt", "$login_email");
   
           $open_customer_file    = file("./storages/customer_lists/$login_email/profileInfo.txt");
           $customer_name    = "$open_customer_file[0]";
           $customer_email    = "$open_customer_file[1]";
           $customer_password = "$open_customer_file[2]";
           $customer_email = trim($customer_email);
           $customer_password = trim($customer_password);
            if($login_email === $customer_email && $login_password === $customer_password){
    
                $customer_info = new ShowCustomerInfo();    
                $customer_info->runTotalAmount(); 

                echo "Dashboard:\n";
                echo "Your Name: $customer_name";
                echo "1.Deposit Money \n";
                echo "2.Withdraw Money \n";
                echo "3.Transfer Money \n";
                echo "4.Show Current Balance \n"; 
                echo "5.Show transactions \n";
                    
                $user_input = readline("Enter a Code: ");

                    //Deposite Money
                    if($user_input == 1){

                    $customer_info = new ShowCustomerInfo();    
                    $customer_info->depositeMoney(); 

                    //Withdraw Money
                    }elseif($user_input == 2){

                    $customer_info = new ShowCustomerInfo();    
                    $customer_info->withdrawMoney(); 

                    //Transfer money
                    }elseif($user_input == 3){

                    $customer_info = new ShowCustomerInfo();    
                    $customer_info->transferMoney(); 

                    //Current balance         
                    }elseif($user_input == 4){

                    $customer_info = new ShowCustomerInfo();    
                    $customer_info->currentBalance(); 

                    //Show Transactions
                    }elseif($user_input == 5){

                    $customer_info = new ShowCustomerInfo();    
                    $customer_info->showTransaction();

            }else{
                echo "Enter Correct Number";
            }
               }else{
                echo "Enter correct email and password";
               }
          }else{
                echo "No user on this email";;
          }  
        }else{
           echo "Enter Your Email and Password";
        }
    }    
}