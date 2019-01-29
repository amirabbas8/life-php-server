<?php


if (isset($_POST['tag']) && $_POST['tag'] != '') {
    $tag = $_POST['tag'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    if ($tag == 'update') {
        $id = $_POST['id'];
        $code = $_POST['code'];
        $result = mysql_query("SELECT * FROM users WHERE id LIKE '$id' AND life_code LIKE '$code' ") or die(mysql_error());

        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $results['user'] = array();
            while ($row = mysql_fetch_array($result)) {

                $results['user'][] = array(
                    'success' => 1,
                    'pass' => ($row['password']==""),
                    'username' => $row['username'],
                    'phone' => $row['phone']
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
