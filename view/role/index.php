<div class="col-md-12">
    <h2>Roles</h2>
    <div class="input-group my-2">
        <span class="input-group-addon" id="searchRoleAddon"><i class="fa fa-search" aria-hidden="true"></i></span>
        <input id="searchRoleInput" type="text" class="form-control" placeholder="Zoeken" aria-label="SearchRole"
               aria-describedby="searchRoleAddon">
    </div>
    <div class="table-responsive table-container">
        <table id="roleTable" class="table table-dark table-striped table-hover">
            <thead>
            <tr>
                <th>Rol</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($roles as $role) { ?>
                <tr class="table-row">
                    <td class="role"><?php echo $role->getRoleName(); ?></td>
                </tr>
                <script>
                    $('#roleTable tbody').find('tr:last').hide().fadeIn();
                </script>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.navLinkRole').addClass('active');
    });
</script>
<script src="js/role.js"></script>