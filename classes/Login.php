<?php
require_once '../config.php';
class Login extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		ini_set('display_error', 1);
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function index(){
		echo "<h1>Access Denied</h1> <a href='".base_url."'>Go Back.</a>";
	}
	public function login_old(){
		extract($_POST);
		$qry = $this->conn->query("SELECT * from users where username = '$username' and password = md5('$password') ");
		if($qry->num_rows > 0){
			foreach($qry->fetch_array() as $k => $v){
				if(!is_numeric($k) && $k != 'password'){
					$this->settings->set_userdata($k,$v);
					
				}
			}
			return json_encode(['status' => 'success']);
		}else{
			return json_encode(['status' => 'incorrect', 'message' => 'Invalid username or password.']);
		}
	}

	public function login(){
		extract($_POST);

		 // Check if the required fields are set
		 if (empty($_POST['username']) || empty($_POST['password'])) {
			return json_encode(['status' => 'error', 'message' => 'Username and password are required.']);
		}
	
		// Sanitize user inputs to prevent SQL injection
		$username = trim($_POST['username']);
		$password = $_POST['password'];
	
		// Prepare a parameterized query
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
		if (!$stmt) {
			return json_encode(['status' => 'error', 'message' => 'Database query error.']);
		}
	
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
	
		if ($result->num_rows > 0) {
			$user = $result->fetch_assoc();
			   // Determine the hash type (bcrypt vs MD5)
			   if (password_verify($password, $user['password'])) {
				// Password matches with bcrypt
	
				// Set user data in session (excluding sensitive information like password)
				foreach ($user as $key => $value) {
					if (!is_numeric($key) && $key != 'password') {
						$this->settings->set_userdata($key, $value);
					}
				}
	
				return json_encode(['status' => 'success']);
			} elseif (md5($password) === $user['password']) {
				// Password matches with MD5 - upgrade hash to bcrypt
				$newHashedPassword = password_hash($password, PASSWORD_BCRYPT);
	
				//echo $newHashedPassword;
				echo $user['user_id'];
				// Update the database with the new hash
				$updateStmt = $this->conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
				$updateStmt->bind_param("si", $newHashedPassword, $user['user_id']);
				$updateStmt->execute();
	
				// Set user data in session
				foreach ($user as $key => $value) {
					// Exclude numeric keys and the 'password' field
					if (!is_numeric($key) && $key !== 'password') {
						// Set the session data safely
						$this->settings->set_userdata($key, htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
					}
				}
					
				return json_encode(['status' => 'success']);
			} else {
				// Incorrect password
				return json_encode(['status' => 'incorrect', 'message' => 'Invalid username or password.']);
			}
		} else {
			// User not found
			return json_encode(['status' => 'incorrect', 'message' => 'Invalid username or password.']);
		}
	}

	public function logout() {

		if ($this->settings->sess_des()) {
			session_destroy();
			session_set_cookie_params(0);
			redirect('auth/login.php');
	}}
	
}
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'login':
		echo $auth->login();
		break;
	case 'logout':
		echo $auth->logout();
		break;
	default:
		echo $auth->index();
		break;
}

