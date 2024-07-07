<?php
namespace App\Controller;

use App\Controller\BaseController;

class CustomerController extends BaseController{
        
    // Create
    public function create($first_name, $last_name, $email, $password) {
   
        // Check if email already exists
        $stmt = $this->db->prepare("SELECT email FROM customers WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $result = $stmt->execute();

        $row = $result->fetchArray(SQLITE3_ASSOC);
        if ($row) {
            $this->createFlashMsg('danger', 'This email already exists');
            return;
        }
            

            // If email doesn't exist, proceed with registration
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO customers (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);
            $result = $stmt->execute();

            if ($result === false) {
                // Handle INSERT query error
                throw new Exception("Error inserting customer data");
            }
            
            // Success message and redirect
            $this->createFlashMsg('success', 'Registration successful. You can now sign in.');
            // header('Location: login.php');
            // exit;
            return;

      
    }



    // Login
    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $result = $stmt->execute();
        $customer = $result->fetchArray(SQLITE3_ASSOC);

        if ($customer && password_verify($password, $customer['password'])) {
            $_SESSION['customer_first_name'] = $customer['first_name'];
            $_SESSION['customer_last_name'] = $customer['last_name'];
            $_SESSION['customer_email'] = $customer['email'];
            header('Location: /customer/dashboard.php');
            exit(); 
        } else {
            $this->createFlashMsg('danger', 'Invalid credentials.');
            return;
        }
    }
    // check Login
    public function checkLogin() {
        if (!isset($_SESSION['customer_email'])) {
            $this->createFlashMsg('danger', 'please login first');
            header('Location: /login.php');
            exit; 
        }
        return;
    }
    // check Logout
    public function checkLogout() {
        if (isset($_SESSION['customer_email'])) {
            header('Location: /customer/dashboard.php');
            exit();
        }
        return;
    }

    public function get_customer_session_info() {
        $customer_session_info = [
            'email' => $_SESSION['customer_email'],
            'first_name' => $_SESSION['customer_first_name'],
            'last_name' => $_SESSION['customer_last_name']
        ]; 
        return $customer_session_info;
    }



    // Deposit
    public function deposit($amount) {
        // get customer info 
        $customer_email = $_SESSION['customer_email'];
        $currentTimestamp = date('Y-m-d H:i:s');
        $type = 'deposit';
        
        $stmt = $this->db->prepare("INSERT INTO transactions (type, from_account_email, amount, timestamp) VALUES (:type, :from_account_email, :amount, :timestamp)");

        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':from_account_email', $customer_email);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':timestamp', $currentTimestamp);
        $stmt->execute();
        $this->createFlashMsg('success', 'amount deposited successfully');
        return;

    }

    // Withdraw
    public function withdraw($amount) {
        // get customer info 
        $customer_email = $_SESSION['customer_email'];
        $currentTimestamp = date('Y-m-d H:i:s');
        $type = 'withdraw';

        // check available balance 
        if($this->currentBalance() < $amount){
            $this->createFlashMsg('danger', "you have not sufficient balance to withdraw $". $amount );
            return;
        }

        
        $stmt = $this->db->prepare("INSERT INTO transactions (type, from_account_email, to_account_email, amount, timestamp) VALUES (:type, :from_account_email, :to_account_email, :amount, :timestamp)");

        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':from_account_email', $customer_email);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':timestamp', $currentTimestamp);
        $stmt->execute();
        $this->createFlashMsg('success', 'amount withdraw successfully');
        return;

    }


    // Transfer
    public function transfer($amount, $email) {

        $to_account_email = '';

        // check if email exist in database 
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
        if (!$row) {
            $this->createFlashMsg('danger', 'This email not exists on our database');
            return;
        }
        $to_account_email = $row['email'];

        // check if he transfer his own email
        if($to_account_email == $_SESSION['customer_email']){
            $this->createFlashMsg('danger', 'you can not transfer money on your own email!');
            return;
        } 

        // check available balance 
        if($this->currentBalance() < $amount){
            $this->createFlashMsg('danger', "you have not sufficient balance to transfer $". $amount );
            return;
        }

        // get customer info 
        $customer_email = $_SESSION['customer_email'];
        $currentTimestamp = date('Y-m-d H:i:s');
        $type = 'transfer';

        $stmt = $this->db->prepare("INSERT INTO transactions (type, from_account_email,  to_account_email, amount, timestamp) VALUES (:type, :from_account_email, :to_account_email, :amount, :timestamp)");

        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':from_account_email', $customer_email);
        $stmt->bindParam(':to_account_email', $to_account_email);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':timestamp', $currentTimestamp);
        $stmt->execute();
        $this->createFlashMsg('success', "Amount transferred to {$to_account_email} successfully");
        return;

    }

    public function currentBalance() {
        $customer_email = $_SESSION['customer_email'];
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE (from_account_email = :from_account_email OR to_account_email = :to_account_email)");
        $stmt->bindValue(':from_account_email', $customer_email, SQLITE3_TEXT);
        $stmt->bindValue(':to_account_email', $customer_email, SQLITE3_TEXT);
        $result = $stmt->execute();
        $balance = 0;
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            if($row['type'] == 'deposit'){
                $balance += $row['amount'];
            }
            if($row['type'] == 'transfer' && $row['from_account_email'] == $customer_email){
                $balance -= $row['amount'];
            }
            if($row['type'] == 'transfer' && $row['to_account_email'] == $customer_email){
                $balance += $row['amount'];
            }
            if($row['type'] == 'withdraw'){
                $balance -= $row['amount'];
            }
          
        }
        return $balance; 
    }
    public function customerAllTransaction($query_email = '') {
        if ($query_email !== '') {
            $customer_email = $query_email;
          } else {
            $customer_email = $_SESSION['customer_email'];
          }
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE (from_account_email = :from_account_email OR to_account_email = :to_account_email)");
        $stmt->bindValue(':from_account_email', $customer_email, SQLITE3_TEXT);
        $stmt->bindValue(':to_account_email', $customer_email, SQLITE3_TEXT);
        $result = $stmt->execute();

       
        $transactions = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            if($row['type'] == 'deposit'){
                $row['color'] = 'green';
                $row['currency_sign'] = '$';
            }
            if($row['type'] == 'withdraw'){
                $row['color'] = 'red';
                $row['currency_sign'] = '-$';
            }
            if($row['type'] == 'transfer' && $row['from_account_email'] == $customer_email){
                $row['color'] = 'red';
                $row['currency_sign'] = '-$';
            }
            if($row['type'] == 'transfer' && $row['to_account_email'] == $customer_email){
                $row['color'] = 'green';
                $row['currency_sign'] = '$';
            }
            $transactions[] = $row;
        }
        return $transactions; 
    }







   
}
?>
