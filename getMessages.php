<?php

include ('db_connect.php');

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fr_id = $_POST['friend_id'];
    $msg_time = date("h:i:s");
    $msg_date = date("y:m:d");
    if (isset ($_POST['msg_text'])) {
        $msg_text = $_POST['msg_text'];
        $stmt = $connect->prepare("INSERT INTO user_message VALUES (NULL, $user_id, $fr_id, ? ,'$msg_date', '$msg_time')");
        $stmt->bind_param("s", $msg_text);
        $stmt->execute();
    }

    $q = "SELECT msg_text, sender_id, msg_time FROM user_message 
        WHERE sender_id IN ($user_id , $fr_id) 
        AND receiver_id IN ($user_id , $fr_id);";

    $r = mysqli_query($connect, $q);
    while ($row = $r->fetch_assoc()) {
        ($row['sender_id'] == $user_id) ? $cls = "my-msg" : $cls = "other-msg";

        echo '<div class="msg d-flex ' . $cls . '">';
        echo '<p>' . $row['msg_text'] . '</p>';
        echo '<span class="align-self-end">' . $row['msg_time'] . '</span>';
        echo '</div>';

    }
}
