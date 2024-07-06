<?php
namespace App\Controller;

class BaseController {
    protected $db;

    public function __construct($db) {
        date_default_timezone_set('Asia/Dhaka');
        $this->db = $db;
    }

    public function createFlashMsg($type, $message){
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }
    public function getFlashMsg() {
        $final_msg = '';
        $alertClasses = [
            'success' => 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative',
            'info' => 'bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative',
            'danger' => 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative'
        ];
        if (isset($_SESSION['flash'])) {
            $type = $_SESSION['flash']['type'];
            $message = $_SESSION['flash']['message'];
            $final_msg =  "<div class='{$alertClasses[$type]}' role='alert'>
                                <span class='block sm:inline'>$message</span>
                            </div>";
            unset($_SESSION['flash']); 
        }
        return $final_msg;
    }


}