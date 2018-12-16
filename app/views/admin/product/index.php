<div class="card p-0" style="width: 100% !important; max-width: 100% !important;">
    <div class="card-header">Prices</div>
    <div class="card-body">
        <table class="table table-hover ">
            <tr>
                <td>Total Instock Prices:</td>
                <td><?php echo $total_instock->price?>  ~ <?php echo  number_format( round($total_instock->price,2)) ?> £ </td>
            </tr>
            <tr>
                <td>Total OutofStock Prices: </td>
                <td> <?php echo $total_outofstock->price?> ~ <?php echo number_format( round($total_outofstock->price,2))?>  £ </td>
            </tr>
            <tr>
                <td>Total Products Prices:</td>
                <td><?php echo $total_prices->price?> ~ <?php echo number_format( round($total_prices->price,2))?>  £</td>
            </tr>
        </table>
    </div>
</div>

<hr>

<table class="table table-hover myTable">
    <thead>
    <tr>
        <th>ID</th>
        <th width="40%">Product</th>
        <th>Price</th>
        <th>Status</th>
        <th>Stock</th>
        <th>Added Date</th>
        <th>--</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product) { ?>
        <tr>
            <td><?php echo $product->id?></td>
            <td><?php echo $product->title?></td>
            <td><?php echo $product->price?></td>
            <td><?php echo $product->status?></td>
            <td><?php echo $product->stock?></td>
            <td><?php echo $product->date?></td>
            <td></td>
        </tr>
    <?php } ?>
    </tbody>
</table>