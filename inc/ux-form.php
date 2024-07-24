<?php
require_once("../../../../wp-load.php");
require_once("lib/nusoap.php");

function objectToArray($d) {
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    }
    else {
        // Return array
        return $d;
    }
}
function check_nonce(){
    if ((isset($_POST['ux_nonce']))&& (wp_verify_nonce($_POST['ux_nonce'], 'security-checker-nonce-uxpa'))) return true;
    else return false;
}
function isValidEmail($email){ 
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function uxpa_authorize($username, $password){
	 $client = new SoapClient('https://directory.upassoc.org/VerifyMember.asmx?wsdl', true);
		$params = array(
  		  'MemberId' => $username,
     		   'Password' => $password,
     		   'AuthenticationToken' => '348372'
  		  );
		$result = $client->call('IsSigninValid', $params);
		$result_val=objectToArray($result);
		$result_val_result=$result_val[IsSigninValidResult] ;
		if(strpos($result_val_result, 'true') === 0){ return true;}  
		else{ return false;}
}
function uxpa_info($username, $password){
	 $client = new SoapClient('http://directory.upassoc.org/VerifyMember.asmx?wsdl', true);
		$params = array(
  		  'MemberId' => $username,
     		   'Password' => $password,
     		   'AuthenticationToken' => '348372'
  		  );
		 $result = $client->call('GetProfileInfo', $params);
		
		 $result_val=objectToArray($result);
		 $info=(explode("~",$result_val[GetProfileInfoResult]));
	 	 return $info;
	}
function wordpress_user($username,$password){
$info=uxpa_info($username,$password);
$firstname = $info[0];
$lastname = $info[2];
$email = $info[14];
$uxuserid = $info[16];
$unique_username = $firstname."-".$uxuserid;
if(!username_exists($unique_username)){
if ($email!=''){$user_id = wp_create_user ( $unique_username, $password, $email );}
else{$user_id = wp_create_user ( $unique_username, $password);}
$user_id = wp_create_user ( $unique_username, $password );
$user = new WP_User($user_id);
$user->set_role( 'subscriber' );
$creds = array();
$creds['user_login'] = $unique_username;
$creds['user_password'] = $password;
$creds['remember'] = true;
$loggeduser = wp_signon( $creds, false );
if ( is_wp_error($loggeduser) ){return $loggeduser->get_error_message();}
else {
$wordpress_user = get_user_by( 'login', $unique_username );
$usermeta = array(
        'ID'         => $wordpress_user->ID,
        'first_name' => $firstname,
	'last_name' =>  $lastname,
	'display_name' => $firstname,
	'show_admin_bar_front' => 'false'
        );            
$updated_user = wp_update_user( $usermeta );
exit('login success');}
}  else{
$creds = array();
$creds['user_login'] = $unique_username;
$creds['user_password'] = $password;
$creds['remember'] = true;
check_wp_password($unique_username,$password);
check_wp_email($unique_username,$username,$password);
$wordpress_user = get_user_by( 'login', $unique_username );
$usermeta = array(
	'ID' => $wordpress_user->ID,
	'show_admin_bar_front' => 'false'
        );            
$updated_user = wp_update_user( $usermeta );
$user = wp_signon( $creds, false );
if ( is_wp_error($user) )
   return $user->get_error_message();
else exit('login success');
}
}
function check_wp_password($unique_username,$password){
$wordpress_user = get_user_by( 'login', $unique_username );
$wordpress_password = $wordpress_user->password;
if ($wordpress_password != $password ){
   wp_set_password( $password, $wordpress_user->ID );
   }	 
}
function check_wp_email($unique_username,$username,$password){
$info=uxpa_info($username,$password);
$email = $info[14];
if ($email!=''){
$wordpress_user = get_user_by( 'login', $unique_username );
$wordpress_email = $wordpress_user->user_email;
if (($wordpress_email != $email) ||($wordpress_email=NULL) ){
       $args = array(
                'ID'         => $wordpress_user->id,
                'user_email' => esc_attr( $email )
            );            
        wp_update_user( $args );
   }	 
}
}
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
$username1=sanitize_text_field($_POST["username"]);
$password1=sanitize_text_field($_POST["password"]);
if(check_nonce()){
if(uxpa_authorize($username1, $password1)){
wordpress_user($username1, $password1);
}else{
if(isValidEmail($username1)){
exit ("We could not find that email / password combination. Please try again.
");
}
else{
exit ("We could not find that ID / password combination. Please try again.
");
}
}
}
else{exit ("nonce check failure");}
}
?>