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
    //     curl_setopt($ch, CURLOPT_POST,          312wujhiq6rtj3m4kqzvvhfxyjxi 1 );
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
$this->view->result = $result;







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
      //  die;
    }




    public function authAction()
    {
        echo "inside auth";
        //ugc-image-upload user-modify-playback-state user-read-playback-state user-read-currently-playing user-follow-modify user-follow-read user-read-recently-played user-read-playback-position user-top-read playlist-read-collaborative playlist-modify-public playlist-read-private playlist-modify-private app-remote-control streaming user-read-email user-read-private user-library-modify user-library-read
        die;
    }


    public function searchAction()
    {
        print_r($_POST);

        $client_id = '829c80e105f54dd48f1af2758c73619b'; 
        $client_secret = 'ae4dd45d49304d1692d89a45a5f75dca';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token' );
        curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
        curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials' ); 
        curl_setopt($ch, CURLOPT_POST,           1 );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $json = curl_exec($ch);
        $json = json_decode($json);
        curl_close($ch);
        
        echo '<pre>'.print_r($json, true).'</pre>';
        echo $json->access_token;
        echo "-------------------------------------------------------";



        if(isset($_POST['search']))
        {
            $search = $_POST['search'];
        }
        
        if(isset($_POST['album']))
        {
            $selected_field = $_POST['album'];
            $authorization = "Authorization: Bearer " . $json->access_token;
            $spotifyURL = 'https://api.spotify.com/v1/search?q='.urlencode($search).'&type=album';

            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, $spotifyURL);
            curl_setopt($ch2,  CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization));
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
            $json2 = curl_exec($ch2);
            $json2 = json_decode($json2);
            curl_close($ch2);

            echo '<pre>'.print_r($json2, true).'</pre>';
            $this->view->album = $json2;
        }

        if(isset($_POST['artist']))
        {
            $selected_field = $_POST['artist'];
            $authorization = "Authorization: Bearer " . $json->access_token;       
            $spotifyURL = 'https://api.spotify.com/v1/search?q='.urlencode($search).'&type=artist';
            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, $spotifyURL);
            curl_setopt($ch2,  CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization));
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
            $json2 = curl_exec($ch2);
            $json2 = json_decode($json2);
            curl_close($ch2);

            echo '<pre>'.print_r($json2, true).'</pre>';
            $this->view->artist = $json2;
        }

        // if(isset($_POST['playlist']))
        // {
        //     $selected_field = $_POST['playlist'];
        // }

        if(isset($_POST['track']))
        {
            $selected_field = $_POST['track'];
            $authorization = "Authorization: Bearer " . $json->access_token;        
            $spotifyURL = 'https://api.spotify.com/v1/search?q='.urlencode($search).'&type=track';

            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, $spotifyURL);
            curl_setopt($ch2,  CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization));
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
            curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
            $json2 = curl_exec($ch2);
            $json2 = json_decode($json2);
            curl_close($ch2);

            echo '<pre>'.print_r($json2, true).'</pre>';
            $this->view->track = $json2;
        }

        // if(isset($_POST['show']))
        // {
        //     $selected_field = $_POST['show'];
        // }

        // if(isset($_POST['episode']))
        // {
        //     $selected_field = $_POST['episode'];312wujhiq6rtj3m4kqzvvhfxyjxi
        // }

        // echo $search;
        // echo $album;
        // echo $artist;
        // echo $playlist;
        // echo $track;
        // echo $show;
        // echo $episode;







       
       // die;
    }


}
