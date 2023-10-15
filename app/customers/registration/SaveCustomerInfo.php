<?php
namespace App\customers\registration;

date_default_timezone_set("Asia/Dhaka");

 class SaveCustomerInfo{


  public function makeDirectory(){
    $profile_info = file_get_contents("./app/customers/registration/temp_data.txt");
    $profile_info = unserialize($profile_info);
 
    $customer_name = $profile_info['name'];
    $customer_email = $profile_info['email'];
    $customer_password = $profile_info['password'];
    $customer_deposite = $profile_info['deposite'];


  if(!empty($customer_name && $customer_email && $customer_password )){
    if(!file_exists("./storages/customer_lists/$customer_email")){

    //create customer directory with using his/her mail
    $customer_dir = mkdir("./storages/customer_lists/$customer_email");
    $customer_history_dir = mkdir("./storages/customer_lists/$customer_email/transaction_histories");
    $customer_date_dir = mkdir("./storages/customer_lists/$customer_email/transaction_histories/dates");

    }else{
      echo "This email already have Account";
    }


  }else{
    echo "Name, Email and Password Are Required";
  }

  }


  public function saveProfileInfo(){
    $profile_info = file_get_contents("./app/customers/registration/temp_data.txt");
    $profile_info = unserialize($profile_info);
 
    $customer_name = $profile_info['name'];
    $customer_email = $profile_info['email'];
    $customer_password = $profile_info['password'];
    $customer_deposite = $profile_info['deposite'];

    //create and open txt file to save customer profile info
    $customer_profile_info = fopen("./storages/customer_lists/$customer_email/profileInfo.txt", "x+") or die("Unable to create file!");
    fwrite($customer_profile_info, "$customer_name\n");
    fwrite($customer_profile_info, "$customer_email\n");
    fwrite($customer_profile_info, "$customer_password\n");
    fclose( $customer_profile_info);

}

  public function saveFinancialInfo(){
    $profile_info = file_get_contents("./app/customers/registration/temp_data.txt");
    $profile_info = unserialize($profile_info);  
    $customer_email = $profile_info['email'];
    $customer_deposite = $profile_info['deposite'];
    if($customer_deposite == null){
      $customer_deposite = 0;
    }

    $opening_received_amount = 0;
    $opening_withdraw_amount = 0;
    $opening_transfer_amount = 0;

    //create and open txt file to save customer deposite
    $customer_deposite_file = fopen("./storages/customer_lists/$customer_email/deposite_amount.txt", "x+") or die("Unable to create file!");
    fwrite($customer_deposite_file, " $customer_deposite");

    //create and open txt file to save customer received
    $customer_received_file = fopen("./storages/customer_lists/$customer_email/received_amount.txt", "x+") or die("Unable to create file!");
    fwrite($customer_received_file, "$opening_received_amount");



    //create and open txt file to save customer withdraw
    $customer_withdraw_file = fopen("./storages/customer_lists/$customer_email/withdraw_amount.txt", "x+") or die("Unable to create file!");
    fwrite($customer_withdraw_file , "$opening_withdraw_amount");


    //create and open txt file to save customer transfer
    $customer_transfer_file = fopen("./storages/customer_lists/$customer_email/transfer_amount.txt", "x+") or die("Unable to create file!");
    fwrite($customer_transfer_file , "$opening_transfer_amount");

    //total amount calculation
    $total_opening_credit = ($customer_deposite + $opening_received_amount);
    $total_opening_debit = ($opening_withdraw_amount + $opening_transfer_amount);
    $total_opening_amount =($total_opening_credit - $total_opening_debit);


    //create txt file to save user total amount
    $customer_total_amount_file = fopen("./storages/customer_lists/$customer_email/total_amount.txt", "x+") or die("Unable to create file!");
    fwrite($customer_total_amount_file, "$total_opening_amount");

    fclose($customer_deposite_file);
    fclose($customer_received_file);
    fclose($customer_withdraw_file);
    fclose($customer_transfer_file);
    fclose($customer_total_amount_file);      

}

  public function saveDepositeAmountTransaction(){
      $profile_info = file_get_contents("./app/customers/registration/temp_data.txt");
      $profile_info = unserialize($profile_info);  
      $customer_email = $profile_info['email'];
      $customer_deposite = $profile_info['deposite'];

    
        //Save  Deposite Transaction.
        $opening_deposite_history = fopen("./storages/customer_lists/$customer_email/transaction_histories/deposite_amount.txt", "x") or die("Unable to create file!");
        $save_deposite = fwrite($opening_deposite_history, "$customer_deposite\n");
        fclose($opening_deposite_history);  
        //date   
        if($save_deposite !==null){
            $create_deposite_date_file = fopen("./storages/customer_lists/$customer_email/transaction_histories/dates/date.deposite.txt", "x") or die("Unable to create file!"); 
            $date = date('d/m/Y  h:i:s A');
            fwrite($create_deposite_date_file, "$date\n");
            fclose($create_deposite_date_file);
        }else{
            //echo "date not saved";
        }
        //End Save Deposite Transaction part.

  }


  public function saveReceivedAmountTransaction(){
    $profile_info = file_get_contents("./app/customers/registration/temp_data.txt");
    $profile_info = unserialize($profile_info);  
    $customer_email = $profile_info['email'];
    $opening_received_amount = 0;



    //Save Received_Amount Transaction.
    $opening_received_history = fopen("./storages/customer_lists/$customer_email/transaction_histories/received_amount.txt", "x") or die("Unable to create file!");
    $received_money = fwrite($opening_received_history, "$opening_received_amount\n");
    fclose($opening_received_history);
    //date   
    if($received_money !==null){
        $create_received_money_date_file = fopen("./storages/customer_lists/$customer_email/transaction_histories/dates/date.received_money.txt", "x") or die("Unable to create file!"); 
        $date = date('d/m/Y  h:i:s A');
        fwrite($create_received_money_date_file, "$date\n");
        fclose($create_received_money_date_file); 
    }else{
          //echo "date not saved";
    }      
    //End Save Received Amount Transaction part.


  }  
   

  public function saveSender(){
  $profile_info = file_get_contents("./app/customers/registration/temp_data.txt");
  $profile_info = unserialize($profile_info);  
  $customer_email = $profile_info['email'];  

  //Save Sender(who send me) Transaction.
  $opening_sender_history = fopen("./storages/customer_lists/$customer_email/transaction_histories/received_amount_sender.txt", "x") or die("Unable to create file!");
  fwrite($opening_sender_history, "n/a\n");
  fclose($opening_sender_history);
  //End Save Sender Transaction part. 

  }

  public function saveWithdrawAmountTransaction(){
  $profile_info = file_get_contents("./app/customers/registration/temp_data.txt");
  $profile_info = unserialize($profile_info);  
  $customer_email = $profile_info['email']; 
  $opening_withdraw_amount = 0;

  //Save Withdraw Transaction.
  $opening_withdraw_history = fopen("./storages/customer_lists/$customer_email/transaction_histories/withdraw_amount.txt", "x") or die("Unable to create file!");
  $save_withdraw = fwrite($opening_withdraw_history, "$opening_withdraw_amount\n");
  fclose($opening_withdraw_history);
  //date   
  if($save_withdraw !==null){
      $create_withdraw_date_file = fopen("./storages/customer_lists/$customer_email/transaction_histories/dates/date.withdraw.txt", "x") or die("Unable to create file!"); 
      $date = date('d/m/Y  h:i:s A');
      fwrite($create_withdraw_date_file, "$date\n");
      fclose($create_withdraw_date_file);
  }else{
      //echo "date not saved";
  }
  //End Save Withdraw Transaction part.  


  }


  public function saveSendAmountTransaction(){
   $profile_info = file_get_contents("./app/customers/registration/temp_data.txt");
   $profile_info = unserialize($profile_info);  
   $customer_email = $profile_info['email']; 
   $opening_transfer_amount = 0;


    //Save sent_amount Transaction.
    $opening_transfer_amount_history = fopen("./storages/customer_lists/$customer_email/transaction_histories/sent_amount.txt", "x") or die("Unable to create file!");
    $save_send_money = fwrite($opening_transfer_amount_history, "$opening_transfer_amount\n");
    fclose($opening_transfer_amount_history);
    //date   
    if($save_send_money !==null){
        $create_send_amount_date_file = fopen("./storages/customer_lists/$customer_email/transaction_histories/dates/date.send_amount.txt", "x") or die("Unable to create file!"); 
        $date = date('d/m/Y  h:i:s A');
        fwrite($create_send_amount_date_file, "$date\n");
        fclose($create_send_amount_date_file);
    }else{
        //echo "date not saved";
    }
    //End Save send money / Transfer Transaction part. 

  }  

  public function saveReceiver(){
  $profile_info = file_get_contents("./app/customers/registration/temp_data.txt");
  $profile_info = unserialize($profile_info);  
  $customer_email = $profile_info['email'];    

  //Save Receiver(Who got money) Transaction.
  $opening_receiver_history = fopen("./storages/customer_lists/$customer_email/transaction_histories/sent_amount_receiver.txt", "x") or die("Unable to create file!");
  fwrite($opening_receiver_history, "n/a\n");
  fclose($opening_receiver_history);
  //End Save Receiver Transaction part.    

  }

  public function successMsg(){

  $profile_info = file_get_contents("./app/customers/registration/temp_data.txt");
  $profile_info = unserialize($profile_info);  
  $customer_email = $profile_info['email'];     

  if(file_exists("./storages/customer_lists/$customer_email/profileInfo.txt")){
      echo "Successfully your account created!";
  }else{
      echo "Sorry your account not created! ";

  }

}
 
}
