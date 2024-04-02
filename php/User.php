<?php
function getUserById($id, $db)
{
    $sqlUser = "SELECT * FROM users WHERE user_id = ?";

    $stmtUser = $db->prepare($sqlUser);

    $stmtUser->execute([$id]);

    $user = $stmtUser->fetch();

    if ($user) {
        return $user;
    } else {
        return null;
    }
}
