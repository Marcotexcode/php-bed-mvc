
<!-- mostra la lista dei prodotti. -->
<div class="card">
    <div class="card-header">
        <a class="btn btn-success" href="/php-bed-mvc/public/product/create">Add product</a>
    </div>
    <div class="card-body">
        <table class="table">
            <?php if ($products): ?>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Subscribers</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <th scope="row"><?= htmlentities($product['entity_id']) ?></th>
                            <td><?= htmlentities($product['sku']) ?></td>
                            <td><?= htmlentities($product['name']) ?></td>
                            <td><?= htmlentities(number_format($product['price'], 2)) ?> €</td>
                            <td><?= htmlentities($product['quantity']) ?></td>
                            <td><?= $product['subscribers'] ?></td>
                            <td><a class="btn btn-warning" href="/php-bed-mvc/public/product/show/<?= $product['entity_id'] ?>">Edit</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            <?php else: ?>
                <div class="text-center">No product</div>
            <?php endif ?>
        </table>
    </div>
</div>
