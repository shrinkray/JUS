 <form id="uxform" method="post" >
				<input type="text" name="username" id="UxId"/>
				<input type="text" name="password" id="UxPass" />
				<input type="submit" value="submit" id="uxlogin"/>
			 </form>
 
<?php
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
function uxpa_authorize($username, $password){
	  $client = new soapclient('http://directory.upassoc.org/VerifyMember.asmx?wsdl', true);
		$params = array(
  		  'MemberId' => $username,
     		   'Password' => $password,
     		   'AuthenticationToken' => '348372'
  		  );
		 $result = $client->call('IsSigninValid', $params);
		$result_val=objectToArray($result);
		//print_r($result);
		if(strpos($result_val[IsSigninValidResult], 'true') === 0){ echo "true";}  
		else{ echo "false";}
		
	
}
if ((isset($_POST["username"]))&&($_POST["username"]!='')){
$username1=$_POST["username"];
$password1=$_POST["password"];
uxpa_authorize($username1, $password1);
}
?>