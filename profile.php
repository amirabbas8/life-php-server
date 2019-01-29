<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // Get tag
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for tag type
    if ($tag == 'getProfile') {
        $idNo = $_POST['idNo'];
        $code = $_POST['code'];
        $id = $_POST['id'];
        $isUsername = $_POST['isUsername'];
        $result = mysql_query("SELECT * FROM users WHERE id LIKE '$idNo' AND life_code LIKE '$code'") or die(mysql_error());


        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            if ($isUsername == "yes") {
                $result = mysql_query("SELECT * FROM users WHERE username LIKE '$id'") or die(mysql_error());
                $row = mysql_fetch_array($result);
                $id = $row['id'];
            }
            $result1 = mysql_query("SELECT * FROM friend WHERE user1 LIKE '$idNo' AND id LIKE '$id'") or die(mysql_error());
            $no_of_rows1 = mysql_num_rows($result1);


            $result3 = mysql_query("SELECT * FROM users WHERE id LIKE '$id'") or die(mysql_error());

            if ($no_of_rows1 > 0) {
                $results['user'] = array();
                while ($row = mysql_fetch_array($result3)) {
                    $results['user'][] = array(
                        'success' => "1",
                        'id' => $row['id'],
                        'name' => $row['realname'],
                        'bio' => $row['bio'],
                        'nPosts' => $row['nPosts'],
                        'nFollowers' => $row['nFollowers'],
                        'nFollowing' => $row['nFollowing'],
                        'profileImage' => $row['profileImage']
                    );
                }

                print json_encode($results);
            } else {
                $results['user'] = array();
                while ($row = mysql_fetch_array($result3)) {
                    $results['user'][] = array(
                        'success' => "2",
                        'id' => $row['id'],
                        'name' => $row['realname'],
                        'bio' => $row['bio'],
                        'nPosts' => $row['nPosts'],
                        'nFollowers' => $row['nFollowers'],
                        'nFollowing' => $row['nFollowing'],
                        'profileImage' => $row['profileImage']
                    );
                }

                print json_encode($results);
            }


        } else {
            $results['user'] = array();
            $results['user'][0] = array('success' => "3");
            print json_encode($results);
        }


    }
}

?>
