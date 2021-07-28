
<?php
require __DIR__ . '/config.php';
class API{
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
        return json_encode($purchase, JSON_PRETTY_PRINT);
    }
}

$API = new API;
header('Content-Type: application/json');
echo $API->SelectPurchase();
$data = $API->SelectPurchase();
$file_name = 'purchase' . 'json';
file_put_contents($file_name, $data);
?>
