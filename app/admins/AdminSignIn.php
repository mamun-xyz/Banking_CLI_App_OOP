<?php 
namespace App\admins;

class AdminSignIn{
    public function runTotalAmount(){

    //Run Automatically Total Amount 
    $dir_path   = './storages/customer_lists/';
    $customers = scandir($dir_path);

    for( $i=2; $i < count($customers); $i++){
        "$customers[$i]";
        //Deposite Amount
        $open_deposite_amount = fopen("./storages/customer_lists/$customers[$i]/deposite_amount.txt", "r") or die("Unable to open deposite amount file!");
        $deposite_amount = fgets($open_deposite_amount);
        fclose($open_deposite_amount);
        

        //Received Amount
        $open_received_amount = fopen("./storages/customer_lists/$customers[$i]/received_amount.txt", "r") or die("Unable to open received amount file!");
        $received_amount = fgets($open_received_amount);
        fclose($open_received_amount);
        

        //Withdraw Amount
        $open_withdraw_amount = fopen("./storages/customer_lists/$customers[$i]/withdraw_amount.txt", "r") or die("Unable to open withdraw amount file!");
        $withdraw_amount = fgets($open_withdraw_amount);
        fclose($open_withdraw_amount);
            
        
        //Transfer Amount
        $open_transfer_amount = fopen("./storages/customer_lists/$customers[$i]/transfer_amount.txt", "r") or die("Unable to open transfer amount file!");
        $transfer_amount = fgets($open_transfer_amount);
        fclose($open_transfer_amount);
            
        
        $total_credit = ($deposite_amount + $received_amount);
        $total_debit = ($withdraw_amount + $transfer_amount);

        $current_balance = ($total_credit - $total_debit);
        

        $open_total_balance = fopen("./storages/customer_lists/$customers[$i]/total_amount.txt", "w+") or die("Unable to open total amount file!");
        fwrite($open_total_balance, "$current_balance");
        fclose($open_total_balance);                               
}
//End Run Automatically Total Amount   

    }

    public function showAllTransaction(){

        echo "\n";
        echo " ############################################## \n";
        echo " ###  Transaction history of all customers: ### \n";
        echo " ############################################## \n\n";  
        $path    = './storages/customer_lists/';
        $files = scandir($path);


        $customer_sr_no = 1;    
        for( $i=2; $i < count($files); $i++){                    
          //Name and Email                
          $file_path ="./storages/customer_lists/$files[$i]/profileInfo.txt";
          $users = file($file_path);
          $user_name = "$users[0]";
          $user_email = "$users[1]";
          echo " $customer_sr_no.Customer Name: $user_name"; 
          echo "   Customer Email: $user_email"; 

        //Total Amount
        $total_balance_path ="./storages/customer_lists/$files[$i]/total_amount.txt";
        $total_balance_file = file($total_balance_path);


        $total_balance_s_n = 1;
        for($j=0; $j<count($total_balance_file); $j++){
            $total_balance = $total_balance_file[$j];                   
            echo "   Total Available Balance(Taka): ".$total_balance;
            echo"\n\n";
            $total_balance_s_n++;
        }
          
            //Deposite Amount and Date
            echo " #### Deposite History: ####\n\n";
            $deposite_amount_path ="./storages/customer_lists/$files[$i]/transaction_histories/deposite_amount.txt";
            $deposite_file = file($deposite_amount_path);

            $deposite_dates_path = "./storages/customer_lists/$files[$i]/transaction_histories/dates/date.deposite.txt";
            $deposite_date_file = file($deposite_dates_path);

            $deposite_s_n = 1;
            for($j=0; $j<count($deposite_file); $j++){
                $deposite_amount = $deposite_file[$j];
                $deposite_date = $deposite_date_file[$j];
                echo "     $deposite_s_n."."Deposite Amount(Taka): ".$deposite_amount."       Deposite Date: $deposite_date";
                echo"\n";
                $deposite_s_n++;
            }

         
            //Withdraw Amount and Date
            echo " #### Withdraw History: ####\n\n";
            $withdraw_amount_path ="./storages/customer_lists/$files[$i]/transaction_histories/withdraw_amount.txt";
            $withdraw_file = file($withdraw_amount_path);

            $withdraw_dates_path = "./storages/customer_lists/$files[$i]/transaction_histories/dates/date.withdraw.txt";
            $withdraw_date_file = file($withdraw_dates_path);


            $withdraw_s_n = 1;
            for($j=1; $j<count($withdraw_file); $j++){
                $withdraw_amount = $withdraw_file[$j];
                $withdraw_date = $withdraw_date_file[$j];
                echo "     $withdraw_s_n."."Withdraw Anount(Taka): ".$withdraw_amount."       Withdraw Date: $withdraw_date";
                echo"\n";
                $withdraw_s_n++;
            }
                    
            //Send Money and Date
            echo " #### Send Money History: ####\n\n";
            $send_money_amount_path ="./storages/customer_lists/$files[$i]/transaction_histories/sent_amount.txt";
            $send_money_file = file($send_money_amount_path);

            $send_money_dates_path = "./storages/customer_lists/$files[$i]/transaction_histories/dates/date.send_amount.txt";
            $send_money_date_file = file($send_money_dates_path);

            $send_money_receiver_path = "./storages/customer_lists/$files[$i]/transaction_histories/sent_amount_receiver.txt";
            $send_money_receiver = file($send_money_receiver_path);


            $send_money_s_n = 1;
            for($j=1; $j<count($send_money_file); $j++){
                $send_money_amount = $send_money_file[$j];
                $send_money_date = $send_money_date_file[$j];
                $receiver = $send_money_receiver[$j];
                echo "     $send_money_s_n."."Send Money Amount(Taka): ".$send_money_amount."       Receiver: $receiver"."       Send Money Date: $send_money_date";
                echo"\n";
                $send_money_s_n++;
            }
            

            //Received Money and Date
            echo " #### Received Money History: ####\n\n";
            $received_money_amount_path ="./storages/customer_lists/$files[$i]/transaction_histories/received_amount.txt";
            $received_money_file = file($received_money_amount_path);

            $received_money_dates_path = "./storages/customer_lists/$files[$i]/transaction_histories/dates/date.received_money.txt";
            $received_money_date_file = file($received_money_dates_path);

            $received_money_sender_path = "./storages/customer_lists/$files[$i]/transaction_histories/received_amount_sender.txt";
            $received_money_sender = file($received_money_sender_path);


            $received_money_s_n = 1;
            for($j=1; $j<count($received_money_file); $j++){
                $received_money_amount = $received_money_file[$j];
                $received_money_date = $received_money_date_file[$j];
                $sender = $received_money_sender[$j];
                echo "     $received_money_s_n."."Received Money Amount(Taka): ".$received_money_amount."       Sender: $sender"."       Received Money Date: $received_money_date";
                echo"\n";
                $received_money_s_n++;
            }
                                
          echo"\n";
          $customer_sr_no++;

        }
    }
    public function specificUserTransaction(){
                                
        $customer_email = readline("Enter Customer Email: "); 
        $customer_email = trim($customer_email);

        if(file_exists("./storages/customer_lists/$customer_email")){

        $file_path = "./storages/customer_lists/$customer_email/profileInfo.txt";
        $open_file = fopen("$file_path", "r");
        $name = fgets($open_file);    

        // Transaction of specific user 
        echo "\n";
        echo " ############################################## \n";
        echo "   Transaction history of: $name ";
        echo " ############################################## \n";

        echo " Customer Email: $customer_email \n";

        //Total Amount
        $file_path = "./storages/customer_lists/$customer_email/total_amount.txt";
        $open_file = fopen("$file_path", "r");
        $total_balance = fgets($open_file);
        echo " Total Balance(Taka): $total_balance\n\n";
        
        //Deposite History Amount and Date
        echo " #### Deposite History: ####\n\n";
        $deposite_amount_path ="./storages/customer_lists/$customer_email/transaction_histories/deposite_amount.txt";
        $deposite_file = file($deposite_amount_path);

        $deposite_dates_path = "./storages/customer_lists/$customer_email/transaction_histories/dates/date.deposite.txt";
        $deposite_date_file = file($deposite_dates_path);

        $deposite_s_n = 1;
        for($j=0; $j<count($deposite_file); $j++){
            $deposite_amount = $deposite_file[$j];
            $deposite_date = $deposite_date_file[$j];
            echo "     $deposite_s_n."."Deposite Amount(Taka): ".$deposite_amount."       Deposite Date: $deposite_date";
            echo"\n";
            $deposite_s_n++;
        }
        
            //Withdraw Amount and Date
            echo " #### Withdraw History: ####\n\n";
            $withdraw_amount_path ="./storages/customer_lists/$customer_email/transaction_histories/withdraw_amount.txt";
            $withdraw_file = file($withdraw_amount_path);

            $withdraw_dates_path = "./storages/customer_lists/$customer_email/transaction_histories/dates/date.withdraw.txt";
            $withdraw_date_file = file($withdraw_dates_path);


            $withdraw_s_n = 1;
            for($j=1; $j<count($withdraw_file); $j++){
                $withdraw_amount = $withdraw_file[$j];
                $withdraw_date = $withdraw_date_file[$j];
                echo "     $withdraw_s_n."."Withdraw Anount(Taka): ".$withdraw_amount."       Withdraw Date: $withdraw_date";
                echo"\n";
                $withdraw_s_n++;
            }
                    
            //Send Money and Date
            echo " #### Send Money History: ####\n\n";
            $send_money_amount_path ="./storages/customer_lists/$customer_email/transaction_histories/sent_amount.txt";
            $send_money_file = file($send_money_amount_path);

            $send_money_dates_path = "./storages/customer_lists/$customer_email/transaction_histories/dates/date.send_amount.txt";
            $send_money_date_file = file($send_money_dates_path);

            $send_money_receiver_path = "./storages/customer_lists/$customer_email/transaction_histories/sent_amount_receiver.txt";
            $send_money_receiver = file($send_money_receiver_path);


            $send_money_s_n = 1;
            for($j=1; $j<count($send_money_file); $j++){
                $send_money_amount = $send_money_file[$j];
                $send_money_date = $send_money_date_file[$j];
                $receiver = $send_money_receiver[$j];
                echo "     $send_money_s_n."."Send Money Amount(Taka): ".$send_money_amount."       Receiver: $receiver"."       Send Money Date: $send_money_date";
                echo"\n";
                $send_money_s_n++;
            }
            

            //Received Money and Date
            echo " #### Received Money History: ####\n\n";
            $received_money_amount_path ="./storages/customer_lists/$customer_email/transaction_histories/received_amount.txt";
            $received_money_file = file($received_money_amount_path);

            $received_money_dates_path = "./storages/customer_lists/$customer_email/transaction_histories/dates/date.received_money.txt";
            $received_money_date_file = file($received_money_dates_path);

            $received_money_sender_path = "./storages/customer_lists/$customer_email/transaction_histories/received_amount_sender.txt";
            $received_money_sender = file($received_money_sender_path);


            $received_money_s_n = 1;
            for($j=1; $j<count($received_money_file); $j++){
                $received_money_amount = $received_money_file[$j];
                $received_money_date = $received_money_date_file[$j];
                $sender = $received_money_sender[$j];
                echo "     $received_money_s_n."."Received Money Amount(Taka): ".$received_money_amount."       Sender: $sender"."       Received Money Date: $received_money_date";
                echo"\n";
                $received_money_s_n++;
            }


        }else{
            echo "No Customer On This Email: $customer_email";
        }      
    }
    public function customerList(){

        echo "\n";
        echo "Customer Lists: \n\n";
        $path    = './storages/customer_lists/';
        $files = scandir($path);

        $sr_no = 1;
        for( $i=2; $i < count($files); $i++){
          $open_file = fopen("./storages/customer_lists/$files[$i]/profileInfo.txt", "r");
          $name = fgets($open_file);
          echo "$sr_no.$name";
            $sr_no++;
            fclose($open_file);
        }

    }
}