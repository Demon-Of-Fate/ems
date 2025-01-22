<?php
// config/config.php
define('DB_HOST', 'localhost');
define('DB_USER', 'username');
define('DB_PASS', 'password');
define('BASE_URL', 'https://yoursite.com');

// includes/Database.php
class Database {
    private $conn;
    
    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=your_database",
                DB_USER,
                DB_PASS
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            error_log("Connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed");
        }
    }
}

// includes/Auth.php
class Auth {
    private $db;
    
    public function __construct(Database $db) {
        $this->db = $db;
        
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Set security headers
        $this->setSecurityHeaders();
    }
    
    private function setSecurityHeaders() {
        // Prevent clickjacking attacks
        header("X-Frame-Options: DENY");
        
        // Help prevent XSS attacks
        header("X-XSS-Protection: 1; mode=block");
        
        // Prevent MIME-sniffing
        header("X-Content-Type-Options: nosniff");
        
        // Strict Transport Security (force HTTPS)
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
        
        // Content Security Policy
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';");
        
        // Referrer Policy
        header("Referrer-Policy: strict-origin-when-cross-origin");
        
        // Permissions Policy
        header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
    }
    
    public function login($email, $password) {
        // Validate inputs
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
        
        // Add brute force protection
        if ($this->isIpBlocked($_SERVER['REMOTE_ADDR'])) {
            throw new Exception("Too many login attempts. Please try again later.");
        }
        
        // Perform login logic here
        // ...
    }
}?>

// public/login.php
<?php
require_once '../config/config.php';
require_once '../includes/Database.php';
require_once '../includes/Auth.php';

try {
    $db = new Database();
    $auth = new Auth($db);
    
    // Your login form processing logic here
} catch (Exception $e) {
    error_log($e->getMessage());
    header("Location: error.php");
    exit();
}
?>
