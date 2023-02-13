<!-- Mostra il template del singolo prodotto. -->
<?php
    if ($product) {
        $route = '/php-bed-mvc/public/product/update/' .  $product['entity_id'];
    } else {
        $route = '/php-bed-mvc/public/product/save';
    }
?>
<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                Actions
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 my-4 d-grid gap-2">
                        <a class="btn btn-outline-secondary" href="/php-bed-mvc/public/products">Return</a>
                    </div>
                    <?php if ($product): ?>
                        <form class="d-grid gap-2" method="post">
                            <input type="hidden" name="action" value="delete">
                            <button onclick="return confirm('Delete user?')" type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="card">
            <div class="card-header">
                <?php if ($product): ?>
                    <h2>Product: <?= $product['entity_id'] ?></h2>
                <?php else: ?>
                    <h2>Create product</h2>
                <?php endif ?>
            </div>
            <div class="card-body">
             
                <form action="<?= $route ?>" method="POST">
                    <div class="mb-3" >
                        <label for="sku" class="form-label">SKU</label>
                        <input required type="text" class="form-control" id="sku"  name="sku" value="<?= $product ? $product['sku'] : '' ?>">
                    </div>
                    <div class="mb-3" >
                        <label for="name" class="form-label">Name</label>
                        <input required type="text" class="form-control" id="name"  name="name" value="<?= $product ? $product['name'] : '' ?>">
                    </div>
                    <div class="mb-3" >
                        <label for="description" class="form-label">Description</label>
                        <input required type="text" class="form-control" id="description"  name="description" value="<?= $product ? $product['description'] : '' ?>">
                    </div>
                    <div class="mb-3" >
                        <label for="price" class="form-label">Price</label>
                        <input required type="number" step="0.01" class="form-control" id="price"  name="price" value="<?= $product ? number_format($product['price'], 2) : '' ?>">
                    </div>
                    <div class="mb-3" >
                        <label for="qty" class="form-label">Qty</label>
                        <input required type="hidden" id="qty_orig" name="qty_orig" value="<?= $product ? $product['quantity'] : '' ?>">
                        <input required type="number" class="form-control" id="qty" name="qty" value="<?= $product ? $product['quantity'] : '' ?>"><br>
                    </div>
                    <input type="hidden" name="action" value="save">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>