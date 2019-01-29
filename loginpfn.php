<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'loginpfn') {
        $username = $_POST['frequency'];
        $code = $_POST['password'];

        $result12 = mysql_query("SELECT * FROM users WHERE username LIKE '$username' AND life_code LIKE '$code' ") or die(mysql_error());

        $no_of_rows12 = mysql_num_rows($result12);
        if ($no_of_rows12 > 0) {


            $results['user'] = array();
            while ($row = mysql_fetch_array($result12)) {
                //$b = $row['id'] ;

                $a = "1";
                $results['user'][] = array(
                    'success' => $a,
                    'realname' => $row['realname'],
                    'id' => $row['id'],
                    'code' => $row['life_code'],
                    'bio' => $row['bio'],
                    'contrycode' => $row['contrycode'],
                    'profileImage' => $row['profileImage'],
                    'username' => $row['username'],
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
