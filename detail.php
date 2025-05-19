<?php
require_once 'config.php';

// ตรวจสอบว่ามีการส่ง ID มาไหม
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$productId = (int)$_GET['id'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // ดึงข้อมูลสินค้า
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();
    
    $product = $stmt->fetch();
    
    if (!$product) {
        header("Location: index.php");
        exit();
    }
    
    // ดึงสินค้าแนะนำ (ยกเว้นสินค้าปัจจุบัน)
    $stmtRelated = $conn->prepare("SELECT id, name, price, image_url FROM products WHERE id != :id ORDER BY RAND() LIMIT 4");
    $stmtRelated->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmtRelated->execute();
    
    $relatedProducts = $stmtRelated->fetchAll();
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$conn = null;

// กำหนดค่าเริ่มต้นหากไม่มีข้อมูลบางส่วน
$product['name'] = $product['NAME'] ?? '';
$product['description'] = $product['description'] ?? '';
$product['price'] = $product['price'] ?? 0;
$product['image_url'] = $product['image_url'] ?? '';
$product['updated_at'] = $product['updated_at'] ?? date('Y-m-d H:i:s');
$product['created_at'] = $product['created_at'] ?? date('Y-m-d H:i:s');
// ตรวจสอบโหมดจากคุกกี้
$currentTheme = $_COOKIE['theme'] ?? 'light';
?>

<!DOCTYPE html>
<html lang="th" data-bs-theme="<?= $currentTheme ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> - รายละเอียดสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house-door"></i> หน้าหลัก</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($product['name']) ?></li>
            </ol>
        </nav>

        <!-- ข้อมูลสินค้าหลัก -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card h-100">
                    <img src="<?= htmlspecialchars($product['image_url'] ?: 'https://via.placeholder.com/600x400?text=No+Image') ?>" 
                         class="card-img-top product-image p-3" 
                         alt="<?= htmlspecialchars($product['name']) ?>"
                         onerror="this.src='https://via.placeholder.com/600x400?text=Image+Error'">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h1 class="h2 fw-bold"><?= htmlspecialchars($product['name']) ?></h1>
                        
                        <div class="d-flex align-items-center mb-3">
                            <span class="text-danger fs-3 fw-bold me-3">฿<?= number_format($product['price'], 2) ?></span>
                            <?php if ($product['price'] > 1000): ?>
                                <span class="badge bg-success">ฟรีค่าจัดส่ง</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="fw-bold">รายละเอียดสินค้า</h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="fw-bold">ข้อมูลเพิ่มเติม</h5>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-calendar-check"></i> อัปเดตล่าสุด: <?= date('d/m/Y H:i', strtotime($product['updated_at'])) ?></li>
                                <?php if ($product['created_at'] != $product['updated_at']): ?>
                                    <li><i class="bi bi-info-circle"></i> ข้อมูลสินค้านี้มีการอัปเดต</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex">
                            <button class="btn btn-primary btn-lg flex-grow-1">
                                <i class="bi bi-cart-plus"></i> เพิ่มลงตะกร้า
                            </button>
                            <button class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-heart"></i> บันทึก
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- สินค้าแนะนำ -->
        <?php if (!empty($relatedProducts)): ?>
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="h4 fw-bold border-bottom pb-2">สินค้าแนะนำ</h3>
                </div>
            </div>
            
            <div class="row g-3">
                <?php foreach ($relatedProducts as $related): 
                    $related['name'] = $related['name'] ?? 'ไม่มีชื่อสินค้า';
                    $related['image_url'] = $related['image_url'] ?? '';
                    $related['price'] = $related['price'] ?? 0;
                ?>
                    <div class="col-6 col-md-3">
                        <div class="card h-100">
                            <a href="detail.php?id=<?= $related['id'] ?>">
                                <img src="<?= htmlspecialchars($related['image_url'] ?: 'https://via.placeholder.com/300x200?text=No+Image') ?>" 
                                     class="card-img-top related-product-img" 
                                     alt="<?= htmlspecialchars($related['name']) ?>"
                                     onerror="this.src='https://via.placeholder.com/300x200?text=Image+Error'">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title h6">
                                    <a href="detail.php?id=<?= $related['id'] ?>" class="text-decoration-none text-dark">
                                        <?= htmlspecialchars(mb_strimwidth($related['name'], 0, 50, '...')) ?>
                                    </a>
                                </h5>
                                <p class="card-text text-danger fw-bold mb-0">฿<?= number_format($related['price'], 2) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <style>
        .product-image {
            max-height: 500px;
            object-fit: contain;
        }
        .related-product-img {
            height: 120px;
            object-fit: cover;
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
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
        [data-bs-theme="dark"] .breadcrumb-item.active {
            color: #dee2e6;
        }
        [data-bs-theme="dark"] .text-dark {
            color: #f8f9fa !important;
        }
    </style>
    
    <script src="detail.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>