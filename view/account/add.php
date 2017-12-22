<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <div class="row">
        <div class="col-md-12">
            <a href="?controller=account&action=index" data-placement="top" data-toggle="tooltip" title="Terug"
               class="btn btn-primary btn-lg" role="button" aria-pressed="true"><span class="fa fa-arrow-left"></span>
                Terug</a>
            <h2 class="my-4">Nieuw account</h2>
            <form class="my-4">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputUsername">Gebruikersnaam</label>
                        <input type="text" class="form-control" id="inputUsername" placeholder="Username"
                               value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword">Wachtwoord</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password"
                               value="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputStreet">Straat</label>
                        <input type="text" class="form-control" id="inputStreet" placeholder=""
                               value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputHousenumber">Huisnummer</label>
                        <input type="text" class="form-control" id="inputHousenumber" placeholder=""
                               value="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputZipcode">Postcode</label>
                        <input type="text" class="form-control" id="inputZipcode" placeholder=""
                               value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">Stad</label>
                        <input type="text" class="form-control" id="inputCity" placeholder=""
                               value="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputProvince">Provincie</label>
                        <input type="text" class="form-control" id="inputProvince" placeholder=""
                               value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCountry">Land</label>
                        <input type="text" class="form-control" id="inputCountry" placeholder=""
                               value="">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Opslaan</button>
            </form>
        </div>
    </div>
</main>
<script>
    $(document).ready(function () {
        $('.navLinkAccount').addClass('active');
    });
</script>