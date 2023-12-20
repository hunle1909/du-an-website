<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bảng điều khiển</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
</head>

<body>
    <header>
        <h1>Bảng điều khiển</h1>
        <p id="currentDateTime">Thứ hai, 13/11/2023 - 19 giờ 49 phút 58 giây</p>
    </header>
    <main>
        <div class="contai-tongquan">
            <section class="tong-quan">
                <h2>Tổng quan</h2>
                <ul>
                    <li><i class="fa-solid fa-user-tie"></i>Tổng khách hàng: <span><?php echo $totalCustomers; ?></span></li>
                    <li><i class="fa-solid fa-mug-hot"></i>Tổng sản phẩm: <span><?php echo $totalProducts; ?></span></li>
                    <li><i class="fa-solid fa-chart-simple"></i>Tổng đơn hàng: <span><?php echo $totalOrders; ?></span></li>
                </ul>
            </section>
            <section class="tong-quan">
                <h2>Tổng quan</h2>
                <ul>
                    <li><i class="fa-solid fa-user-tie"></i>Tổng khách hàng: <span><?php echo $totalCustomers; ?></span></li>
                    <li><i class="fa-solid fa-mug-hot"></i>Tổng sản phẩm: <span><?php echo $totalProducts; ?></span></li>
                    <li><i class="fa-solid fa-chart-simple"></i>Tổng đơn hàng: <span><?php echo $totalOrders; ?></span></li>
                </ul>
            </section>
            <section class="tong-quan">
                <h2>Tổng quan</h2>
                <ul>
                    <li><i class="fa-solid fa-user-tie"></i>Tổng khách hàng: <span><?php echo $totalCustomers; ?></span></li>
                    <li><i class="fa-solid fa-mug-hot"></i>Tổng sản phẩm: <span><?php echo $totalProducts; ?></span></li>
                    <li><i class="fa-solid fa-chart-simple"></i>Tổng đơn hàng: <span><?php echo $totalOrders; ?></span></li>
                </ul>
            </section>
            <section class="tong-quan">
                <h2>Tổng quan</h2>
                <ul>
                    <li><i class="fa-solid fa-user-tie"></i>Tổng khách hàng: <span><?php echo $totalCustomers; ?></span></li>
                    <li><i class="fa-solid fa-mug-hot"></i>Tổng sản phẩm: <span><?php echo $totalProducts; ?></span></li>
                    <li><i class="fa-solid fa-chart-simple"></i>Tổng đơn hàng: <span><?php echo $totalOrders; ?></span></li>
                </ul>
            </section>
        </div>
        <section class="tình-trạng-đơn-hàng">
            <h2>Tình trạng đơn hàng</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AK3947</td>
                        <td>Lý Gia Bảo</td>
                        <td>99.500.000 đ</td>
                        <td>Chờ xử lý</td>
                    </tr>
                    <tr>
                        <td>AK3947</td>
                        <td>Lý Gia Bảo</td>
                        <td>99.500.000 đ</td>
                        <td>Đang vận chuyển</td>
                    </tr>
                    <tr>
                        <td>AK3947</td>
                        <td>Lý Gia Bảo</td>
                        <td>99.500.000 đ</td>
                        <td>Đã hủy</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
    }

    .contai-tongquan {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .tong-quan {
        border: 1px solid #ccc;
        padding: 10px;
    }

    .tong-quan li i {
        margin-right: 10px;
    }

    header {
        background-color: #4CAF50;
        color: #fff;
        padding: 20px;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        background-image: linear-gradient(to right, #4CAF50 0%, #388E3C 100%);
    }

    h1 {
        margin: 0;
    }

    p {
        margin: 5px 0 0;
    }

    main {
        padding: 20px;
    }

    section {
        margin-top: 20px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }





    .tình-trạng-đơn-hàng {
        background-color: #e5e5e5;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        margin: 10px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #4CAF50;
        color: #fff;
    }
</style>

<script>
    function updateDateTime() {
        const currentDate = new Date();

        const daysOfWeek = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];
        const dayOfWeek = daysOfWeek[currentDate.getDay()];

        const day = currentDate.getDate();
        const month = currentDate.getMonth() + 1;
        const year = currentDate.getFullYear();

        const hours = currentDate.getHours();
        const minutes = currentDate.getMinutes();
        const seconds = currentDate.getSeconds();

        const formattedDateTime = `${dayOfWeek}, ${day}/${month}/${year} - ${hours} giờ ${minutes} phút ${seconds} giây`;

        document.getElementById('currentDateTime').textContent = formattedDateTime;
    }

    updateDateTime();

    setInterval(updateDateTime, 1000);
</script>

</body>

</html>