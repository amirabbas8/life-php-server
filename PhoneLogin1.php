<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    $tag = ($_POST['tag']);
    if ($tag == 'phoneLogin') {
        $countryCode = $_POST['countryCode'];
        $phone = $_POST['phone'];
        $code =$_POST['sms'];
        $countryCode = str_replace("+", "", $countryCode);

        $strText = $code;
        $strText .= ",30004746575666,";
        $strText .= $phone;
        $id = $countryCode;
        $id .= $phone;


        $result = mysql_query("SELECT * FROM users WHERE idnum LIKE '$id' ") or die(mysql_error());

        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_query("UPDATE users SET life_code = '$code' WHERE idnum LIKE '$id' ") or die(mysql_error());


            ini_set("soap.wsdl_cache_enabled", "0");
            $sms_client = new SoapClient('http://api.payamak-panel.com/post/receive.asmx?wsdl', array('encoding' => 'UTF-8'));
            $parameters['username'] = "9386077067";
            $parameters['password'] = "322bi55P@";
            $parameters['location'] = 1;
            $parameters['from'] = "30004746575666";
            $parameters['index'] = 0;
            $parameters['count'] = 0;
            $text = $sms_client->GetMessageStr($parameters)->GetMessageStrResult;

            if (stripos($text, $strText) != false) {

                $result = mysql_query("SELECT * FROM users WHERE idnum LIKE '$id' AND life_code LIKE '$code'") or die(mysql_error());
                $results['user'] = array();
                while ($row = mysql_fetch_array($result)) {

                    $results['user'][] = array(
                        'success' => "1",
                        'id' => $row['id'],
                        'code' => $row['life_code'],
                        'name' => $row['realname'],
                        'profileImage' => $row['profileImage']);
                }

                print json_encode($results);


            } else {
                $results['user'] = array();
                $results['user'][0] = array('success' => "2");
                print json_encode($results);
            }

        } else {
            if(strlen($phone)==10){
                $date=date("Y/m/d h:i:sa");
                $result = mysql_query("INSERT INTO users(idnum,timereg,life_code,contrycode,phone ) VALUES('$id' ,'$date' ,'$code','$countryCode','$phone')") or die(mysql_error());


                $result = mysql_query("SELECT * FROM users WHERE idnum LIKE '$id'AND life_code LIKE '$code' ") or die(mysql_error());


//                ini_set("soap.wsdl_cache_enabled", "0");
//                $sms_client = new SoapClient('http://api.payamak-panel.com/post/receive.asmx?wsdl', array('encoding' => 'UTF-8'));
//                $parameters['username'] = "9386077067";
//                $parameters['password'] = "322bi55P@";
//                $parameters['location'] = 1;
//                $parameters['from'] = "30004746575666";
//                $parameters['index'] = 0;
//                $parameters['count'] = 0;
//                $text = $sms_client->GetMessageStr($parameters)->GetMessageStrResult;
//stripos($text, $strText) != false
                if (true) {

                    $result = mysql_query("SELECT * FROM users WHERE idnum LIKE '$id'AND life_code LIKE '$code' ") or die(mysql_error());
                    $results['user'] = array();
                    while ($row = mysql_fetch_array($result)) {

                        $results['user'][] = array(
                            'success' => "1",
                            'name' => $row['realname'],
                            'id' => $row['id'],
                            'code' => $row['life_code'],
                            'profileImage' => $row['profileImage']);
                    }

                    print json_encode($results);


                } else {
                    $results['user'] = array();
                    $results['user'][0] = array('success' => "2");
                    print json_encode($results);
                }
            } else {
                $results['user'] = array();
                $results['user'][0] = array('success' => "2");
                print json_encode($results);
            }


        }

    }
}

?>
