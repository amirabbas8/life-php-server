<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'selectpfn') {
        $name = $_POST['realname'];
        $username = $_POST['frequency'];
        $code = $_POST['password'];
        $countryCode = $_POST['countrycode'];
        $result12 = mysql_query("SELECT * FROM users WHERE username = '$username'") or die(mysql_error());

        $no_of_rows12 = mysql_num_rows($result12);
        if ($no_of_rows12 > 0) {
            $results['user'] = array();
            $results['user'][0] = array('success' => "3");
            print json_encode($results);
        } else {
            $tzaman = date("Y/m/d H:i:s");
            $results1 = mysql_query("INSERT INTO users(timereg,life_code,contrycode,realname,username ) VALUES('$tzaman' ,'$code','$countryCode','$name','$username')") or die(mysql_error());

            $result3 = mysql_query("SELECT * FROM users WHERE username LIKE '$username'") or die(mysql_error());

            $results['user'] = array();
            while ($row = mysql_fetch_array($result3)) {
                $results['user'][] = array(
                    'success' => "1",
                    'realname' => $row['realname'],
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
