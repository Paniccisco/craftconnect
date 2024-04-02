<?php
function getUserById($id, $db)
{
    $sqlSeller = "SELECT * FROM sellers WHERE seller_id = ?";

    $stmtSeller = $db->prepare($sqlSeller);

    $stmtSeller->execute([$id]);

    $seller = $stmtSeller->fetch();

    if ($seller) {
        return $seller;
    } else {
        return null;
    }
}
