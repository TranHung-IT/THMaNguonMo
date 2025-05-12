<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .error-message {
            display: none;
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 0.25rem;
        }
        .is-invalid + .error-message {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="mb-4">Sửa sản phẩm</h1>

            <form id="productForm" method="POST" action="/project1/Product/edit/<?php echo $product->getID(); ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm:</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?>" required>
                    <div class="error-message" id="nameError"></div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>
                        <?php echo htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8'); ?>
                    </textarea>
                    <div class="error-message" id="descriptionError"></div>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Giá:</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" 
                           value="<?php echo htmlspecialchars($product->getPrice(), ENT_QUOTES, 'UTF-8'); ?>" required>
                    <div class="error-message" id="priceError"></div>
                </div>

                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="/project1/Product/list" class="btn btn-secondary ms-2">Quay lại</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/scripts.js"></script>
    <script>
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let isValid = validateForm();
            if (isValid) {
                this.submit();
            }
        });

        function validateForm() {
            let isValid = true;
            const name = document.getElementById('name');
            const price = document.getElementById('price');
            const description = document.getElementById('description');

            // Reset errors
            [name, price, description].forEach(input => {
                input.classList.remove('is-invalid');
                document.getElementById(`${input.id}Error`).textContent = '';
            });

            // Validate name
            if (name.value.trim().length < 10 || name.value.trim().length > 100) {
                name.classList.add('is-invalid');
                document.getElementById('nameError').textContent = 'Tên sản phẩm phải từ 10 đến 100 ký tự.';
                isValid = false;
            }

            // Validate description
            if (description.value.trim().length < 10) {
                description.classList.add('is-invalid');
                document.getElementById('descriptionError').textContent = 'Mô tả phải có ít nhất 10 ký tự.';
                isValid = false;
            }

            // Validate price
            if (price.value <= 0 || isNaN(price.value)) {
                price.classList.add('is-invalid');
                document.getElementById('priceError').textContent = 'Giá phải là số dương lớn hơn 0.';
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>