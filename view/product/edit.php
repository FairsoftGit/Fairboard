<?php
function printCompanyOptions($companies, $companyRelationNumber)
{
    $newArray = [];
    foreach ($companies as $company) {
        if ($companyRelationNumber == $company->getRelationNumber()) {
            $newArray[] = $company;
            break;
        }
    }
    if (empty($newArray)) {
        $newArray[] = new Company('', '', '');
    }

    foreach ($companies as $company) {
        if ($companyRelationNumber != $company->getRelationNumber()) {
            $newArray[] = $company;
        }
    }
    foreach ($newArray as $company) {
        if ($company->getRelationNumber() == '') {
            echo "<option value='' disabled selected>Selecteer een bedrijf</option>";
        } else {
            echo "<option value=" . $company->getRelationNumber() . ">" . $company->getName() . "</option>";
        }
    }
}
?>
<div class="col-md-12">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="\fairboard">Home</a></li>
            <li class="breadcrumb-item"><a href="?controller=Product&action=index">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">Aanpassen</li>
        </ol>
    </nav>
    <h2 class="my-4"><?php echo $product->getProductName();?></h2>
    <form id="contact-form" class="my-4 col-md-6" action="?controller=Product&action=update"
          method="POST">
        <div class="form-group">
            <label for="inputProductId">Productnummer</label>
            <input readonly name="productId" type="text" class="form-control" id="inputProductId"
                   placeholder=""
                   value="<?php echo $product->getProductid();?>">
        </div>
        <div class="form-group">
            <label for="inputProductName">Naam</label>
            <input name="productName" type="text" class="form-control" id="inputProductName"
                   placeholder="Naam"
                   value="<?php echo $product->getProductName();?>" required>
        </div>
        <div class="form-group">
            <label for="inputProductDesc">Beschrijving</label>
            <textarea name="productDesc" placeholder="Beschrijving" class="form-control" id="inputProductDesc" rows="4"><?php echo $product->getProductDesc();?></textarea>
        </div>
        <div class="form-group">
            <label for="inputPurchasePrice">Inkoopprijs</label>
            <input name="purchasePrice" type="number" class="form-control" id="inputPurchasePrice"
                   placeholder="Inkoopprijs"
                   value="<?php echo $product->getPurchasePrice();?>" required>
        </div>
        <div class="form-group">
            <label for="inputSalesPrice">Verkoopprijs</label>
            <input name="salesPrice" type="number" class="form-control" id="inputSalesPrice"
                   placeholder="Verkoopprijs"
                   value="<?php echo $product->getSalesPrice();?>" required>
        </div>
        <div class="form-group">
            <label for="inputRentalPrice">Huurprijs</label>
            <input name="rentalPrice" type="number" class="form-control" id="inputRentalPrice"
                   placeholder="Verhuurprijs"
                   value="<?php echo $product->getRentalPrice();?>" required>
        </div>
        <div class="form-group">
            <label for="inputRelationNumber">Bedrijf</label>
            <select name="relationNumber" type="text" class="form-control" id="inputRelationNumber" required>
                <?php
                    printCompanyOptions($companies, $product->getRelationNumber());
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('.navLinkProduct').addClass('active');
    });
</script>