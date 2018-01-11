<?php
function printCountryOptions($countryList, $code)
{
    $newArray = [];
    foreach ($countryList as $country) {
        if ($code == $country->getCode()) {
            $newArray[] = $country;
            break;
        }
    }
    if (empty($newArray)) {
        $newArray[] = new Country('', '');
    }

    foreach ($countryList as $country) {
        if ($code != $country->getCode()) {
            $newArray[] = $country;
        }
    }
    foreach ($newArray as $country) {
        if ($country->getCode() == '') {
            echo "<option value='' disabled selected>Selecteer een land</option>";
        } else {
            echo "<option value=" . $country->getCode() . ">" . $country->getName_dutch() . "</option>";
        }
    }
}
function printRelationTypeOptions($relationTypes, $currentValue)
{
    $newArray = [];
    foreach ($relationTypes as $type) {
        if ($currentValue == $type) {
            $newArray[] = $type;
            break;
        }
    }
    if (empty($newArray)) {
        echo "<option value='' disabled selected>Selecteer type</option>";
    }

    foreach ($relationTypes as $type) {
        if ($currentValue != $type) {
            $newArray[] = $type;
        }
    }
    foreach ($newArray as $type) {
        if ($type == '') {
            echo "<option value='' disabled selected>Selecteer type</option>";
        } else {
            echo "<option>" . $type . "</option>";
        }
    }
}
?>
<nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="\fairboard">Home</a></li>
        <li class="breadcrumb-item"><a href="?controller=Account&action=index">Account</a></li>
        <li class="breadcrumb-item active" aria-current="page">Aanpassen</li>
    </ol>
</nav>
<h2>Account <?php echo $account->getUsername(); ?></h2>
<div class="scrollable-content">
    <nav class="nav nav-tabs" id="account-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-relation-tab" data-toggle="tab" href="#nav-relation"
           role="tab" aria-controls="nav-relation" aria-selected="true">Relatie</a>
        <a class="nav-item nav-link" id="nav-account-tab" data-toggle="tab" href="#nav-account"
           role="tab" aria-controls="nav-account" aria-selected="false">Account</a>
        <a class="nav-item nav-link" id="nav-person-tab" data-toggle="tab" href="#nav-person" role="tab"
           aria-controls="nav-person" aria-selected="false">Persoonsgegevens</a>
        <a class="nav-item nav-link" id="nav-address-tab" data-toggle="tab" href="#nav-address" role="tab"
           aria-controls="nav-address" aria-selected="false">Adres</a>
        <a class="nav-item nav-link" id="nav-order-tab" data-toggle="tab" href="#nav-order" role="tab"
           aria-controls="nav-order" aria-selected="false">Bestelhistorie</a>
    </nav>
    <!--##Relation tab-->
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-relation" role="tabpanel"
             aria-labelledby="nav-relation-tab">
            <form id="relation-form" class="my-4 col-md-12" action="?controller=Relation&action=update"
                  method="POST">
                <div class="form-check">
                    <label class="form-check-label">
                        <input name="isActive" type="checkbox"
                               class="form-check-input" <?php echo($relation->getIsActive() == 1 ? 'checked' : '') ?>>
                        Status
                    </label>
                </div>
                <div class="form-group">
                    <label for="inputRelationNumber">Relatienummer</label>
                    <input readonly name="relationNumber" type="text" class="form-control" id="inputRelationNumber"
                           placeholder=""
                           value="<?php echo $relation->getRelationNumber(); ?>">
                </div>
                <div class="form-group">
                    <label for="inputRelationType">Type</label>
                    <select name="relationType" type="text" class="form-control" id="inputRelationType" required>
                        <?php
                            printRelationTypeOptions($relationTypes, $relation->getRelationType());
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input name="emailAddress" type="email" class="form-control" id="inputEmail"
                           placeholder="Email adres"
                           value="<?php echo $relation->getEmailAddress(); ?>" required>
                </div>
                <div class="form-group">
                    <label for="inputPhoneNumber">Telefoonnummer</label>
                    <input name="phoneNumber" type="tel" class="form-control" id="inputPhoneNumber"
                           placeholder="Telefoonnummer"
                           value="<?php echo $relation->getPhoneNumber(); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Opslaan</button>
            </form>
        </div> <!--##Relation tab-->
        <!--##Account tab-->
            <div class="tab-pane fade" id="nav-account" role="tabpanel"
                 aria-labelledby="nav-account-tab">
                <form id="account-form" class="my-4 col-md-12" action="?controller=Account&action=update"
                      method="POST">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input name="status" type="checkbox"
                                   class="form-check-input" <?php echo($account->getStatus() == 1 ? 'checked' : '') ?>>
                            Status
                        </label>
                    </div>
                        <input readonly name="relationNumber" type="hidden" class="form-control"
                               value="<?php echo $account->getRelationNumber(); ?>">
                    <div class="form-group">
                        <label for="inputUsername">Gebruikersnaam</label>
                        <input readonly name="username" type="text" class="form-control" id="inputUsername"
                               placeholder="Gebruikersnaam"
                               value="<?php echo $account->getUsername(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Wachtwoord</label>
                        <input name="password" type="password" class="form-control" id="inputPassword"
                               placeholder="Wachtwoord"
                               value="<?php echo $account->getPassword(); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </form>
            </div> <!--##Account tab-->
            <!--##Person tab-->
            <div class="tab-pane fade" id="nav-person" role="tabpanel" aria-labelledby="nav-person-tab">
                <form id="person-form" class="my-4 col-md-12" action="?controller=Person&action=update"
                      method="POST">
                    <input name="relationNumber" type="hidden" class="form-control"
                           value="<?php echo $person->getRelationNumber(); ?>">
                    <div class="form-group">
                        <label for="inputFirstName">Voornaam</label>
                        <input name="firstName" type="text" class="form-control" id="inputFirstName"
                               placeholder="Voornaam"
                               value="<?php echo $person->getFirstname(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="inputMiddleName">Tussenvoegsel</label>
                        <input name="middleName" type="text" class="form-control" id="inputMiddleName"
                               placeholder="Tussenvoegsel"
                               value="<?php echo $person->getMiddleName(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputLastName">Achternaam</label>
                        <input name="lastName" type="text" class="form-control" id="inputLastName"
                               placeholder="Achternaam"
                               value="<?php echo $person->getLastName(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="inputGender">Geslacht</label>

                        <select name="gender" type="text" class="form-control" id="inputGender" required>
                            <?php
                            if ($person->getGender() == 'M') {
                                echo "<option>Man</option>";
                                echo "<option>Vrouw</option>";
                            } else if ($person->getGender() == 'V') {
                                echo "<option>Vrouw</option>";
                                echo "<option>Man</option>";
                            } else {
                                echo "<option value='' disabled selected>Selecteer geslacht</option>";
                                echo "<option value='Man'>Man</option>";
                                echo "<option value='Vrouw'>Vrouw</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputBirthDate">Geboortedatum</label>
                        <input name="birthDate" type="date" class="form-control" id="inputBirthDate"
                               placeholder="Geboortedatum"
                               value="<?php
                               if ($person->getBirthDate() != '0000-00-00') {
                                   echo date('Y-m-d', strtotime($person->getBirthDate()));
                               }
                               ?>" required>
                    </div>
                    <button type="submit" class="my-2 btn btn-primary">Opslaan</button>
                </form>
            </div> <!--##Person tab-->
            <!--Address tab-->
            <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
                <form id="address-form" class="my-4 col-md-12" action="?controller=Address&action=update"
                      method="POST">
                    <input name="relationNumber" type="hidden" class="form-control"
                           value="<?php echo $person->getRelationNumber(); ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputStreet">Straatnaam</label>
                            <input name="street" type="text" class="form-control" id="inputStreet"
                                   placeholder="Straatnaam"
                                   value="<?php echo $address->getStreet(); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputHousenumber">Huisnummer</label>
                            <input name="housenumber" type="text" class="form-control" id="inputHousenumber"
                                   placeholder="Huisnummer"
                                   value="<?php echo $address->getHousenumber(); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPostcode">Postcode</label>
                            <input name="postcode" type="text" class="form-control" id="inputPostcode"
                                   placeholder="Postcode"
                                   value="<?php echo $address->getPostcode(); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">Stad</label>
                            <input name="city" type="text" class="form-control" id="inputCity" placeholder="Stad"
                                   value="<?php echo $address->getCity(); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputProvince">Provincie</label>
                            <input name="province" type="text" class="form-control" id="inputProvince"
                                   placeholder="Provincie"
                                   value="<?php echo $address->getProvince(); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCountry">Land</label>
                            <select name="countryCode" type="text" class="form-control" id="inputCountry" required>
                                <?php
                                printCountryOptions($countryList, $address->getCountryCode());
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTypeOfAddress">Type adres</label>
                        <select name="typeOfAddress" type="text" class="form-control" id="inputTypeOfAddress" required>
                            <?php
                            if ($address->getTypeOfAddress() == 'Beide') {
                                echo "<option>Beide</option>";
                                echo "<option>Postadres</option>";
                                echo "<option>Afleveradres</option>";
                            } else if ($address->getTypeOfAddress() == 'Afleveradres') {
                                echo "<option>Afleveradres</option>";
                                echo "<option>Postadres</option>";
                                echo "<option>Beide</option>";
                            } else if ($address->getTypeOfAddress() == 'Postadres') {
                                echo "<option>Postadres</option>";
                                echo "<option>Afleveradres</option>";
                                echo "<option>Beide</option>";
                            } else {
                                echo "<option value='' disabled selected>Selecteer type adres</option>";
                                echo "<option>Postadres</option>";
                                echo "<option>Afleveradres</option>";
                                echo "<option>Beide</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </form>
            </div> <!-- ##Address tab-->
            <!-- Orderhistory tab -->
            <div class="tab-pane fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
                <div class="table-responsive">

                    <?php foreach ($orders as $order) { ?>
                        <table id="orderTable" class="table table-dark table-striped table-hover table-filter">
                            <caption class="accordion-toggle" data-toggle="collapse" data-target=".orderRow">
                                Datum: <?php echo $order->getOrderDate(); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Ordernummer: <?php echo $order->getOrderId(); ?></caption>
                            <tr class="bg-primary accordion-toggle orderRow" data-toggle="collapse"
                                data-target=".orderRow">
                                <th>Productnaam</th>
                                <th>Serienummer</th>
                                <th>Prijs</th>
                            </tr>

                            <?php foreach ($orderlines as $orderline) {
                                if ($order->getOrderId() == $orderline->getOrderId()) {
                                    ?>

                                    <tr class="table-row orderRow" data-status="">
                                        <td class="productName"><?php echo $orderline->getProductName(); ?></td>
                                        <td class="serialNumber"><?php echo $orderline->getSerialNumber(); ?></td>
                                        <td class="salesPrice"><?php echo $orderline->getSalesPrice(); ?></td>
                                    </tr>

                                <?php }
                            } ?>
                        </table>
                        <hr>
                    <?php } ?>
                </div>
            </div>
            <!-- ## Orderhistory tab -->
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.navLinkAccount').addClass('active');
        });
    </script>