<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'phoneLogin') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $name= str_replace("'","''",$name);
        $username = $_POST['username'];
        $username= str_replace("'","''",$username);
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
                $result2 = mysql_query("UPDATE users SET realname = '$name' , username = '$username' WHERE id LIKE '$id' ") or die(mysql_error());
                $result3 = mysql_query("SELECT * FROM users WHERE id LIKE '$id'") or die(mysql_error());

                $results['user'] = array();
                while ($row = mysql_fetch_array($result3)) {
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
        } else {
            $results['user'] = array();
            $results['user'][0] = array('success' => "404");
            print json_encode($results);
        }


    }
}
?>
