document.addEventListener('DOMContentLoaded', () => {
    // Form validation for add/edit product
    const productForm = document.getElementById('productForm');
    if (productForm) {
        productForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateForm()) {
                // Add loading animation
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...';
                submitBtn.disabled = true;
                setTimeout(() => {
                    this.submit();
                }, 500); // Simulate processing delay
            }
        });
    }

    // Delete confirmation
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                e.preventDefault();
            }
        });
    });

    // Animate cards on scroll
    const cards = document.querySelectorAll('.product-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    cards.forEach(card => observer.observe(card));
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