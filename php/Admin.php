<?php
function getUserById($id, $db)
{
    $sqlAdmin = "SELECT * FROM users WHERE user_id = ? AND role = 'admin'";

    $stmtAdmin = $db->prepare($sqlAdmin);

    $stmtAdmin->execute([$id]);

    $admin = $stmtAdmin->fetch();

    if ($admin) {
        return $admin;
    } else {
        return null;
    }
}
