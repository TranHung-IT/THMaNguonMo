<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .product-list {
            margin: 2rem auto;
            max-width: 800px;
        }
        .product-card {
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container product-list">
        <h1 class="mb-4">Danh sách sản phẩm</h1>

        <a href="/project1/Product/add" class="btn btn-primary mb-4">Thêm sản phẩm mới</a>

        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-6 mb-3">
                    <div class="card product-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?>
                            </h5>
                            <p class="card-text">
                                <?php echo htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p class="card-text">
                                Giá: <?php echo htmlspecialchars(number_format($product->getPrice(), 2), ENT_QUOTES, 'UTF-8'); ?> VNĐ
                            </p>
                            <a href="/project1/Product/edit/<?php echo $product->getID(); ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="/project1/Product/delete/<?php echo $product->getID(); ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/scripts.js"></script>
</body>
</html>