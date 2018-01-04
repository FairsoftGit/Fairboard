<div class="col-md-12">
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="\fairboard">Home</a></li>
            <li class="breadcrumb-item"><a href="?controller=Account&action=index">Account</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nieuw</li>
        </ol>
    </nav>
    <h2 class="my-4">Nieuw account</h2>
    <form id="contact-form" class="my-4 col-md-6" action="?controller=Account&action=create"
          method="POST">
        <div class="form-check">
            <label class="form-check-label">
                <input name="status" type="checkbox"
                       class="form-check-input" checked>
                Status
            </label>
        </div>
        <div class="form-group">
            <label for="inputUsername">Gebruikersnaam</label>
            <input name="username" type="text" class="form-control" id="inputUsername"
                   placeholder="Gebruikersnaam"
                   value="" required>
        </div>
        <div class="form-group">
            <label for="inputPassword">Wachtwoord</label>
            <input name="password" type="password" class="form-control" id="inputPassword"
                   placeholder="Wachtwoord"
                   value="" required>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('.navLinkProduct').addClass('active');
    });
</script>