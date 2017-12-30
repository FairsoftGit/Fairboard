<?php
function printCountryOptions($countryList, $code) {
    $newArray = [];
    foreach($countryList as $country) {
        if ($code == $country->getCode()) {
            $newArray[] = $country;
            break;
        }
    }
    if(empty($newArray)){
        $newArray[] = new Country('', '');
    }

        foreach($countryList as $country) {
            if ($code != $country->getCode()) {
                $newArray[] = $country;
            }
        }
    foreach ($newArray as $country) {
        echo "<option value=".$country->getCode().">".$country->getName_dutch()."</option>";
    }
}
?>
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="\Fairboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="?controller=account&action=index">Account</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Aanpassen account</li>
                </ol>
            </nav>
            <h2 class="my-4">Account <?php echo $account->getUsername(); ?></h2>
            <nav class="nav nav-tabs" id="account-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-account-tab" data-toggle="tab" href="#nav-account"
                   role="tab" aria-controls="nav-account" aria-selected="true">Account</a>
                <a class="nav-item nav-link" id="nav-person-tab" data-toggle="tab" href="#nav-person" role="tab"
                   aria-controls="nav-person" aria-selected="false">Persoonsgegevens</a>
                <a class="nav-item nav-link" id="nav-address-tab" data-toggle="tab" href="#nav-address" role="tab"
                   aria-controls="nav-address" aria-selected="false">Adres</a>
            </nav>
            <!--##Account tab-->
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-account" role="tabpanel"
                     aria-labelledby="nav-account-tab">
                    <form id="contact-form" class="my-4 col-md-6" action="?controller=account&action=update"
                          method="POST">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input name="status" type="checkbox"
                                       class="form-check-input" <?php echo($account->getStatus() == 1 ? 'checked' : '') ?>>
                                Status
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="inputRelationId">Relatienummer</label>
                            <input readonly name="relationId" type="text" class="form-control" id="inputRelationId"
                                   placeholder=""
                                   value="<?php echo $account->getRelationId(); ?>">
                        </div>
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
                    <form id="person-form" class="my-4 col-md-6" action="?controller=person&action=update"
                          method="POST">
                        <input name="relationId" type="hidden" class="form-control"
                               value="<?php echo $person->getRelationId(); ?>">
                        <div class="form-group">
                            <label for="inputFirstname">Voornaam</label>
                            <input name="firstname" type="text" class="form-control" id="inputFirstname" placeholder="Voornaam"
                                   value="<?php echo $person->getFirstname(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="inputMiddlename">Tussenvoegsel</label>
                            <input name="middlename" type="text" class="form-control" id="inputMiddlename"
                                   placeholder="Tussenvoegsel"
                                   value="<?php echo $person->getMiddlename(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputLastname">Achternaam</label>
                            <input name="lastname" type="text" class="form-control" id="inputLastname" placeholder="Achternaam"
                                   value="<?php echo $person->getLastname(); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="inputGender">Geslacht</label>

                            <select name="gender" type="text" class="form-control" id="inputGender" required>
                                <?php
                                if($person->getGender() == 'Man'){
                                    echo "<option>Man</option>";
                                    echo "<option>Vrouw</option>";
                                }
                                else if($person->getGender() == 'Vrouw'){
                                    echo "<option>Vrouw</option>";
                                    echo "<option>Man</option>";
                                }

                                else{
                                    echo "<option value='' disabled selected>Selecteer geslacht</option>";
                                    echo "<option value='Man'>Man</option>";
                                    echo "<option value='Vrouw'>Vrouw</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputBirthdate">Geboortedatum</label>
                            <input name="birthdate" type="date" class="form-control" id="inputBirthdate" placeholder="Geboortedatum"
                                   value="<?php
                                   if($person->getBirthdate() != '0000-00-00'){
                                       echo date( 'Y-m-d', strtotime( $person->getBirthdate()));
                                   }
                                    ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </form>
                </div> <!--##Person tab-->
                <!--Address tab-->
                <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
                    <form id="address-form" class="my-4 col-md-6" action="?controller=address&action=update"
                          method="POST">
                        <input name="relationId" type="hidden" class="form-control"
                               value="<?php echo $person->getRelationId(); ?>">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputStreet">Straatnaam</label>
                                <input name="street" type="text" class="form-control" id="inputStreet" placeholder="Straatnaam"
                                       value="<?php echo $address->getStreet(); ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputHousenumber">Huisnummer</label>
                                <input name="housenumber" type="number" class="form-control" id="inputHousenumber"
                                       placeholder=""
                                       value="<?php echo $address->getHousenumber(); ?>" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputHousenumberAddition">Toevoeging</label>
                                <input name="housenumberAddition" type="text" class="form-control"
                                       id="inputHousenumberAddition" placeholder=""
                                       value="<?php echo $address->getHousenumberAddition(); ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputZipcode">Postcode</label>
                                <input name="zipcode" type="text" class="form-control" id="inputZipcode" placeholder=""
                                       value="<?php echo $address->getZipcode(); ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCity">Stad</label>
                                <input name="city" type="text" class="form-control" id="inputCity" placeholder=""
                                       value="<?php echo $address->getCity(); ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputProvince">Provincie</label>
                                <input name="province" type="text" class="form-control" id="inputProvince"
                                       placeholder=""
                                       value="<?php echo $address->getProvince(); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputCountry">Land</label>
                                <select name="country" type="text" class="form-control" id="inputCountry" required>
                                    <?php
                                        printCountryOptions($countryList, $address->getCountry());
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddressType">Type adres</label>
                            <select name="addressType" type="text" class="form-control" id="inputAddressType" required>
                                <?php
                                if ($address->getAddressType() == 'Postadres'){
                                    echo "<option>Postadres</option>";
                                    echo "<option>Afleveradres</option>";
                                }

                                else if ($address->getAddressType() == 'Afleveradres'){
                                    echo "<option>Afleveradres</option>";
                                    echo "<option>Postadres</option>";
                                }
                                else {
                                    echo "<option></option>";
                                    echo "<option>Postadres</option>";
                                    echo "<option>Afleveradres</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddressValidFrom">Geldig vanaf</label>
                                <input name="validFrom" type="datetime-local" class="form-control"
                                       id="inputAddressValidFrom"
                                       placeholder=""
                                       value="<?php
                                       if($address->getValidFrom() == ''){
                                           echo date("Y-m-d\TH:i:s");
                                       }
                                       else {
                                           echo date( 'Y-m-d\TH:i:s', strtotime( $address->getValidFrom()));
                                       }
                                       ?>" step="1" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddressValidTo">Geldig tot</label>
                                <input name="validTo" type="datetime-local" class="form-control"
                                       id="inputAddressValidTo"
                                       placeholder=""
                                       value="" step="1">
                            </div>
                            <button type="submit" class="btn btn-primary">Opslaan</button>
                    </form>
                </div> <!-- Address tab-->
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function () {
        $('.navLinkAccount').addClass('active');
    });
</script>