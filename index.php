<?php
# ==Server Configuration Section==
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$keys_use_state=true;
# ==Section End==

# ==Server Variables==
$datadir = "data";
$action = $_GET["action"];
$key = $_GET["key"];
$user = $_GET["tag"];
$value = $_GET["value"];
$access = $_GET["auth"];
$time = $_SERVER["REQUEST_TIME"];
# ==Section End==

# ==Server Main Functions==
if(!is_dir($datadir)){mkdir($datadir);}
if($user){
  if(!is_dir("$datadir/$user")){mkdir("$datadir/$user");}
  $datadir="$datadir/$user";
}
function response($status,$result,$_time_,$auth){
  if($auth){
    $string = array(
      "status"=>$status,
      "result"=>$result,
      "time"=>$_time_,
      "auth"=>$auth
    );
  } else{
    $string = array(
      "status"=>$status,
      "result"=>$result,
      "time"=>$_time_
    );
  }
  $string = json_encode($string, 128);
  return str_replace("  ", " ", $string);
}
function RandomString($lnth=10){
  $characters = '0123456789abcdefABCDEF';
  $randstring = '';
  for ($i = 0; $i < $lnth; $i++) {
    $randstring .= $characters[rand(0, strlen($characters))];
  }
  return $randstring;
}
function filetokey($file){
  return explode(".",$file)[0];
}
# ==Section End==

# ==Server Actions==
if($action=="new" && $value){
  $_key_=RandomString();
  $auth=RandomString();
  $content=json_encode(array(
    "content"=>$value,
    "time"=>$time,
    "auth"=>$auth
  ), 128);
  file_put_contents("$datadir/$_key_.json",$content);
  echo response("ok",$_key_,$time,$auth);
}
if($action=="get" && is_file("$datadir/$key.json")){
  $content = json_decode(file_get_contents("$datadir/$key.json"));
  echo response("ok",($content->content),($content->time),false);
}
if($action=="keys" && $keys_use_state){
  $files=scandir("$datadir");
  $keys=array();
  foreach ($files as $file){
    array_push($keys,filetokey($file));
  }
  echo response("ok",$keys,$time,false);
}
if($action=="edit" && is_file("$datadir/$key.json") && $value && $access){
  $old=json_decode(file_get_contents("$datadir/$key.json"));
  if($old->auth==$access){
    $content=json_encode(array(
      "content"=>$value,
      "time"=>$time,
      "auth"=>$access
    ));
    file_put_contents("$datadir/$key.json",$content);
    echo response("ok","success",$time,$auth);
  } else{
    echo response("error","authentication key is not correct",$time,false);
  }
}
if($action=="del" && is_file("$datadir/$key.json") && $access){
  $old=json_decode(file_get_contents("$datadir/$key.json"));
  if($old->auth==$access){
    unlink("$datadir/$key.json");
    echo response("ok","success",$time,$auth);
  } else{
    echo response("error","authentication key is not correct",$time,false);
  }
}
# ==Section End==
