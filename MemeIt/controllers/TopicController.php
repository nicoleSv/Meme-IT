<?php 
class TopicController extends BaseController {
    private static $controller = 'topic';

    // HTTP Method: POST
    public function saveMeme() {
        if(UserController::isLogged()) {
            if($_SERVER['CONTENT_TYPE'] == 'application/json') {
                $data = json_decode(file_get_contents('php://input'), false);

                if(isset($data->image)) {
                    $user = new UserModel();
                    $user->id = $_SESSION['id'];

                    $topic = new TopicModel();
                    $topic->id = $user->getTopicId();

                    $topic->meme = $data->image;

                    $result = $topic->addMeme();
                    if(empty($result)) {
                        echo json_encode(array('message' => 'error'),JSON_UNESCAPED_UNICODE);
                        return;
                    }

                    echo json_encode(array('message' => 'success'),JSON_UNESCAPED_UNICODE);
                    return;
                }
            }  
        }
        else {
            echo json_encode(array('message' => 'error'),JSON_UNESCAPED_UNICODE);
            return;
        }

    }

    // HTTP Method: POST
    public function getMeme() {
        if(UserController::isLogged()) {
            $user = new UserModel();
            $user->id = $_SESSION['id'];

            $topic = new TopicModel();
            $topic->id = $user->getTopicId();

            if(!empty($topic->isMemeAvailable())) {
                $meme = $topic->getMeme();
                $meme = "data:image/jpeg;base64,". base64_encode($meme);
             
                echo json_encode(array('meme' => $meme), JSON_UNESCAPED_UNICODE);
            }
            else {
                echo json_encode(array('message' => 'noMemeAvailable'),JSON_UNESCAPED_UNICODE);
                return;
            }

        }
        else {
            echo json_encode(array('message' => 'error'),JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    // HTTP Method: POST
    public function updateVisibility() {
        if(UserController::isLogged()) {
            if($_SERVER['CONTENT_TYPE'] == 'application/json') {
                $data = json_decode(file_get_contents('php://input'), false);

                if(isset($data->visible)) {
                    $user = new UserModel();
                    $user->id = $_SESSION['id'];

                    $topic = new TopicModel();
                    $topic->id = $user->getTopicId();

                    $topic->visible = $data->visible;

                    $result = $topic->updateVisible();
                    if(empty($result)) {
                        echo json_encode(array('message' => 'error'),JSON_UNESCAPED_UNICODE);
                        return;
                    }

                    echo json_encode(array('message' => 'success'),JSON_UNESCAPED_UNICODE);
                    return;
                }
            }  
        }
        else {
            echo json_encode(array('message' => 'error'),JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    // HTTP Method: POST
    public function getAllMemes() {
        if(UserController::isLogged()) {
            // $user = new UserModel();
            // $user->id = $_SESSION['id'];

            $topic = new TopicModel();
            $data = $topic->getVisibleMemes();

            foreach ($data as &$row) {
                $row['meme'] = "data:image/jpeg;base64,". base64_encode($row['meme']);  
            }

            if(!empty($data)) {
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
            }
            else {
                echo json_encode(array('message' => 'noMemesAvailable'),JSON_UNESCAPED_UNICODE);
                return;
            }

        }
        else {
            echo json_encode(array('message' => 'error'),JSON_UNESCAPED_UNICODE);
            return;
        }
    }
}
?>