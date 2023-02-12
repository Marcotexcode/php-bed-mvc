<!-- Mostra il template del singolo prodotto. -->

<div class="card">
    <div class="card-header">
        <h2>Product: <?= $product['entity_id'] ?></h2>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="mb-3" >
                <label for="sku" class="form-label">SKU</label>
                <input required type="text" class="form-control" id="sku"  name="sku" value="<?= $product['sku'] ?>">
            </div>
            <div class="mb-3" >
                <label for="name" class="form-label">Name</label>
                <input required type="text" class="form-control" id="name"  name="name" value="<?= $product['name'] ?>">
            </div>
            <div class="mb-3" >
                <label for="description" class="form-label">Description</label>
                <input required type="text" class="form-control" id="description"  name="description" value="<?= $product['description'] ?>">
            </div>
            <div class="mb-3" >
                <label for="price" class="form-label">Price</label>
                <input required type="number" step="0.01" class="form-control" id="price"  name="price" value="<?= number_format($product['price'], 2) ?>">
            </div>
            <div class="mb-3" >
                <label for="qty" class="form-label">Qty</label>
                <input required type="hidden" id="qty_orig" name="qty_orig" value="<?= $product['quantity'] ?>">
                <input required type="number" class="form-control" id="qty" name="qty" value="<?= $product['quantity'] ?>"><br>
            </div>
            <input type="hidden" name="action" value="save">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>