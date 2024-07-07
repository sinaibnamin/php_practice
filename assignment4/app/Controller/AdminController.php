<?php
namespace App\Controller;

use App\Controller\BaseController;

class AdminController extends BaseController{


    // get all customer 
    public function getAllCustomer(){
        $stmt = $this->db->prepare("SELECT * FROM customers");
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








   
}
?>
