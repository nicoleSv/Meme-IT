<?php
session_start();

class UserController extends BaseController {
    private static $controller = 'user';

    // HTTP Method: POST
    public function register() {
        
        if(isset($_POST) && isset($_POST['registration'])) {
            $user = new UserModel();

            $user->email = $_POST['email'];
            $user->name = $_POST['name'];
            $user->fn = $_POST['fn'];
            $user->topic_id = $_POST['topic_id'];
            $user->password = $_POST['password'];

            $password_2 = $_POST['password_confirm'];

            $errors = UserController::validateRegistrationData($user, $password_2);

            if(count($errors) == 0) {
                $user->addUser();
                BaseController::load('/home.php');
                UserController::setSession($user);
            }
            else {
                BaseController::load('/register.php', $errors);
            }
            
        }
    }

    // HTTP Method: POST
    public function login() {
        if(isset($_POST) && isset($_POST['login'])) {
            $user = new UserModel();
            $user->email = $_POST['email'];
            $user->password = $_POST['password'];

            $errors = UserController::validateLoginData($user);

            if(count($errors) == 0) {
                $user_data = $user->getUser();
                if(!empty($user_data)) {
                    $encrypted_password = $user_data['password'];

                    if(!empty($encrypted_password)) {
                        if(password_verify($user->password, $encrypted_password)) {
                            UserController::setSession($user);
                            UserController::index();
                        }
                        else {
                            array_push($errors, "Wrong password!");
                            BaseController::load('/login.php', $errors);
                        }
                    }
                }
                else {
                    array_push($errors, "Account with this email does not exist!");
                    BaseController::load('/login.php', $errors);
                }
            }
            else {
                BaseController::load('/login.php', $errors);
            }
        }
    }

    // HTTP Method: GET
    public function logout() {
        session_unset();
        session_destroy();

        BaseController::load('/login.php');
    }

    // HTTP Method: GET
    public function index() {
        if(UserController::isLogged()) {
            BaseController::load('/home.php');
        }
        else {
            BaseController::load('/login.php');
        }  
    }

    // HTTP Method: POST 
    public function getUsers() {
        if(UserController::isLogged()) {
            if($_SERVER['CONTENT_TYPE'] == 'application/json') {
                $data = json_decode(file_get_contents('php://input'), false);

                if(isset($data)) {
                    $user = new UserModel();
                    $names = array();

                    foreach($data as $topic_id) {
                        $user->topic_id = $topic_id;
                        $names[] = array('name' => $user->getNameByTopic());
                    }

                    if(empty($names)) {
                        echo json_encode(array('message' => 'noNames'),JSON_UNESCAPED_UNICODE);
                        return;
                    }

                    echo json_encode($names, JSON_UNESCAPED_UNICODE);
                    return;
                }
            }  
        }
        else {
            echo json_encode(array('message' => 'error'),JSON_UNESCAPED_UNICODE);
            return;
        }

    }

    private function validateRegistrationData($user, $password_2) {
        $errors = array();
        if(empty($user->email)) { array_push($errors, "Email is required!"); }
        if(empty($user->name)) { array_push($errors, "Name is required!"); }
        if(empty($user->fn)) { array_push($errors, "Faculty number is required!"); }
        if(empty($user->topic_id)) { array_push($errors, "Topic is required!"); }
        if(empty($user->password)) { array_push($errors, "Password is required!"); }

        if(!empty($user->getUser())) { array_push($errors, "Account with this email already exists!"); }
        if(!filter_var($user->email, FILTER_VALIDATE_EMAIL)) { array_push($errors, "Invalid email!"); }

        if($user->fn <= 0) { array_push($errors, "Invalid faculty number!"); }
        if(!empty($user->checkForFn())) { array_push($errors, "Account with this faculty number already exists!"); }
        if(!empty($user->checkForTopic())) { array_push($errors, "This topic is already chosen!"); }     

        if(strlen($user->password) < 6) { array_push($errors, "Password must be at least 6 symbols long!"); }
        if($user->password != $password_2) { array_push($errors, "Passwords do not match!"); }

        return $errors;
    }

    private function validateLoginData($user) {
        $errors = array();

        if(empty($user->email)) { array_push($errors, "Email is required!"); }
        if(empty($user->password)) { array_push($errors, "Password is required!"); }

        $email_length = is_string($user->email) ? strlen($user->email) : 0;
        if($email_length <= 0 || $email_length > 255 || !filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Invalid email");
        }

        $pass_length = is_string($user->password) ? strlen($user->password) : 0;
        if($pass_length <= 0 || $pass_length > 2048) {
            array_push($errors, "Invalid password");
        }

        return $errors;
    }

    private function setSession($user) {
        $userData = $user->getUser();
        $_SESSION['id'] = $userData['id'];
    }

    public function isLogged() {
        return isset($_SESSION) && isset($_SESSION['id']);
    }

    public function showTopic() {
        if(UserController::isLogged()) {
            $user = new UserModel();
            $user->id = $_SESSION['id'];
            $user->name = $user->getName();

            $topic = new TopicModel();
            $topic->id = $user->getTopicId();
            $topic->title = $topic->getTitle();
            $topic->visible = $topic->getVisibility();

            $data = array();
            array_push($data, $user->name);
            array_push($data, $topic->title);
            array_push($data, $topic->visible);
            BaseController::load('/generator.php', $data);
        }
    }

    public function loadCollection() {
        if(UserController::isLogged()) {
            BaseController::load('/collection.php');
        }
        else {
            BaseController::load('/login.php');
        }
    }

    public function loadRegistration() {
        if(UserController::isLogged()) {
            BaseController::load('/home.php');
        }
        else {
            BaseController::load('/register.php');
        }
    }
}
?>