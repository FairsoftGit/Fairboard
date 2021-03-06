<nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="\fairboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Account</li>
    </ol>
</nav>
<button type="button" class="btn btn-default btn-filter" data-target="all" data-placement="top" data-toggle="tooltip"
        title="Filter">Alles
</button>
<button type="button" class="btn btn-success btn-filter" data-target="1" data-placement="top" data-toggle="tooltip"
        title="Filter">Actief
</button>
<button type="button" class="btn btn-danger btn-filter" data-target="0" data-placement="top" data-toggle="tooltip"
        title="Filter">Inactief
</button>
<div class="input-group my-2">
    <span class="input-group-addon" id="search-Account-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
    <input id="searchAccountInput" type="text" class="form-control" placeholder="Zoeken" aria-label="SearchAccounts"
           aria-describedby="search-Account-addon">
</div>
<div class="table-responsive">
    <table id="accountTable" class="table table-dark table-striped table-hover table-filter">
        <thead>
        <tr>
            <th><a href="?controller=Account&action=add" data-placement="top" data-toggle="tooltip"
                   title="Toevoegen" class="btn btn-success btn-xs" role="button" aria-pressed="true"><span
                            class="fa fa-plus"></span></a></th>
            <th>Relatienummer</th>
            <th onclick="w3.sortHTML('#accountTable','tbody tr', 'td:nth-child(3)')" style="cursor:pointer">
                Gebruikersnaam
            </th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($accounts

                       as $account) { ?>
            <tr class="table-row" data-status="<?php echo $account->getStatus(); ?>">
                <td></td>
                <td class="relationId"><?php echo $account->getRelationNumber(); ?></td>
                <td class="username"><?php echo $account->getUsername(); ?></td>
                <td class="active">
                    <?php echo($account->getStatus() == 1 ? '<a href="?controller=Account&action=toggleStatus&username=' . $account->getUsername() . '&status=' . $account->getStatus() . '" role="button" data-placement="top" data-toggle="tooltip" title="Toggle" class="btn btn-xs btn-success"><span class="fa fa-check"></span></a>'
                        : '<a href="?controller=Account&action=toggleStatus&username=' . $account->getUsername() . '&status=' . $account->getStatus() . '" role="button" data-placement="top" data-toggle="tooltip" title="Toggle" class="btn btn-xs btn-danger"><span class="fa fa-ban"></span></a>');
                    ?>
                </td>
                <td class="updateBtn">
                    <a href="?controller=Account&action=edit&relationNumber=<?php echo $account->getRelationNumber(); ?>"
                       data-placement="top" data-toggle="tooltip" title="Aanpassen" class="btn btn-primary btn-xs"
                       role="button" aria-pressed="true">
                        <span class="fa fa-pencil"></span>
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
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