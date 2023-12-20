<?php

function categories($hienthi = 1)
{
    global $conn;
    $sql = "SELECT * FROM loaihang ";
    if ($hienthi == 1) {
        $sql .= " WHERE hienthi=1";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

function get_categories()
{
    global $conn;
    $sql = "SELECT * FROM loaihang";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}
function get_category($malh)
{
    global $conn;
    $sql = 'SELECT * FROM loaihang WHERE malh = :malh';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':malh', $malh, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}

function add_product($malh, $tenlh, $mota)
{
    global $conn;
    $sql = "INSERT INTO loaihang (`malh`, `tenlh`,`mota`) VALUES (:malh,:tenlh, :mota)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":malh", $malh);
    $stmt->bindParam(":tenlh", $tenhh);
    $stmt->bindParam(":mota", $mota);
    return $stmt->execute();
}


function delete_product($malh)
{
    global $conn;
    $sql = "DELETE FROM loaihang Where malh = '" . $malh . "'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}

function edit_product($tenhh, $malh, $mota)
{
    global $conn;
    $sql = "UPDATE loaihang SET `tenhh` = :tenhh, `mota` = :mota WHERE `malh` = :malh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":malh", $malh);
    $stmt->bindParam(":tenlh", $tenhh);
    $stmt->bindParam(":mota", $mota);
    return $stmt->execute();
}
