<div class="col-md-12">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="\fairboard">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Producten</li>
        </ol>
    </nav>
    <h2>Producten</h2>
    <div class="input-group my-2">
        <span class="input-group-addon" id="search-Product-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
        <input id="searchProductInput" type="text" class="form-control" placeholder="Zoeken" aria-label="SearchProducts"
               aria-describedby="search-Product-addon">
    </div>
    <div class="table-responsive">
        <table id="productTable" class="table table-dark table-striped table-hover table-filter">
            <thead>
            <tr>
                <th><a href="?controller=Product&action=add" data-placement="top" data-toggle="tooltip"
                       title="Toevoegen" class="btn btn-success btn-xs" role="button" aria-pressed="true"><span
                                class="fa fa-plus"></span></a></th>
                <th>Naam</th>
                <th>Inkoopprijs</th>
                <th>Verkoopprijs</th>
                <th>Verhuurprijs</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product) { ?>
                <tr class="table-row">
                    <td></td>
                    <td class="productName"><?php echo $product->getProductName(); ?></td>
                    <td class="purchasePrice"><?php echo $product->getPurchasePrice() ?></td>
                    <td class="salesPrice"><?php echo $product->getSalesPrice() ?></td>
                    <td class="rentalPrice"><?php echo $product->getRentalPrice() ?></td>
                    <td><a href="?controller=Product&action=edit&productId=<?php echo $product->getProductId(); ?>"
                           data-placement="top" data-toggle="tooltip" title="Aanpassen" class="btn btn-primary btn-xs"
                           role="button" aria-pressed="true"><span class="fa fa-pencil"></span></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.navLinkProduct').addClass('active');

        document.querySelector('#searchProductInput').addEventListener('keyup', filterProductTable, false);

        $('.btn-filter').on('click', function () {
            var $target = $(this).data('target');
            if ($target != 'all') {
                $('tbody tr').css('display', 'none');
                $('tbody tr[data-status="' + $target + '"]').fadeIn();
            } else {
                $('tbody tr').css('display', 'none').fadeIn('slow');
            }
        });

        function filterProductTable(event) {
            var filter = event.target.value.toUpperCase();
            var rows = document.querySelector("#productTable tbody").rows;

            for (var i = 0; i < rows.length; i++) {
                var firstCol = rows[i].cells[1].textContent.toUpperCase();
                if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    });
</script>