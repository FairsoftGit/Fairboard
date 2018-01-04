<div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="\Fairboard">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Account</li>
                </ol>
            </nav>
            <h2>Accounts</h2>
            <button type="button" class="btn btn-default btn-filter" data-target="all">Alles</button>
            <button type="button" class="btn btn-success btn-filter" data-target="1">Actief</button>
            <button type="button" class="btn btn-danger btn-filter" data-target="0">Inactief</button>
            <div class="input-group my-2">
                <span class="input-group-addon" id="search-Account-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                <input id="searchAccountInput" type="text" class="form-control" placeholder="Zoeken" aria-label="SearchAccounts" aria-describedby="search-Account-addon">
            </div>
            <div class="table-responsive">
                <table id="accountTable" class="table table-dark table-striped table-hover table-filter">
                    <thead>
                    <tr>
                        <th><a href="?controller=account&action=add" data-placement="top" data-toggle="tooltip" title="Toevoegen" class="btn btn-success btn-xs" role="button" aria-pressed="true"><span class="fa fa-plus"></span></a></th>
                        <th>Relatienummer</th>
                        <th onclick="w3.sortHTML('#accountTable','tbody tr', 'td:nth-child(3)')" style="cursor:pointer">Gebruikersnaam</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($accounts as $account) { ?>
                    <tr class="table-row" data-status="<?php echo $account->getStatus();?>">
                        <td></td>
                        <td class="relationId"><?php echo $account->getRelationNumber();?></td>
                        <td class="username"><?php echo $account->getUsername();?></td>
                        <td class="active">
                            <?php echo ($account->getStatus() == 1 ? '<a href="?controller=account&action=toggleStatus&username='.$account->getUsername().'&status='.$account->getStatus().'" role="button" data-placement="top" data-toggle="tooltip" title="Toggle" class="btn btn-xs btn-success"><span class="fa fa-check"></span></a>'
                                : '<a href="?controller=account&action=toggleStatus&username='.$account->getUsername().'&status='.$account->getStatus().'" role="button" data-placement="top" data-toggle="tooltip" title="Toggle" class="btn btn-xs btn-danger"><span class="fa fa-ban"></span></a>');
                            ?>
                        </td>
                        <td class="updateBtn">
                            <a href="?controller=account&action=edit&relationNumber=<?php echo $account->getRelationNumber();?>" data-placement="top" data-toggle="tooltip" title="Aanpassen" class="btn btn-primary btn-xs" role="button" aria-pressed="true">
                                <span class="fa fa-pencil"></span>
                            </a>
                        </td>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script>
    $( document ).ready(function() {
        document.querySelector('#searchAccountInput').addEventListener('keyup', filterAccountTable, false);

        $('.btn-filter').on('click', function () {
            var $target = $(this).data('target');
            if ($target != 'all') {
                $('tbody tr').css('display', 'none');
                $('tbody tr[data-status="' + $target + '"]').fadeIn();
            } else {
                $('tbody tr').css('display', 'none').fadeIn('slow');
            }
        });

        function filterAccountTable(event) {
            var filter = event.target.value.toUpperCase();
            var rows = document.querySelector("#accountTable tbody").rows;

            for (var i = 0; i < rows.length; i++) {
                var firstCol = rows[i].cells[1].textContent.toUpperCase();
                var secondCol = rows[i].cells[2].textContent.toUpperCase();
                if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    });
</script>