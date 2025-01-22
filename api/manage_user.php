<?php
include('./login/con_db.php');
session_start();

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-color:rgb(255, 255, 255);
            color: #000;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .dashboard-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .dashboard-header h2 {
            font-size: 3vw;
            color:rgb(6, 6, 6);
        }
        .dashboard-header p {
            font-size: 16px;
            color: #777;
        }
        .search-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .search-bar input {
            width: 300px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            transition: all 0.3s ease;
        }
        .search-bar input:focus {
            border-color: #4CAF50;
        }
        .search-bar .btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }
        .search-bar .btn:hover {
            background-color: #45a049;
        }
        .btn-add-user {
            background-color:rgb(69, 217, 19);
            margin-bottom: 20px;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            transition: 0.4s;
        }
        .btn-add-user:hover {
            background:red;
        }
        .btn-add-admin {
            background-color:rgb(23, 113, 231);
            margin-bottom: 20px;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            transition: 0.4s;
        }
        .btn-add-admin:hover {
            background: yellowgreen;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .data-table th, .data-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .data-table th {
            background-color:rgb(87, 87, 87);
            color: white;
        }
        .data-table td {
            background-color:rgb(174, 172, 172);
        }
        .btn-edit, .btn-delete {
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #28a745;
            color: white;
            text-decoration: none;
        }
        .btn-edit:hover {
            background-color: #218838;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            text-decoration: none;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        .button-exit {
            text-decoration: none;
            background-color: red;
            color: white;
            border-radius: 5px;
            padding: 5px;
        }
        .button-exit:hover {
            background-color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-header">
            <h2>Admin Dashboard</h2>
        </div>
        <hr>
        <br>
        <a href="/ep3/api/admin_dashbord.php" class="btn btn-add-user">กลับไปหน้าหลัก</a>
        <a href="./add_admin.php" class="btn btn-add-admin">เพิ่ม Admin</a>

        
        <h2>รายการสินค้า</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>email</th>
                    <th>รหัสผ่าน</th>
                    <th>สิทธิ์</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody id="userTable">
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                       <td><?php echo $row['email']; ?></td> 
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td><br>
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn-edit">แก้ไข</a><br><br>
                            <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn-delete">ลบ</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
        
        

        <div class="footer">
            <p>&copy; 2025 Admin Dashboard. All Rights Reserved. <a href="#">Privacy Policy</a></p>
        </div>
    </div>

    <script>
        function searchData() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let table = document.getElementById('userTable');
            let rows = table.getElementsByTagName('tr');
            
            for (let i = 0; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    let username = cells[1].textContent.toLowerCase();
                    if (username.indexOf(input) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        }
    </script>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>