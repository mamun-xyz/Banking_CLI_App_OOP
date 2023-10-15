<?php
namespace App\customers\login;

date_default_timezone_set("Asia/Dhaka");

class ShowCustomerInfo{

   public function runTotalAmount(){
    $login_email = file_get_contents("./app/customers/login/temp_data.txt");
    //Run Automatically Total Amount  
    //Deposite Amount
    $open_deposite_amount = fopen("./storages/customer_lists/$login_email/deposite_amount.txt", "r") or die("Unable to open deposite amount file!");
    $deposite_amount = fgets($open_deposite_amount);
    fclose($open_deposite_amount);
    
    //Received Amount
    $open_received_amount = fopen("./storages/customer_lists/$login_email/received_amount.txt", "r") or die("Unable to open received amount file!");
    $received_amount = fgets($open_received_amount);
    fclose($open_received_amount);
    
    //Withdraw Amount
    $open_withdraw_amount = fopen("./storages/customer_lists/$login_email/withdraw_amount.txt", "r") or die("Unable to open withdraw amount file!");
    $withdraw_amount = fgets($open_withdraw_amount);
    fclose($open_withdraw_amount);
        
    //Transfer Amount
    $open_transfer_amount = fopen("./storages/customer_lists/$login_email/transfer_amount.txt", "r") or die("Unable to open transfer amount file!");
    $transfer_amount = fgets($open_transfer_amount);
    fclose($open_transfer_amount);
        
    $total_credit = ($deposite_amount + $received_amount);
    $total_debit = ($withdraw_amount + $transfer_amount);

    $current_balance = ($total_credit - $total_debit);

    $open_total_balance = fopen("./storages/customer_lists/$login_email/total_amount.txt", "w+") or die("Unable to open total amount file!");
    fwrite($open_total_balance, "$current_balance");
    fclose($open_total_balance);  

    file_put_contents("./storages/customer_lists/$login_email/temp_total_balance.txt", "$current_balance");
    //End Run Automatically Total Amount                     
    }



    public function depositeMoney(){

        $login_email = file_get_contents("./app/customers/login/temp_data.txt");

        $new_deposite = readline("Enter Deposite Amount: ");
        if(!empty($new_deposite)){
            $open_old_deposite = fopen("./storages/customer_lists/$login_email/deposite_amount.txt", "r") or die("Unable to open deposite file!");
           $old_deposite = fgets($open_old_deposite);
           fclose($open_old_deposite);
        
        if($new_deposite && $old_deposite !==null) {
            
        $total_deposite = ($new_deposite + $old_deposite);
          $open_deposite_file = fopen("./storages/customer_lists/$login_email/deposite_amount.txt", "w+") or die("Unable to open file!");
          fwrite($open_deposite_file, "$total_deposite");
          fclose($open_deposite_file);
            echo "You Deposte: $new_deposite Taka.\n";

        //Save Deposite Transaction.
        $deposite_transaction = fopen("./storages/customer_lists/$login_email/transaction_histories/deposite_amount.txt", "a+") or die("Unable to create file!");
        $deposites_saved = fwrite($deposite_transaction, "$new_deposite\n");
        fclose($deposite_transaction);
        //End Save Deposite Transaction part.
        //date deposite
        if(!empty($deposites_saved)){
            $open_deposite_date_file = fopen("./storages/customer_lists/$login_email/transaction_histories/dates/date.deposite.txt", "a+") or die("Unable to create file!"); 
            $date = date('d/m/Y  h:i:s A');
            fwrite($open_deposite_date_file, "$date\n");
            fclose($open_deposite_date_file);
        }else{
            //echo "date not saved";
        }

        } else{
            echo "Error, Old/New Deposite Not Found";
        }  
       }else{
           echo "Deposite Amount Not Be Empty";
       }

    }

    public function withdrawMoney(){    
        $login_email = file_get_contents("./app/customers/login/temp_data.txt");                          
        $withdraw_amount = readline("Enter Withdraw Amount: ");
        if(!empty($withdraw_amount)){
            $open_total_amount = fopen("./storages/customer_lists/$login_email/total_amount.txt", "r") or die("Unable to open total amount file!");
            $total_amount = fgets($open_total_amount);
            fclose($open_total_amount);

            if($withdraw_amount <= $total_amount){      
        $open_old_withdraw_amount = fopen("./storages/customer_lists/$login_email/withdraw_amount.txt", "r") or die("Unable to open received amount file!");
        $old_withdraw_amount = fgets($open_old_withdraw_amount);
        fclose($open_old_withdraw_amount);  
        
        $total_withdraw_amount = ($old_withdraw_amount + $withdraw_amount);

         $open_withdraw_file = fopen("./storages/customer_lists/$login_email/withdraw_amount.txt", "w+") or die("Unable to open withdraw file!");
         fwrite($open_withdraw_file, "$total_withdraw_amount");
         fclose( $open_withdraw_file);
           echo "You successfully withdraw: $withdraw_amount Taka.\n";

        //Save Withdraw Transaction.
        $withdraw_transaction = fopen("./storages/customer_lists/$login_email/transaction_histories/withdraw_amount.txt", "a+") or die("Unable to create file!");
        $withdraw_saved = fwrite($withdraw_transaction, "$withdraw_amount\n");
        fclose($withdraw_transaction);
        //End Save Withdraw Transaction part.
        //date  withdraw 
        if(!empty($withdraw_saved)){
            $open_withdraw_date_file = fopen("./storages/customer_lists/$login_email/transaction_histories/dates/date.withdraw.txt", "a+") or die("Unable to create file!"); 
            $date = date('d/m/Y  h:i:s A');
            fwrite($open_withdraw_date_file, "$date\n");
            fclose($open_withdraw_date_file);
        }else{
            //echo "date not saved";
        }

            }else{
                echo "No Avaible Balance\n";
                echo "Total Avaible Balance: $total_amount Taka.";
            }

        }else{
            echo "Enter Withdraw Amount";
        }

    }    

    public function transferMoney(){

        $login_email = file_get_contents("./app/customers/login/temp_data.txt");
       
        $receiver_email = readline("Enter receiver email: ");
        $transfer_amount = readline("Enter transfer amount: ");

     if(!empty($receiver_email && $transfer_amount)){
         //my total amount/current balance
         $open_total_amount = fopen("./storages/customer_lists/$login_email/total_amount.txt", "r") or die("Unable to open total amount file!");
         $total_amount = fgets($open_total_amount);
         fclose($open_total_amount);
         if($transfer_amount <= $total_amount){
             //Who Received amount and how much received
              if(file_exists("./storages/customer_lists/$receiver_email")){
             // access receiver amount
             $open_receiver_old_amount = fopen("./storages/customer_lists/$receiver_email/received_amount.txt", "r") or die("Unable to open received amount file!");
             $receiver_old_amount = fgets($open_receiver_old_amount);
             fclose($open_receiver_old_amount);

                  $total_receiver_amount =($receiver_old_amount + $transfer_amount);

                 //sent money to receiver
                  $open_receiver_file = fopen("./storages/customer_lists/$receiver_email/received_amount.txt", "w+") or die("Unable to open receiver file!");
                  fwrite($open_receiver_file, "$total_receiver_amount");
                  fclose($open_receiver_file);
                    echo "You successfully transfer: $transfer_amount taka to $receiver_email";  

             //minuse transfer amount from me(sender)       
             if(!empty($login_email && $total_receiver_amount)){
                 $open_old_transfer_amount = fopen("./storages/customer_lists/$login_email/transfer_amount.txt", "r") or die("Unable to open sender transfer amount file!");
                 $old_transfer_amount = fgets($open_old_transfer_amount);
                 fclose($open_old_transfer_amount);

                 $total_transfer_amount =($old_transfer_amount + $transfer_amount);
                 
                 $open_transfer_file = fopen("./storages/customer_lists/$login_email/transfer_amount.txt", "w+") or die("Unable to open transfer file!");
                 fwrite($open_transfer_file, "$total_transfer_amount");
                 fclose($open_transfer_file);

     //Save sent Amount Transaction. how much sent
     $sent_amount_transaction = fopen("./storages/customer_lists/$login_email/transaction_histories/sent_amount.txt", "a+") or die("Unable to create file!");
     $send_money_saved = fwrite($sent_amount_transaction, "$transfer_amount\n");
     fclose($sent_amount_transaction);
     //End Save Transfer Amount Transaction part.
     //date  send money 
     if(!empty($send_money_saved)){
         $open_send_money_date_file = fopen("./storages/customer_lists/$receiver_email/transaction_histories/dates/date.received_money.txt", "a+") or die("Unable to create file!"); 
         $date = date('d/m/Y  h:i:s A');
         fwrite($open_send_money_date_file, "$date\n");
         fclose($open_send_money_date_file);
     }else{
         //echo "date not saved";
     }

     //Save sender email Transaction.
     $sender_transaction = fopen("./storages/customer_lists/$receiver_email/transaction_histories/received_amount_sender.txt", "a+") or die("Unable to create file!");
     fwrite($sender_transaction, "$login_email\n");
     fclose($sender_transaction);
     //End Save sender email Transaction. part.

     //Save Received amount Transaction.
     $received_amount_transaction = fopen("./storages/customer_lists/$receiver_email/transaction_histories/received_amount.txt", "a+") or die("Unable to create file!");
     $received_money_saved = fwrite($received_amount_transaction, "$transfer_amount\n");
     fclose($received_amount_transaction);
     //End Save Received amount Transaction part.
     //date  received money 
     if(!empty($received_money_saved)){
         $open_received_money_date_file = fopen("./storages/customer_lists/$login_email/transaction_histories/dates/date.send_amount.txt", "a+") or die("Unable to create file!");  
         $date = date('d/m/Y  h:i:s A');
         fwrite($open_received_money_date_file, "$date\n");
         fclose($open_received_money_date_file);
     }else{
         //echo "date not saved";
     }                            

     //Save Receiver (who received money) Transaction.
     $receiver_transaction = fopen("./storages/customer_lists/$login_email/transaction_histories/sent_amount_receiver.txt", "a+") or die("Unable to create file!");
     fwrite($receiver_transaction, "$receiver_email\n");
     fclose($receiver_transaction);
     //End Save Receiver Transaction part.

                    }else{
                      echo "Problem! Transfer Amount Not Minimize From Sender";
                    }
                    
                    
              }else{
                  echo "Receiver Not Found";
              }                                    

         }else{
             echo "No Avaible Balance\n";
             echo "Total Avaible Balance: $total_amount Taka.";                                    
         }
     }else{
         echo "Enter receiver mail and amount";
     }                                                         

    }    

    public function currentBalance(){

    $login_email = file_get_contents("./app/customers/login/temp_data.txt");

    //Deposite Amount
    $open_deposite_amount = fopen("./storages/customer_lists/$login_email/deposite_amount.txt", "r") or die("Unable to open deposite amount file!");
    $deposite_amount = fgets($open_deposite_amount);
    fclose($open_deposite_amount);
    

    //Received Amount
    $open_received_amount = fopen("./storages/customer_lists/$login_email/received_amount.txt", "r") or die("Unable to open received amount file!");
    $received_amount = fgets($open_received_amount);
    fclose($open_received_amount);
    

    //Withdraw Amount
    $open_withdraw_amount = fopen("./storages/customer_lists/$login_email/withdraw_amount.txt", "r") or die("Unable to open withdraw amount file!");
    $withdraw_amount = fgets($open_withdraw_amount);
    fclose($open_withdraw_amount);
        
    
    //Transfer Amount
    $open_transfer_amount = fopen("./storages/customer_lists/$login_email/transfer_amount.txt", "r") or die("Unable to open transfer amount file!");
    $transfer_amount = fgets($open_transfer_amount);
    fclose($open_transfer_amount);
        
    
    $total_credit = ($deposite_amount + $received_amount);
    $total_debit = ($withdraw_amount + $transfer_amount);

    $current_balance = ($total_credit - $total_debit);

    $open_total_balance = fopen("./storages/customer_lists/$login_email/total_amount.txt", "w+") or die("Unable to open total amount file!");
    fwrite($open_total_balance, "$current_balance");
    fclose($open_total_balance);                        

    echo "Current Balance: $current_balance Taka.";
    file_put_contents("./storages/customer_lists/$login_email/temp_total_balance.txt", "$current_balance");
    
    }

    public function showTransaction(){
       
        $login_email = file_get_contents("./app/customers/login/temp_data.txt");
        $current_balance =  file_get_contents("./storages/customer_lists/$login_email/temp_total_balance.txt");

                //Deposite 
                echo "\n";
                echo "Total Available Balance: $current_balance Taka Only.";
                echo "\n";
                echo "\n";
                echo "Deposite History:\n";

                $deposites = file("./storages/customer_lists/$login_email/transaction_histories/deposite_amount.txt");

                $deposite_dates = file("./storages/customer_lists/$login_email/transaction_histories/dates/date.deposite.txt");

                $sr_no = 1;
                for ( $i= 0; $i < count($deposites); $i++) {
                    $result = " $sr_no."."Deposite Amount(Taka): "."$deposites[$i]"." Date: "."$deposite_dates[$i]";
                    echo "$result";
                    echo "\n";
                    echo "\n";
                    $sr_no++;
                    }
    //withdraw
                echo "Withdraw History:\n";

                $withdraws = file("./storages/customer_lists/$login_email/transaction_histories/withdraw_amount.txt");

                $withdraw_dates = file("./storages/customer_lists/$login_email/transaction_histories/dates/date.withdraw.txt");

                $sr_no = 1;
                for ( $i= 1; $i < count($withdraws); $i++) {
                    $result = " $sr_no."."Withdraw Amount(Taka): "."$withdraws[$i]"." Date: "."$withdraw_dates[$i]";
                    echo "$result";
                    echo "\n";
                    echo "\n";
                    $sr_no++;
                    }            

    //Send Money
    echo "Send Money History:\n";

    $send_money = file("./storages/customer_lists/$login_email/transaction_histories/sent_amount.txt");

    $receiver = file("./storages/customer_lists/$login_email/transaction_histories/sent_amount_receiver.txt");

    $send_money_dates = file("./storages/customer_lists/$login_email/transaction_histories/dates/date.send_amount.txt");

    $sr_no = 1;
    for ( $i= 1; $i < count($send_money); $i++) {
        $result = " $sr_no."."Send Amount(Taka): "."$send_money[$i]"." (Received by): "." $receiver[$i]"." Date: "."$send_money_dates[$i]";
        echo "$result";
        echo "\n";
        echo "\n";
        $sr_no++;
        }    
        

    //Received Money
    echo "Received Money History:\n";

    $received_money = file("./storages/customer_lists/$login_email/transaction_histories/received_amount.txt");

    $sender = file("./storages/customer_lists/$login_email/transaction_histories/received_amount_sender.txt");

    $received_money_dates = file("./storages/customer_lists/$login_email/transaction_histories/dates/date.received_money.txt");

    $sr_no = 1;
    for ( $i= 1; $i < count($received_money ); $i++) {
        $result = " $sr_no."."Received Amount(Taka): "."$received_money[$i]"." (Send by): "." $sender[$i]"." Date: "."$received_money_dates[$i]";
        echo "$result";
        echo "\n";
        echo "\n";
        $sr_no++;
        }     

    }

}