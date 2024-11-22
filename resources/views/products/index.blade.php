<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="container mt-5">
    <h1 class="mb-4">Product Management</h1>
    <form id="productForm">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity in Stock</label>
            <input type="number" class="form-control" id="quantity" name="quantity_in_stock" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price per Item</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price_per_item" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date Submitted</th>
                <th>Total Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productTable"></tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end fw-bold">Total Sum:</td>
                <td id="totalSum">0</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <script>
        const fetchProducts = () => {
            axios.get('/products/data').then(response => {
                let rows = '';
                let totalSum = 0;
                response.data.forEach(product => {
                    const totalValue = product.quantity_in_stock * product.price_per_item;
                    rows += `
                        <tr>
                            <td>${product.name}</td>
                            <td>${product.quantityPerstock}</td>
                            <td>${product.pricePeritem}</td>
                            <td>${product.created_at}</td>
                            <td>${totalValue}</td>
                            <td><button class="btn btn-sm btn-secondary">Edit</button></td>
                        </tr>
                    `;
                    totalSum += totalValue;
                });
                $('#productTable').html(rows);
                $('#totalSum').text(totalSum);
            });
        };

        $('#productForm').submit(function (event) {
            event.preventDefault();
            const formData = $(this).serialize();
            axios.post('/products', formData).then(() => {
                $(this).trigger('reset');
                fetchProducts();
            });
        });

        fetchProducts();
    </script>
</body>
</html>
