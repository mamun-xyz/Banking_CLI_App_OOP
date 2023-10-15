<?php
namespace App\customers\registration;

use App\customers\registration\GetCustomerInfo;
use App\customers\registration\SaveCustomerInfo;


class Registration extends GetCustomerInfo{

    public function register(){

    $name = readline('Enter Your Name (required): ');
    $email = readline('Enter Your Email (required): ');
    $password = readline('Enter Your Password (required): ');
    $deposite = readline('Enter Your Deposite Amount (optional): ');

    $get_customer_info = new GetCustomerInfo;
    $get_customer_info->getCustomerInfo($name, $email, $password, $deposite);  
    $get_customer_info->setCustomerInfo();  

    $save_customer_info = new SaveCustomerInfo();
    $save_customer_info->makeDirectory();
    $save_customer_info->saveProfileInfo();
    $save_customer_info->saveFinancialInfo();
    $save_customer_info->saveDepositeAmountTransaction();
    $save_customer_info->saveReceivedAmountTransaction();
    $save_customer_info->saveSender();
    $save_customer_info->saveWithdrawAmountTransaction();
    $save_customer_info->saveSendAmountTransaction();
    $save_customer_info->saveReceiver();
    $save_customer_info->successMsg();
 
    }

 }

   






