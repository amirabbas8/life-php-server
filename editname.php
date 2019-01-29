<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    if ($tag == 'editname') {
        $id = $_POST['id'];
        $name = $_POST['realname'];
        $name= str_replace("'","''",$name);
        $code = $_POST['code'];
        $bio = $_POST['bio'];
       $bio= str_replace("'","''",$bio);
        $result = mysql_query("SELECT * FROM users WHERE id LIKE '$id' AND life_code LIKE '$code'") or die(mysql_error());

        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {

            $result2 = mysql_query("UPDATE users SET realname = '$name' ,bio = '$bio' WHERE id LIKE '$id' ") or die(mysql_error());
            $result3 = mysql_query("UPDATE posts SET  name = '$name' WHERE userid LIKE '$id'") or die(mysql_error());
            $result10 = mysql_query("UPDATE wave_posts SET name = '$name' WHERE userid LIKE '$id'") or die(mysql_error());
            $resultwh = mysql_query("SELECT * FROM users WHERE id LIKE '$id'") or die(mysql_error());

            $results['user'] = array();
            while ($row = mysql_fetch_array($resultwh)) {
                $results['user'][] = array(
                    'success' => 1,
                    'realname' => $row['realname'],
                    'id' => $row['id'],
                    'code' => $row['life_code'],
                    'profileImage' => $row['profileImage']
                );
            }

            print json_encode($results);

        } else {
            $results['user'] = array();
            $results['user'][0] = array('success' => 2);


            print json_encode($results);
        }


    }
}
?>
