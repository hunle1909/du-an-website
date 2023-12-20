<?php

function get_product_categories($idlh = 0)
{
    global $conn;
    $sql = "SELECT * FROM hanghoa h INNER JOIN loaihang l ON h.malh = l.malh";
    if ($idlh != 0) {
        $sql .= " WHERE h.malh=" . $idlh;
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

function get_product()
{
    global $conn;
    $sql = "SELECT * FROM hanghoa";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}
function get_prd($mahh)
{
    global $conn;
    $sql = 'SELECT * FROM hanghoa WHERE mahh = :mahh';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':mahh', $mahh, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}
function get_product_limit()
{
    global $conn;
    $sql = 'SELECT hh.mahh, hh.tenhh, hh.giaban, hh.giakm, hh.img,   hh.mota, SUM(hdc.SoLuong) AS TongSoLuong, SUM(hdc.TongTien) AS TongTien
    FROM hanghoa hh
    JOIN hoadonchitiet hdc ON hh.mahh = hdc.MaHH
    GROUP BY hh.mahh
    ORDER BY SUM(hdc.SoLuong) DESC, SUM(hdc.TongTien) DESC
    LIMIT 2';

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();
}
function add_product($tenhh, $giaban, $giakm, $img, $mota)
{
    global $conn;
    $sql = "INSERT INTO hanghoa (`tenhh`, `giaban`, `giakm`, `img`, `mota`) VALUES (:tenhh, :giaban, :giakm, :img, :mota)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":tenhh", $tenhh);
    $stmt->bindParam(":giaban", $giaban);
    $stmt->bindParam(":giakm", $giakm);
    $stmt->bindParam(":img", $img);
    $stmt->bindParam(":mota", $mota);
    return $stmt->execute();
}


function delete_product($mahh)
{
    global $conn;
    $sql = "DELETE FROM hanghoa Where mahh = '" . $mahh . "'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}

function edit_product($mahh, $tenhh, $giaban, $giakm, $img, $mota)
{
    global $conn;
    $sql = "UPDATE hanghoa SET `tenhh` = :tenhh, `giaban` = :giaban, `giakm` = :giakm, `img` = :img, `mota` = :mota WHERE `mahh` = :mahh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":mahh", $mahh);
    $stmt->bindParam(":tenhh", $tenhh);
    $stmt->bindParam(":giaban", $giaban);
    $stmt->bindParam(":giakm", $giakm);
    $stmt->bindParam(":img", $img);
    $stmt->bindParam(":mota", $mota);

    return $stmt->execute();
}

function search_products($keyword)
{
    global $conn;
    $sql = "SELECT * FROM hanghoa WHERE `tenhh` LIKE '%" . $keyword . "%'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}
function getOrder()
{
    global $conn;
    $sql = "SELECT c_history.mals, taikhoan.hoten AS tenkh, hanghoa.tenhh, hanghoa.img, taikhoan.sdt, taikhoan.diachi, c_history.tongtien, c_history.soluong, c_history.trangthai
            FROM c_history
            INNER JOIN chitietlichsu ON c_history.mals = chitietlichsu.mals
            INNER JOIN hanghoa ON chitietlichsu.mahh = hanghoa.mahh
            INNER JOIN taikhoan ON c_history.matk = taikhoan.matk
            WHERE c_history.trangthai IN ('chuan-bi', 'cho-giao', 'da-giao')";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}


function changeStatus($mals)
{
    global $conn;
    $sql = "UPDATE c_history SET trangthai = 'cho-giao' WHERE `mals` = :mals";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":mals", $mals);
    return $stmt->execute();
}

function changeStatusToDelivered($mals)
{
    global $conn;
    $sql = "UPDATE c_history SET trangthai = 'da-giao' WHERE `mals` = :mals";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":mals", $mals);
    return $stmt->execute();
}
function createInvoice($mals)
{
    global $conn;

    $sql = "SELECT ch.*, tk.hoten, tk.diachi 
            FROM c_history ch
            INNER JOIN taikhoan tk ON ch.matk = tk.matk
            WHERE ch.mals = :mals";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":mals", $mals);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        $sql = "INSERT INTO hoadon (`tenkh`, `ngaydathang`, `diachi`, `thanhtien`, `trangthai`) 
                VALUES (:tenkh, NOW(), :diachi, :thanhtien, 'da-giao')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":tenkh", $order['hoten']);
        $stmt->bindParam(":diachi", $order['diachi']);
        $stmt->bindParam(":thanhtien", $order['tongtien']);
        $stmt->execute();

        $mahd = $conn->lastInsertId();

        $sql = "INSERT INTO hoadonchitiet (`SoLuong`, `TongTien`, `MaHH`, `MaHD`) 
                SELECT clhs.soluong, hoadon.thanhtien * clhs.soluong AS TongTien, hh.mahh, :mahd 
                FROM chitietlichsu clhs
                INNER JOIN hanghoa hh ON clhs.mahh = hh.mahh
                INNER JOIN hoadon ON hoadon.maHD = :mahd
                WHERE clhs.mals = :mals";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":mahd", $mahd);
        $stmt->bindParam(":mals", $mals);
        $stmt->execute();
    } else {
    }
}

// Tính tổng khách hàng
function getTotalCustomers()
{
    global $conn;
    $sql = "SELECT COUNT(*) as totalCustomers FROM taikhoan";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['totalCustomers'];
}

// Tính tổng sản phẩm
function getTotalProducts()
{
    global $conn;
    $sql = "SELECT COUNT(DISTINCT mahh) as totalProducts FROM hanghoa";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['totalProducts'];
}

// Tính tổng đơn hàng
function getTotalOrders()
{
    global $conn;
    $sql = "SELECT COUNT(*) as totalOrders FROM hoadon";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['totalOrders'];
}

function count_products()
{
    global $conn;
    $sql = "SELECT count(*) AS soluong FROM hanghoa";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}
function invoice($mahd)
{
    global $conn;
    $sql = "SELECT hoadon.mahd, hoadon.tenkh, hoadon.ngaydathang, hoadon.diachi, hoadon.thanhtien,
                   hoadon.trangthai, chitietlichsu.mals, hanghoa.tenhh, hoadonchitiet.SoLuong, hoadonchitiet.TongTien
            FROM hoadon
            JOIN hoadonchitiet ON hoadon.mahd = hoadonchitiet.MaHD
            JOIN hanghoa ON hoadonchitiet.MaHH = hanghoa.mahh
            JOIN chitietlichsu ON hoadon.mahd = chitietlichsu.mals
            WHERE hoadon.mahd = :mahd";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':mahd', $mahd, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch();
}
