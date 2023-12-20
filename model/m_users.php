<?php
 function get_users()
 {
     global $conn;
     $sql = "SELECT * FROM taikhoan";
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $stmt->setFetchMode(PDO::FETCH_ASSOC);
     return $stmt->fetchAll();
 }

 function get_user($matk)
 {
     global $conn;
     $sql = 'SELECT * FROM taikhoan WHERE matk = :matk';
     $stmt = $conn->prepare($sql);
     $stmt->bindValue(':matk', $matk, PDO::PARAM_INT);
     $stmt->execute();
     $stmt->setFetchMode(PDO::FETCH_ASSOC);
     return $stmt->fetch();
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
 
 function add_user($hoten, $matkhau, $email, $sdt, $quyen, $diachi)
 {
     global $conn;
 
     $checkEmailQuery = "SELECT COUNT(*) FROM taikhoan WHERE email = :email";
     $checkEmailStmt = $conn->prepare($checkEmailQuery);
     $checkEmailStmt->bindParam(":email", $email);
     $checkEmailStmt->execute();
 
     $emailCount = $checkEmailStmt->fetchColumn();
 
     if ($emailCount > 0) {
         return "Email đã tồn tại trong hệ thống. Vui lòng chọn email khác.";
     }
 
     $sql = "INSERT INTO taikhoan (`hoten`, `matkhau`, `email`, `sdt`, `quyen`, `diachi`) VALUES (:hoten, :matkhau, :email, :sdt, :quyen, :diachi)";
     $stmt = $conn->prepare($sql);
     $stmt->bindParam(":hoten", $hoten);
     $stmt->bindParam(":matkhau", $matkhau);
     $stmt->bindParam(":email", $email);
     $stmt->bindParam(":sdt", $sdt);
     $stmt->bindParam(":quyen", $quyen);
     $stmt->bindParam(":diachi", $diachi);
 
     return $stmt->execute();
 }
 

 function check_email($email)
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM taikhoan WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    return $stmt->fetchColumn();
}

 function delete_user($matk)
 {
     global $conn;
     $sql = "DELETE FROM taikhoan Where matk = '" . $matk . "'";
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $stmt->setFetchMode(PDO::FETCH_ASSOC);
     return $stmt->fetch();
 }

 function edit_user($matk, $hoten, $matkhau, $email, $sdt, $quyen)
{
     global $conn;
     $sql = "UPDATE taikhoan SET `hoten` = :hoten, `matkhau` = :matkhau, `email` = :email, `sdt` = :sdt, `quyen` = :quyen WHERE `matk` = :matk";
     $stmt = $conn->prepare($sql);   
     $stmt->bindParam(":matk", $matk);
     $stmt->bindParam(":hoten", $hoten);
     $stmt->bindParam(":matkhau", $matkhau);
     $stmt->bindParam(":email", $email);
     $stmt->bindParam(":sdt", $sdt);
     $stmt->bindParam(":quyen", $quyen);
     
     return $stmt->execute();
 }
 function edit_user_info($matk, $hoten, $matkhau, $email, $sdt){
    global $conn;
    $sql = "UPDATE taikhoan SET `hoten` = :hoten, `matkhau` = :matkhau, `email` = :email, `sdt` = :sdt WHERE `matk` = :matk";
    $stmt = $conn->prepare($sql);   
    $stmt->bindParam(":matk", $matk);
    $stmt->bindParam(":hoten", $hoten);
    $stmt->bindParam(":matkhau", $matkhau);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":sdt", $sdt);
    return $stmt->execute();
 }
function edit_user_address($matk, $diachi){
    global $conn;
    $sql = "UPDATE taikhoan SET `diachi` = :diachi WHERE `matk` = :matk";
    $stmt = $conn->prepare($sql);   
    $stmt->bindParam(":matk", $matk);
    $stmt->bindParam(":diachi", $diachi);
    return $stmt->execute();
}