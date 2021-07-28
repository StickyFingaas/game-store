<?php
require __DIR__ . '/config.php';
class API{ 
    function SelectGame(){
        $db = new Connect;
        $game = array();
        $data = $db->prepare('SELECT * from game ORDER BY id');
        $data->execute();
        while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
            $game[] = array(
                
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
        return json_encode($game, JSON_PRETTY_PRINT);
    }
}
$API = new API;
header('Content-Type: application/json');
echo $API->SelectGame();
$data = $API->SelectGame();
$file_name = 'game'.'.json';
file_put_contents($file_name, $data);