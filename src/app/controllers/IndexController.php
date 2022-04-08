<?php
//  require_once ""
require_once "../vendor/autoload.php";

use GuzzleHttp\Client;

use Phalcon\Mvc\Controller;


class IndexController extends Controller
{
    public function indexAction()
    {
        $id = "829c80e105f54dd48f1af2758c73619b";
        $secret = "ae4dd45d49304d1692d89a45a5f75dca";
        $scope = "playlist-read-collaborative playlist-modify-public playlist-read-private playlist-modify-private";
        $redirect = "http://localhost:8080/index/spotify";
        $url = "https://accounts.spotify.com/authorize?response_type=code&client_id=$id&scope=$scope&redirect_uri=$redirect";
        $this->view->url = $url;
    }


    public function spotifyAction()
    {

        $data = $_SERVER['REQUEST_URI'];
        $whatIWant = substr($data, strpos($data, "=") + 1);
        echo "<br>".$whatIWant;
        echo "<br><br><br>";
        $client_id = '829c80e105f54dd48f1af2758c73619b'; 
        $client_secret = 'ae4dd45d49304d1692d89a45a5f75dca'; 

    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    //     curl_setopt($ch, CURLOPT_POST,           1 );
    //     curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' ); 
    //     curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 

    //   $result = json_decode(curl_exec($ch), true);
    //     curl_close($ch);
    //     print_r($result);

   




        $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Content-Type: application/x-www-form-urlencoded',
  'Authorization: Basic ' . base64_encode($client_id.':'.$client_secret)
]);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' ); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = json_decode(curl_exec($ch), true);
curl_close($ch);
print_r($result);







        // print_r($_SERVER);
        // $token = $provider->getAccessToken('authorization_code', [
        //     'code' => $_GET['code']
        // ]);
        // try {
        //     $user = $provider->getResourceOwner($token);
        //     printf('Hello %s!', $user->getDisplayName());
        //     echo '<pre>';
        //     var_dump($user);
        //     echo '</pre>';
        // } catch (Exception $e) {
        //     exit('Damned...');
        // }

        // echo '<pre>';
        // var_dump($token->getToken());
        // var_dump($token->getExpires());
        // echo '</pre>';
        die;
    }




    public function authAction()
    {
        echo "inside auth";
        //ugc-image-upload user-modify-playback-state user-read-playback-state user-read-currently-playing user-follow-modify user-follow-read user-read-recently-played user-read-playback-position user-top-read playlist-read-collaborative playlist-modify-public playlist-read-private playlist-modify-private app-remote-control streaming user-read-email user-read-private user-library-modify user-library-read
        die;
    }
}
