<?php
require __DIR__ . '/config.php';
class API{
    function SelectUsers(){
        $db = new Connect;
        $users = array();
        $data = $db->prepare('SELECT * from users ORDER BY userID');
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $users[] = array(
                
                'username' => $OutputData['username'],
                'password' => $OutputData['password'],
                'nameSurname' => $OutputData['nameSurname'],
                'email' => $OutputData['email'],
                'picture' => $OutputData['picture']
            );
        }
        return json_encode($users,JSON_PRETTY_PRINT); 
    }

    function SelectGame(){
        $db = new Connect;
        $game = array();
        $data = $db->prepare('SELECT * from game ORDER BY id');
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $game[$OutputData['id']] = array(
                'id' => $OutputData['id'],
                'title' => $OutputData['title'],
                'grade' => $OutputData['grade'],
                'description' => $OutputData['description'],
                'year' => $OutputData['year'],
                'genre' => $OutputData['genre'],
                'platform' => $OutputData['platform'],
                'price' => $OutputData['price'],
                'image' => $OutputData['image']
            );
        }
        return json_encode($game);
    }
    function SelectReview(){
        $db = new Connect;
        $review = array();
        $data = $db->prepare('SELECT * from review ORDER BY id');
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $review[$OutputData['id']] = array(
                'id' => $OutputData['id'],
                'username' => $OutputData['username'],
                'gameTitle' => $OutputData['gameTitle'],
                'review' => $OutputData['review']
            );
        }
        return json_encode($review);
    }
    function SelectPurchase(){
        $db = new Connect;
        $purchase = array();
        $data = $db->prepare('SELECT * from purchase ORDER BY id');
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $purchase[$OutputData['id']] = array(
                'id' => $OutputData['id'],
                'username' => $OutputData['username'],
                'gameTitle' => $OutputData['gameTitle'],
                'price' => $OutputData['price']
            );
        }
        return json_encode($purchase);
    }
}

$API = new API;
header('Content-Type: application/json');
echo $API->SelectUsers();
$data = $API->SelectUsers();
$file_name = 'users' . 'json';
file_put_contents($file_name, $data);
echo $API->SelectGame();
echo $API->SelectReview();
echo $API->SelectPurchase();
?>