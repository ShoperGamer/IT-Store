<?php
// --- การเชื่อมต่อฐานข้อมูล ---
require_once 'config.php';

try {
    // สร้าง Connection ด้วย PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // --- ดึงข้อมูลสินค้าจากฐานข้อมูล ---
    $searchQuery = "";
    $params = [];
    
    // ตรวจสอบว่ามีการส่งค่าการค้นหามาหรือไม่
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $searchTerm = '%' . $_GET['search'] . '%';
        $searchQuery = "WHERE name LIKE :search";
        $params[':search'] = $searchTerm;
    }
    
    // ตรวจสอบการค้นหาตามช่วงราคา
    if (isset($_GET['min_price']) && is_numeric($_GET['min_price'])) {
        if (!empty($searchQuery)) {
            $searchQuery .= " AND price >= :min_price";
        } else {
            $searchQuery = "WHERE price >= :min_price";
        }
        $params[':min_price'] = $_GET['min_price'];
    }
    
    if (isset($_GET['max_price']) && is_numeric($_GET['max_price'])) {
        if (!empty($searchQuery)) {
            $searchQuery .= " AND price <= :max_price";
        } else {
            $searchQuery = "WHERE price <= :max_price";
        }
        $params[':max_price'] = $_GET['max_price'];
    }
    
    $sql = "SELECT id, name, description, price, image_url FROM products $searchQuery ORDER BY price ASC";
    $stmt = $conn->prepare($sql);
    
    foreach ($params as $key => &$val) {
        $stmt->bindParam($key, $val);
    }
    
    $stmt->execute();
    $products = $stmt->fetchAll();
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$conn = null; // ปิด Connection
?>

<!DOCTYPE html>
<html lang="th" data-bs-theme="<?= isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการสินค้า IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        
        /* Light Mode Styles */
        [data-bs-theme="light"] {
            background-color: #f8f9fa;
        }
        [data-bs-theme="light"] .card {
            background-color: #ffffff;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        [data-bs-theme="light"] .card:hover {
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        [data-bs-theme="light"] .text-primary {
            color: #0d6efd !important;
        }
        
        /* Dark Mode Styles */
        [data-bs-theme="dark"] {
            background-color: #212529;
            color: #f8f9fa;
        }
        [data-bs-theme="dark"] .card {
            background-color: #2c3034;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }
        [data-bs-theme="dark"] .card:hover {
            box-shadow: 0 15px 30px rgba(0,0,0,0.5);
        }
        [data-bs-theme="dark"] .text-muted {
            color: #adb5bd !important;
        }
        [data-bs-theme="dark"] .text-primary {
            color: #85b6ff !important;
        }
        [data-bs-theme="dark"] .alert-warning {
            background-color: #664d03;
            border-color: #664d03;
            color: #ffda6a;
        }
        [data-bs-theme="dark"] .btn-outline-primary {
            color: #85b6ff;
            border-color: #85b6ff;
        }
        [data-bs-theme="dark"] .btn-outline-primary:hover {
            background-color: #85b6ff;
            color: #212529;
        }
        .search-box {
            background-color: var(--bs-body-bg);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- ปุ่มสลับโหมด -->
        <div class="text-end mb-3">
            <button id="themeToggle" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-moon-fill d-none"></i>
                <i class="bi bi-sun-fill d-none"></i>
                <span id="themeText">เปลี่ยนโหมด</span>
            </button>
        </div>
        
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary">รายการสินค้า IT</h1>
            <p class="lead text-muted">สินค้า IT คุณภาพดีราคาย่อมเยา</p>
        </div>

        <!-- ช่องค้นหา -->
        <div class="search-box mb-5">
            <form method="GET" action="">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="search" class="form-label">ค้นหาตามชื่อสินค้า</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="search" name="search" 
                                   placeholder="กรอกชื่อสินค้า..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i> ค้นหา
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="min_price" class="form-label">ราคาต่ำสุด</label>
                        <input type="number" class="form-control" id="min_price" name="min_price" 
                               placeholder="ราคาต่ำสุด" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="max_price" class="form-label">ราคาสูงสุด</label>
                        <input type="number" class="form-control" id="max_price" name="max_price" 
                               placeholder="ราคาสูงสุด" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>">
                    </div>
                    <div class="col-12 text-end">
                        <a href="?" class="btn btn-outline-secondary">ล้างการค้นหา</a>
                    </div>
                </div>
            </form>
        </div>

        <!-- แสดงผลการค้นหา -->
        <?php if (isset($_GET['search']) || isset($_GET['min_price']) || isset($_GET['max_price'])): ?>
            <div class="alert alert-info mb-4">
                <i class="bi bi-info-circle"></i> 
                <?php
                    $searchMessages = [];
                    if (!empty($_GET['search'])) {
                        $searchMessages[] = "คำค้นหา: " . htmlspecialchars($_GET['search']);
                    }
                    if (!empty($_GET['min_price'])) {
                        $searchMessages[] = "ราคาตั้งแต่: " . number_format($_GET['min_price'], 2) . " บาท";
                    }
                    if (!empty($_GET['max_price'])) {
                        $searchMessages[] = "ราคาสูงสุด: " . number_format($_GET['max_price'], 2) . " บาท";
                    }
                    echo implode(", ", $searchMessages);
                ?>
                <span class="float-end">พบ <?= count($products) ?> รายการ</span>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4 col-lg-3">
                        <div class="card h-100">
                            <img src="<?= htmlspecialchars($product['image_url'] ?? 'https://via.placeholder.com/300x200?text=No+Image') ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($product['name']) ?>"
                                 onerror="this.src='https://via.placeholder.com/300x200?text=Image+Error'">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                <p class="card-text text-muted flex-grow-1 small"><?= nl2br(htmlspecialchars(mb_strimwidth($product['description'], 0, 100, '...'))) ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="text-danger fw-bold">฿<?= number_format($product['price'], 2) ?></span>
                                    <a href="detail.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye-fill"></i> ดูรายละเอียด
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center py-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill fs-3 d-block mb-2"></i>
                        <?php if (isset($_GET['search']) || isset($_GET['min_price']) || isset($_GET['max_price'])): ?>
                            ไม่พบสินค้าที่ตรงกับเงื่อนไขการค้นหา
                        <?php else: ?>
                            ไม่พบสินค้าในระบบ
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>


    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>