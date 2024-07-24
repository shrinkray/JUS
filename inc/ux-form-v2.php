<?php
require_once("../../../../wp-load.php");
function isValidEmail($email){ 
return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function check_ux_id(){
    if (isset($_POST['username'])){
        if (preg_match("/^[0-9]{1,6}$/",$_POST['username'])) return true;
        else return false;    
        }
}
function check_nonce(){
    if ((isset($_POST['ux_nonce']))&& (wp_verify_nonce($_POST['ux_nonce'], 'security-checker-nonce-uxpa'))) return true;
    else return false;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
if (check_nonce()){
$username =  $_POST["username"];
$password =  $_POST["password"];
$nonce = $_POST["password"];
$curl = curl_init();
if(isValidEmail($username)){
$url = "https://uxpa.org/uxpa/member-status?mail=".$username."&password=".$password;
}
else if (check_ux_id($username)){
$url = "https://uxpa.org/uxpa/member-status?ind_id=".$username."&password=".$password;
}
else{
$url = "https://uxpa.org/uxpa/member-status?name=".$username."&password=".$password;
}
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
curl_setopt($curl, CURLOPT_USERPWD, 'apitest:test');
curl_setopt($curl, CURLOPT_URL, $url);
$info = curl_exec($curl);
$data = json_decode($info, TRUE);
if (is_array($data)){
if($data[valid_password]){
$_SESSION['ux_legit']='1';
exit('login success');
}else {

}
}else{
if(isValidEmail($username)){
exit ("We could not find that email / password combination. Please try again.");
}
else if (check_ux_id($username)){
    exit ("We could not find that id / password combination. Please try again.");
}
else {
    exit ("We could not find that that name and password combination. Please try again.");
}


}// end login error
}
else{
    exit ('Nonce check fail');
}
}else{
    exit ('Not a post request.');
}
?>