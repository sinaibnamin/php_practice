
// Login
    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $result = $stmt->execute();
        $admin = $result->fetchArray(SQLITE3_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_first_name'] = $admin['first_name'];
            $_SESSION['admin_last_name'] = $admin['last_name'];
            $_SESSION['admin_email'] = $admin['email'];
            header('Location: /admin/dashboard.php');
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
            header('Location: /login.php');
            exit; 
        }
        return;
    }
    // check Logout
    public function checkLogout() {
        if (isset($_SESSION['admin_email'])) {
            header('Location: /admin/dashboard.php');
            exit();
        }
        return;
    }