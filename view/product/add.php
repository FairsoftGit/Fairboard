<?php
function printCompanyOptions($companies) {
    echo "<option value='' disabled selected>Selecteer een bedrijf</option>";
    foreach($companies as $company) {
        echo "<option value=".$company->getRelationNumber().">".$company->getName()."</option>";
    }
}
?>
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="\Fairboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="?controller=product&action=index">Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nieuw</li>
                </ol>
            </nav>
            <h2 class="my-4">Nieuw product</h2>
            <form id="contact-form" class="my-4 col-md-6" action="?controller=product&action=create"
                  method="POST">
                <div class="form-group">
                    <label for="inputProductName">Naam</label>
                    <input name="productName" type="text" class="form-control" id="inputProductName"
                           placeholder="Naam"
                           value="" required>
                </div>
                <div class="form-group">
                    <label for="inputProductDesc">Beschrijving</label>
                    <input name="productDesc" type="text" class="form-control" id="inputProductDesc"
                           placeholder="Beschrijving"
                           value="" required>
                </div>
                <div class="form-group">
                    <label for="inputPurchasePrice">Inkoopprijs</label>
                    <input name="purchasePrice" type="number" class="form-control" id="inputPurchasePrice"
                           placeholder="Inkoopprijs"
                           value="" required>
                </div>
                <div class="form-group">
                    <label for="inputSalesPrice">Verkoopprijs</label>
                    <input name="salesPrice" type="number" class="form-control" id="inputSalesPrice"
                           placeholder="Verkoopprijs"
                           value="" required>
                </div>
                <div class="form-group">
                    <label for="inputRentalPrice">Huurprijs</label>
                    <input name="rentalPrice" type="number" class="form-control" id="inputRentalPrice"
                           placeholder="Verhuurprijs"
                           value="" required>
                </div>
                <div class="form-group">
                    <label for="inputRelationNumber">Bedrijf</label>
                    <select name="relationNumber" type="text" class="form-control" id="inputRelationNumber" required>
                        <?php
                        printCompanyOptions($companies);
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Opslaan</button>
            </form>
        </div>
</main>
<script>
    $(document).ready(function () {
        $('.navLinkProduct').addClass('active');
    });
</script>