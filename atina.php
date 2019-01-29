<?php


if (isset($_POST['cap']) && $_POST['cap'] != '') {
    // Get cap
    $cap = $_POST['cap'];

    include_once 'include/DB_Connect.php';
    $db = new DB_Connect();
    // response Array

    // check for cap type
    if ($cap == 'mind') {
        $id = $_POST['id'];
        $code = $_POST['code'];
        $input = $_POST['input'];
        $result1 = mysql_query("SELECT * FROM users WHERE id LIKE '$id' AND life_code LIKE '$code'") or die(mysql_error());
        $no_of_rows = mysql_num_rows($result1);
        if ($no_of_rows > 0) {

            $result1 = mysql_query("SELECT * FROM users WHERE id LIKE '$id' limit 1") or die(mysql_error());
            $user = mysql_fetch_array($result1);
            $action = $user['action'];
            $idnum = $user['idnum'];
            $data = $user['data'];
            switch ($action) {
                case "learn":
                    $result = mysql_query("SELECT * FROM `inout` WHERE `input` LIKE '$input' ORDER BY idno  DESC limit 1") or die(mysql_error());
                    $results["mind"] = array();
                    $no_of_rows2 = mysql_num_rows($result);

                    if ($no_of_rows2 > 0) {
                        $row = mysql_fetch_array($result);
                        if ($row['idno'] == 6) {
                            $act = $row['action'];
                            $update_action = mysql_query("UPDATE `users` SET `action` = '$act' WHERE `idnum` = '$idnum' ") or die(mysql_error());
                            $results["mind"][0] = array(
                                'output' => $row['output']
                            );
                        } else {
                            $result = mysql_query("SELECT * FROM `inout` WHERE `input` LIKE 'LEARNBEFORE' ORDER BY idno  DESC LIMIT 1") or die(mysql_error());
                            $row = mysql_fetch_array($result);
                            $act = $row['action'];
                            $update_action = mysql_query("UPDATE `users` SET `action` = '$act' WHERE `idnum` = '$idnum' ") or die(mysql_error());
                            $results["mind"][0] = array(
                                'success' => 1,
                                'output' => $row['output']
                            );
                        }

                    } else {
                        $kwds = explode(" ", $input);
                        $regexp = implode("','", $kwds);
                        $result = mysql_query("SELECT * FROM `inappropriate` WHERE `keyword` IN ('$regexp') ORDER BY id  DESC limit 1") or die(mysql_error());
                        $no_of_rows2 = mysql_num_rows($result);

                        if ($no_of_rows2 > 0) {
                            $result = mysql_query("SELECT * FROM `inout` WHERE `input` LIKE 'INAPPROPRIATE' ORDER BY idno  DESC LIMIT 1") or die(mysql_error());
                            $row = mysql_fetch_array($result);
                            $act = $row['action'];
                            $update_action = mysql_query("UPDATE `users` SET `action` = '$act' WHERE `idnum` = '$idnum' ") or die(mysql_error());
                            $results["mind"][0] = array(
                                'output' => $row['output']
                            );
                        } else {
                            $result = mysql_query("INSERT INTO `inout` (`input`, `action`) VALUES ( '$input','learn2')") or die(mysql_error());
                            $result = mysql_query("SELECT * FROM `inout` WHERE `input` LIKE '$input' ORDER BY idno  DESC limit 1") or die(mysql_error());
                            $row = mysql_fetch_array($result);
                            $postid = $row['idno'];
                            $act = $row['action'];
                            $update_action = mysql_query("UPDATE `users` SET `action` = '$act' , `data` = '$postid' WHERE `idnum` = '$idnum' ") or die(mysql_error());
                            $results["mind"][0] = array(
                                'output' => $row['output']
                            );
                        }
                    }
                    print json_encode($results);
                    break;
                case "learn2":


                    $results["mind"] = array();


                    $kwds = explode(" ", $input);
                    $regexp = implode("','", $kwds);
                    $result = mysql_query("SELECT * FROM `inappropriate` WHERE `keyword` IN ('$regexp') ORDER BY id  DESC limit 1") or die(mysql_error());
                    $no_of_rows2 = mysql_num_rows($result);

                    if ($no_of_rows2 > 0) {
                        $result = mysql_query("SELECT * FROM `inout` WHERE `input` LIKE 'INAPPROPRIATE' ORDER BY idno  DESC LIMIT 1") or die(mysql_error());
                        $row = mysql_fetch_array($result);
                        $act = $row['action'];
                        $update_action = mysql_query("UPDATE `users` SET `action` = '$act' WHERE `idnum` = '$idnum' ") or die(mysql_error());
                        $results["mind"][0] = array(
                            'output' => $row['output']
                        );
                    } else {
                        $result = mysql_query("UPDATE `inout` SET `output` = '$input' , `action` = 'outtext' WHERE `idno` = '$data'") or die(mysql_error());
                        $result = mysql_query("SELECT * FROM `inout` WHERE `idno` LIKE '$data' ORDER BY idno  DESC limit 1") or die(mysql_error());
                        $row = mysql_fetch_array($result);
                        $act = $row['action'];
                        $update_action = mysql_query("UPDATE `users` SET `action` = '$act', `data` = '' WHERE `idnum` = '$idnum' ") or die(mysql_error());
                        $result = mysql_query("SELECT * FROM `inout` WHERE `input` LIKE 'DONE' ORDER BY idno  DESC LIMIT 1") or die(mysql_error());
                        $row = mysql_fetch_array($result);
                        $results["mind"][0] = array(
                            'output' => $row['output']
                        );
                    }


                    print json_encode($results);
                    break;
                default:
                    $result = mysql_query("SELECT * FROM `inout` WHERE `input` LIKE '$input' ORDER BY idno  DESC limit 1") or die(mysql_error());
                    $results["mind"] = array();

                    $no_of_rows2 = mysql_num_rows($result);

                    if ($no_of_rows2 > 0) {
                        $row = mysql_fetch_array($result);
                        $act = $row['action'];
                        $update_action = mysql_query("UPDATE `users` SET `action` = '$act' WHERE `idnum` = '$idnum' ") or die(mysql_error());
                        $results["mind"][0] = array(
                            'output' => $row['output']
                        );

                    } else {
                        $kwds = explode(" ", $input);
                        $regexp = implode("','", $kwds);
                        $result = mysql_query("SELECT * FROM `inout` WHERE `input` IN ('$regexp') ORDER BY idno  DESC limit 1") or die(mysql_error());

                        $no_of_rows2 = mysql_num_rows($result);
                        if ($no_of_rows2 > 0) {
                            $row = mysql_fetch_array($result);
                            $act = $row['action'];
                            $update_action = mysql_query("UPDATE `users` SET `action` = '$act' WHERE `idnum` = '$idnum' ") or die(mysql_error());
                            $results["mind"][0] = array(
                                'success' => 1,
                                'output' => $row['output'],
                                'tts' => "tts"
                            );

                        } else {
                            $result = mysql_query("SELECT * FROM `inout` WHERE `input` LIKE 'DONTKNOW' ORDER BY idno  DESC LIMIT 1") or die(mysql_error());
                            $row = mysql_fetch_array($result);
                            $act = $row['action'];
                            $update_action = mysql_query("UPDATE `users` SET `action` = '$act' WHERE `idnum` = '$idnum' ") or die(mysql_error());
                            $results["mind"][0] = array(
                                'success' => 1,
                                'output' => $row['output']
                            );
                        }
                    }


                    print json_encode($results);


            }

        }
    }
}

?>