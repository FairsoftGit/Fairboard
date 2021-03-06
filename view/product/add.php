<?php
function printCompanyOptions($companies)
{
    echo "<option value='' disabled selected>Selecteer een bedrijf</option>";
    foreach ($companies as $company) {
        echo "<option value=" . $company->getRelationNumber() . ">" . $company->getName() . "</option>";
    }
}

?>
<nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="\fairboard">Home</a></li>
        <li class="breadcrumb-item"><a href="?controller=Product&action=index">Product</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nieuw</li>
    </ol>
</nav>
<h2>Nieuw product</h2>
<div class="scrollable-content">
    <form id="contact-form" class="col-md-12" action="?controller=Product&action=create"
          method="POST">
        <div class="form-group">
            <label for="inputProductName">Naam</label>
            <input name="productName" type="text" class="form-control" id="inputProductName"
                   placeholder="Naam"
                   value="" required>
        </div>
        <div class="form-group">
            <label for="inputProductDesc">Beschrijving</label>
            <textarea name="productDesc" placeholder="Beschrijving" class="form-control" id="inputProductDesc"
                      rows="4"></textarea>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputPurchasePrice">Inkoopprijs</label>
                <input name="purchasePrice" type="number" class="form-control" id="inputPurchasePrice"
                       placeholder="Inkoopprijs"
                       value="" required>
            </div>
            <div class="form-group col-md-4">
                <label for="inputSalesPrice">Verkoopprijs</label>
                <input name="salesPrice" type="number" class="form-control" id="inputSalesPrice"
                       placeholder="Verkoopprijs"
                       value="" required>
            </div>
            <div class="form-group col-md-4">
                <label for="inputRentalPrice">Huurprijs</label>
                <input name="rentalPrice" type="number" class="form-control" id="inputRentalPrice"
                       placeholder="Verhuurprijs"
                       value="" required>
            </div>
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
    <script>
        $(document).ready(function () {
            $('.navLinkProduct').addClass('active');
        });
    </script>