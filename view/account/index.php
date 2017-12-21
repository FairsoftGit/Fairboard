<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <div class="row">
        <div class="col-md-12">
            <h2>Accounts</h2>
            <div class="input-group my-2">
                <span class="input-group-addon" id="search-Account-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                <input id="searchAccountInput" type="text" class="form-control" placeholder="Zoeken" aria-label="SearchAccounts" aria-describedby="search-Account-addon">
            </div>
            <div class="table-responsive">
                <table id="accountTable" class="table table-dark table-striped table-hover">
                    <thead>
                    <tr>
                        <th><button id="accountBtnAdd" data-placement="top" data-toggle="tooltip" title="Add" class="btn btn-success btn-xs"><span class="fa fa-plus"></span></button></th>
                        <th>Gebruikersnaam</th>
                        <th>Actief</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($accounts as $account) { ?>
                            <tr class="table-row">
                                <td></td>
                                <td class="username"><?php echo $account->getUsername();?></td>
                                <td class="suspended"><?php echo $account->getSuspended();?></td>
                                <td><button data-placement="top" data-toggle="tooltip" title="Edit" class="accountBtnEdit btn btn-primary btn-xs"><span class="fa fa-pencil"></span></button></td>
                                <td><button data-placement="top" data-toggle="tooltip" title="Suspend" class="accountBtnSuspend btn btn-danger btn-xs"><span class="fa fa-trash"></span></button></td>
                            </tr>
                        <script>
                            $('#accountTable tbody').find('tr:last').hide().fadeIn();
                        </script>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>
<script>
    $( document ).ready(function() {
        $('.navLinkAccount').addClass('active');
    });
</script>
<script src="js/account.js"></script>