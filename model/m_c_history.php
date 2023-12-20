<?php

function history_hasCart($matk)
{
    global $conn;
    $sql = 'SELECT * FROM c_history WHERE matk = :matk AND trangthai = :trangthai';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':matk', $matk, PDO::PARAM_INT);
    $stmt->bindValue(':trangthai', 'gio-hang', PDO::PARAM_STR);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}

function history_add($matk)
{
    global $conn;
    $sql = "INSERT INTO c_history (`matk`, `trangthai`) VALUES (:matk, 'gio-hang')";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":matk", $matk, PDO::PARAM_INT);
    return $stmt->execute();
}

function history_addtoCart($mals, $mahh, $soluong)
{
    global $conn;
    $sql = "INSERT INTO chitietlichsu (`mals`, `mahh`, `soluong`) VALUES (:mals,:mahh,:soluong)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":mals", $mals, PDO::PARAM_INT);
    $stmt->bindParam(":mahh", $mahh, PDO::PARAM_INT);
    $stmt->bindParam(":soluong", $soluong, PDO::PARAM_INT);
    return $stmt->execute();
}
function history_getCart($matk)
{
    global $conn;
    $sql = 'SELECT ct.mals, ct.mahh, ct.soluong, h.tenhh, h.giakm, h.img
    FROM c_history hs
    INNER JOIN chitietlichsu ct ON hs.mals = ct.mals
    INNER JOIN hanghoa h ON ct.mahh = h.mahh
    WHERE hs.matk = :matk AND hs.trangthai = :trangthai';
    //
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':matk', $matk, PDO::PARAM_INT);
    $stmt->bindValue(':trangthai', 'gio-hang', PDO::PARAM_STR);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

function history_removeCart($mals, $mahh)
{
    global $conn;
    $sql = "DELETE FROM chitietlichsu WHERE mals = :mals AND mahh = :mahh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':mals', $mals, PDO::PARAM_INT);
    $stmt->bindParam(':mahh', $mahh, PDO::PARAM_INT);
    return $stmt->execute();
}

function history_removeAllCart($mals)
{
    global $conn;
    $sql = "DELETE FROM chitietlichsu WHERE mals = :mals";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':mals', $mals, PDO::PARAM_INT);
    return $stmt->execute();
}
function history_updateCart($mals, $tongtien, $soluong, $trangthai)
{
    global $conn;
    $sql = "UPDATE c_history SET tongtien = :tongtien, soluong = :soluong, trangthai = :trangthai WHERE mals = :mals";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':mals', $mals, PDO::PARAM_INT);
    $stmt->bindParam(':tongtien', $tongtien);
    $stmt->bindParam(':trangthai', $trangthai, PDO::PARAM_STR);
    $stmt->bindParam(':soluong', $soluong, PDO::PARAM_INT);
    return $stmt->execute();
}

function history_getAll($matk)
{
    global $conn;
    $sql = 'SELECT c_history.*, hanghoa.tenhh 
            FROM c_history 
            INNER JOIN chitietlichsu ON c_history.mals = chitietlichsu.mals
            INNER JOIN hanghoa ON chitietlichsu.mahh = hanghoa.mahh
            WHERE c_history.matk = :matk
            AND c_history.trangthai IN (:chuanbi, :chogiao, :dagiao)';
            
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':matk', $matk, PDO::PARAM_INT);
    $stmt->bindValue(':chuanbi', 'chuan-bi', PDO::PARAM_STR);
    $stmt->bindValue(':chogiao', 'cho-giao', PDO::PARAM_STR);
    $stmt->bindValue(':dagiao', 'da-giao', PDO::PARAM_STR);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}
