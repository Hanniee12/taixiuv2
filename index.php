<?php
// Hàm để gọi API và lấy kết quả cần thiết
function getData($md5) {
    $url = "https://sublikere.giize.com/apiv2/md5.php?key=hoangcut&mamd5=" . urlencode($md5);

    // Gọi API
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Kiểm tra nếu có lỗi
    if (isset($data['error'])) {
        return "Lỗi: " . $data['error'];
    }

    // Trả về các giá trị cần thiết
    return [
        'predict_result' => $data['predict_result'] ?? 'Không có dữ liệu',
        'tai_percent' => $data['tai_percent'] ?? 'Không có dữ liệu',
        'xiu_percent' => $data['xiu_percent'] ?? 'Không có dữ liệu'
    ];
}

// Kiểm tra nếu form được gửi
if (isset($_POST['submit'])) {
    $md5 = $_POST['md5'];

    // Gọi hàm lấy dữ liệu
    $result = getData($md5);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gọi API MD5</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
        }
        .container {
            text-align: center;
            width: 80%;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-container input {
            padding: 10px;
            width: 100%;
            font-size: 16px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
        .result-box {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }
        .result-box p {
            font-size: 18px;
        }
        .close-btn {
            background-color: #f44336;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .close-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Nhập mã MD5 để lấy dữ liệu</h1>

    <!-- Form nhập MD5 -->
    <form method="POST">
        <div class="form-container">
            <input type="text" name="md5" placeholder="Nhập mã MD5" required>
            <button type="submit" name="submit">Lấy dữ liệu</button>
        </div>
    </form>
</div>

<?php if (isset($result)): ?>
    <!-- Hiển thị kết quả trong bảng thông báo -->
    <div class="result-box" id="resultBox">
        <p><strong>Dự đoán:</strong> <?php echo htmlspecialchars($result['predict_result']); ?></p>
        <p><strong>Tài:</strong> <?php echo htmlspecialchars($result['tai_percent']); ?>%</p>
        <p><strong>Xỉu:</strong> <?php echo htmlspecialchars($result['xiu_percent']); ?>%</p>
        <button class="close-btn" onclick="closeResultBox()">Đóng</button>
    </div>

    <script>
        // Hiển thị bảng kết quả
        document.getElementById('resultBox').style.display = 'block';

        // Hàm đóng bảng kết quả
        function closeResultBox() {
            document.getElementById('resultBox').style.display = 'none';
        }
    </script>
<?php endif; ?>

</body>
</html>
