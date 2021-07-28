
<?php
require __DIR__ . '/config.php';
class API{
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
        return json_encode($review, JSON_PRETTY_PRINT);
    }
}

$API = new API;
header('Content-Type: application/json');
echo $API->SelectReview();
$data = $API->SelectReview();
$file_name = 'review' . 'json';
file_put_contents($file_name, $data);
?>