<h2> Tài Khoản </h2>
<a href="?mod=user&act=add">Thêm tài khoản</a>

<table>
    <thead>
        <tr>
            <th>ID Tài Khoản</th>
            <th>Tên</th>
            <th>Mật Khảu</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Địa chỉ</th>
            <th>Quyền</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $users = get_users();
        foreach ($users as $user) {
            $role = ($user['quyen'] == 1) ? 'Admin' : 'Người dùng';

            echo '
    <tr>
        <td>
           <p> ' . $user['matk'] . ' </p>
        </td>
        <td>
            <p> ' . $user['hoten'] . ' </p>
        </td>
        <td>
            <p> ' . $user['matkhau'] . ' </p>
        </td>
        <td>
           <p> ' . $user['email'] . ' </p>
        </td>
        <td>
           <p> ' . $user['sdt'] . ' </p>
        </td>
        <td>
        <p> ' . $user['diachi'] . ' </p>
     </td>
        <td>
        <p> ' . $role . ' </p>
        </td>
      
        <td>
            <form method="POST">
                <input type="hidden" name="matk" value="' . $user['matk'] . '">
                <a href="admin.php?mod=user&act=edit&matk=' . $user['matk'] . '">Sửa</a>
                <input type="submit" value="Xóa" name="delete" onclick="return confirmDelete();">
            </form>
        </td>
    </tr>
    ';
        }
        ?>
    </tbody>
</table>
<script>
    function confirmDelete() {
        var result = confirm("Bạn có chắc chắn muốn xóa tài khoản này?");
        return result;
    }
</script>
<style>
    table {
        width: 90%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {

        padding: 5px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    form {
        display: inline-block;
    }

    a {
        text-decoration: none;
    }
</style>