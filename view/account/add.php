<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <div class="row">
        <div class="col-md-12">
            <a href="?controller=account&action=index" data-placement="top" data-toggle="tooltip" title="Terug" class="btn btn-primary btn-lg" role="button" aria-pressed="true"><span class="fa fa-arrow-left"></span> Terug</a>
            <h2 class="my-4">Nieuw account</h2>
            <form class="my-4">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputUsername">Gebruikersnaam</label>
                        <input type="text" class="form-control" id="inputUsername" placeholder="Username" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox"> Check me out
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
    </div>
    </div>
</main>
<script>
    $( document ).ready(function() {
        $('.navLinkAccount').addClass('active');
    });
</script>