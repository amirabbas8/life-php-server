<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'login') {
        $username = $_POST['username'];
        $lowUsername = strtolower($username);
        $password = $_POST['password'];
        $iid = $_POST['iid'];

        $result12 = mysql_query("SELECT * FROM users WHERE username LIKE '$lowUsername' AND password LIKE '$password' ") or die(mysql_error());

        $no_of_rows12 = mysql_num_rows($result12);
        if ($no_of_rows12 > 0) {


            $results['user'] = array();
            while ($row = mysql_fetch_array($result12)) {
                $userId=$row['id'];
                $result1 = mysql_query("INSERT INTO devices(userId,iid) VALUES('$userId','$iid')") or die(mysql_error());


                $results['user'][] = array(
                    'success' => "1",
                    'name' => $row['realname'],
                    'id' => $row['id'],
                    'code' => $row['life_code'],
                    'profileImage' => $row['profileImage'],
                    'username' => $row['username']
                );
            }

            print json_encode($results);
        } else {
            $results['user'] = array();
            $results['user'][0] = array('success' => "3");

            print json_encode($results);

        }


    }
}
?>
