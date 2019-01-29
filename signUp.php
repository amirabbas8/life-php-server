<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();

    if ($tag == 'signUp') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $iid = $_POST['iid'];
        $phone = $_POST['phone'];
        $code = $_POST['code'];
        $countryCode = '98';
        $num = $countryCode . $phone;
        $result12 = mysql_query("SELECT * FROM users WHERE username = '$username'") or die(mysql_error());

        $no_of_rows12 = mysql_num_rows($result12);
        if ($no_of_rows12 > 0) {
            $results['user'] = array();
            $results['user'][0] = array('success' => "3", 'text' => 'username exist');
            print json_encode($results);
        } else {
            $time = date("Y/m/d H:i:s");
            $results1 = mysql_query("INSERT INTO users(timereg,password,contrycode,username,realname,phone,idnum,life_code ) VALUES('$time' ,'$password','$countryCode','$username','$username','$phone','$num','$code')") or die(mysql_error());

            $result3 = mysql_query("SELECT * FROM users WHERE username LIKE '$username'") or die(mysql_error());

            $results['user'] = array();
            while ($row = mysql_fetch_array($result3)) {
                $userId=$row['id'];
                $results1 = mysql_query("INSERT INTO devices(userId,iid) VALUES('$userId','$iid')") or die(mysql_error());

                $results['user'][] = array(
                    'success' => "1",
                    'name' => $row['realname'],
                    'id' => $row['id'],
                    'code' => $row['life_code'],
                    'profileImage' => $row['profileImage']
                );
            }

            print json_encode($results);

        }


    }
}
?>
