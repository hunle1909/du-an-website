<?php

function login($email, $matkhau)
{
    global $conn;
    $sql = "SELECT * FROM taikhoan WHERE email = '" . $email . "' AND matkhau = '" . $matkhau . "'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}
function get_id($matk)
{
    global $conn;
    $sql = 'SELECT * FROM taikhoan WHERE matk = :matk';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':matk', $matk, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}
function register($hoten, $sdt, $email, $matkhau, $diachi)
{
    global $conn;


    $sql = "INSERT INTO taikhoan (`hoten`,`sdt`,`email`,`matkhau`, `diachi`) 
                VALUES (:hoten, :sdt, :email, :matkhau, :diachi)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":hoten", $hoten);
    $stmt->bindParam(":matkhau", $matkhau);
    $stmt->bindParam(":sdt", $sdt);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":diachi", $diachi);

    return $stmt->execute();
}
function checkUser($email)
{
    global $conn;
    $sql = "SELECT * FROM taikhoan WHERE email = '" . $email . "'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}
