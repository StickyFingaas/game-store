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

}

$API = new API;
header('Content-Type: application/json');
echo $API->SelectUsers();
$data = $API->SelectUsers();
$file_name = 'users' . 'json';
file_put_contents($file_name, $data);
?>