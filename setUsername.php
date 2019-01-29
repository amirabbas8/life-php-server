<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'username') {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $code = $_POST['code'];
        $result = mysql_query("SELECT * FROM users WHERE id LIKE '$id' AND life_code LIKE '$code'") or die(mysql_error());

        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result12 = mysql_query("SELECT * FROM users WHERE username = '$username'") or die(mysql_error());

            $no_of_rows12 = mysql_num_rows($result12);
            if ($no_of_rows12 > 0) {
                $results['user'] = array();
                $results['user'][0] = array('success' => "2");
                print json_encode($results);
            } else {
                $result2 = mysql_query("UPDATE users SET  username = '$username' WHERE id LIKE '$id' ") or die(mysql_error());
                $result3 = mysql_query("SELECT * FROM users WHERE id LIKE '$id'") or die(mysql_error());

                $results['user'] = array();

                $results['user'][0] = array('success' => "1");

                print json_encode($results);

            }
        } else {
            $results['user'] = array();
            $results['user'][0] = array('success' => "404");
            print json_encode($results);
        }


    }
}
?>
