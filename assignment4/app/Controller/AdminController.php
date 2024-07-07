<?php
namespace App\Controller;

use App\Controller\BaseController;

class AdminController extends BaseController{


    // get all customer 
    public function getAllCustomer($query_email = ''){
        $stmt = $this->db->prepare("SELECT * FROM customers");
        if ($query_email !== '') {
            $stmt = $this->db->prepare("SELECT * FROM customers WHERE email = :email");
            $stmt->bindParam(':email', $query_email);
          } 


       
        $result = $stmt->execute();
        $customers = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $customers[] = $row;
        }
       
        return $customers; 

    }
    // get all customer 
    public function getAllTransactions(){
        $stmt = $this->db->prepare("SELECT * FROM transactions");
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
          
            if($row['type'] == 'transfer'){
                $row['color'] = 'green';
                $row['currency_sign'] = '$';
            }
            $transactions[] = $row;
        }
        return $transactions; 

    }


// Login
public function login($email, $password) {
    $stmt = $this->db->prepare("SELECT * FROM admins WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $result = $stmt->execute();
    $admin = $result->fetchArray(SQLITE3_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_name'] = $admin['name'];
        $_SESSION['admin_email'] = $admin['email'];
        header('Location: /admin/customers.php');
        exit(); 
    } else {
        $this->createFlashMsg('danger', 'Invalid credentials.');
        return;
    }
}

// check Login
public function checkLogin() {
    if (!isset($_SESSION['admin_email'])) {
        $this->createFlashMsg('danger', 'please login first');
        header('Location: /admin/login.php');
        exit; 
    }
    return;
}
// check Logout
public function checkLogout() {
    if (isset($_SESSION['admin_email'])) {
        header('Location: /admin/customers.php');
        exit();
    }
    return;
}
public function get_admin_session_info() {
    $admin_session_info = [
        'email' => $_SESSION['admin_email'],
        'name' => $_SESSION['admin_name'],
    ]; 
    return $admin_session_info;
}




   
}
?>
