<?php

function getData($md5) {
    $url = "https://sublikere.giize.com/apiv2/md5.php?key=hoangcut&mamd5=" . urlencode($md5);


    $response = file_get_contents($url);
    $data = json_decode($response, true);


    if (isset($data['error'])) {
        return "Lỗi: " . $data['error'];
    }

  
    return [
        'predict_result' => $data['predict_result'] ?? 'Không có dữ liệu',
        'tai_percent' => $data['tai_percent'] ?? 'Không có dữ liệu',
        'xiu_percent' => $data['xiu_percent'] ?? 'Không có dữ liệu'
    ];
}


if (isset($_POST['submit'])) {
    $md5 = $_POST['md5'];


    $result = getData($md5);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool Tài Xỉu</title>
    <link rel="icon" href="./OIP.jpg">
    <meta name="description" content="A bad boy who is half-hearted and uneducated all day long, dreams of becoming a scholar in the fields">
    <meta name="keywords" content="ANIME_AI">
    <meta name="author" content="ANIME_AI">
    <meta name="robots" content="index, follow">
    <meta property="og:locale" content="vi-VN">
    <meta name="og:image" content="./OIP.jpg">
    <meta name="og:url" content="https://hanniee12.github.io/Tai11D7/">
    <meta name="og:description" content="A bad boy who is half-hearted and uneducated all day long, dreams of becoming a scholar in the fields">
    <meta name="og:site_name" content="ANIME_AI">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <style>
        body {
        background-image: url(./OIP.jpg);
        background-size: cover;
        background-repeat: no-repeat; /* ✅ Ngăn lặp ảnh */
        background-position: center; /* ✅ Canh giữa ảnh */
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        min-height: 100vh; /* ✅ Đảm bảo chiều cao luôn đủ */
    }


        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            background-color: #00bcd4; 
            padding: 30px;
            width: 400px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #a30000;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        input[type="text"] {
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            color: #ff0000;
        }
        .modal {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex; /* Đảm bảo nó hiển thị */
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        .modal-content h2 {
            margin-top: 0;
        }
        .close-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .close-btn:hover {
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
        @media (max-width: 600px) {
            .container {
                background-size: cover;
                flex-direction: column;
                width: 90%;
                padding: 20px;
            }

            input[type="text"] {
                width: 100%;
            }

            button {
                width: 100%;
            }

            .result-box {
                width: 90%;
            }
        }
        .fancy-title {
            font-size: 1.5rem;
            text-align: center;
            padding: 20px;
            background: linear-gradient(90deg, #ff416c, #ff4b2b, #ff416c);
            background-size: 200% auto;
            color: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            animation: shine 3s ease-in-out infinite;
            font-weight: bold;
            letter-spacing: 2px;
        }

        @keyframes shine {
            0% {
                background-position: 0% center;
            }
            50% {
                background-position: 100% center;
            }
            100% {
                background-position: 0% center;
            }
        }
        .fancy-footer {
            background: linear-gradient(90deg, #1f1c2c, #928dab);
            color: #fff;
            padding: 20px 10px;
            text-align: center;
            font-size: 1rem;
            font-family: 'Segoe UI', sans-serif;
            box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 10;
        }

        .fancy-footer p {
            margin: 0;
            letter-spacing: 1px;
            font-weight: 500;
        }

        .highlight {
            font-weight: bold;
            color: #ffeb3b;
            text-shadow: 0 0 10px #ffeb3b;
        }




    </style>
</head>
<body>
    <div class="modal" id="welcomeModal" style="display: none;">
        <div class="modal-content">
            <img src="./1.gif" alt="">
            <h2>Chào mừng đến web của Tài_11D7</h2>
            <p>Chào mừng bạn đến với trang web của tôi! Tôi là một người yêu thích công nghệ và đang học lập trình. </p>
            <p>Rất mong bạn có thể hài lòng bởi dịch vụ của chúng tôi...</p>
            <button class="close-btn" onclick="closeModal()">Đóng</button>
        </div>
    </div>

    <h1 class="fancy-title">🔐 Tool Giải Mã MD5 🔍</h1>

    <div class="container">

        <!-- Form nhập MD5 -->
        <form method="POST">
            <div class="form-container">
                <input type="text" name="md5" placeholder="Nhập mã MD5" required>
                <button type="submit" name="submit">Giải Mã</button>
            </div>
        </form>
        <img src="./3.gif" style="margin-left: 20px ;"  >
    </div>
    <footer class="fancy-footer">
        <p>© 2023 Tool Tài Xỉu. Bởi <span class="highlight">TRẦN HƯNG TÀI.</span>.</p>
    </footer>

    
    <script>
        window.onload = function () {
        const modalShown = sessionStorage.getItem("welcome_shown");
        if (!modalShown) {
            document.getElementById("welcomeModal").style.display = "flex";
            sessionStorage.setItem("welcome_shown", "yes"); // Chỉ hiện 1 lần cho mỗi tab
        }
    };

    function closeModal() {
        document.getElementById("welcomeModal").style.display = "none";
    }

       
    </script>

    

<?php if (isset($result)): ?>
    <!-- Hiển thị kết quả trong bảng thông báo -->
    <div class="result-box" id="resultBox">
        <p><strong><img src="./12.gif" alt=""></strong></p>
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
