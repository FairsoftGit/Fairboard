$( document ).ready(function() {


    $('#accountTable').on('click', ".accountBtnDelete", function(){
        var row = $(this).closest('tr');
        deleteAccount(row);
    });

    $('#accountTable').on('click', "#accountBtnAdd", function(){
        addAccount();
    });

    $('#accountTable').on('click', "#accountBtnSave", function(){
        var row = $(this).closest('tr');
        saveAccount(row);
    });

    document.querySelector('#myInput').addEventListener('keyup', filterAccountTable, false);
});

function loadDropdownData(event){
    
    $(".dropdown-menu").empty();
    $.ajax({
        method: "GET", url: "getAccounts.php",

    }).done(function (data) {
        var result = $.parseJSON(data);
        var tableRows = "";
        //from result create a string of data and append to the div
        $.each(result, function (key, value) {
            tableRows += '<a class="dropdown-item" href="#">' + value['username'] + '</a>';
        });
        $(".dropdown-menu").append(tableRows);
    });
}

function getAllAccounts(){
    $.ajax({
        method: "GET", url: "?controller=account&action=index",

    }).done(function (data) {
        var result = $.parseJSON(data);
        var tableRows = "";
        //from result create a string of data and append to the div
        $.each(result, function (key, value) {

            tableRows += '<tr class="table-row"> ' +
                '   <td><input type="checkbox" class="checkthis" /></td>' +
                '   <td class="accountNumber"> ' + value['accountNumber'] + ' </td>' +
                '   <td> ' + value['username'] + '</td> ' +
                '   <td> <button data-placement="top" data-toggle="tooltip" title="Delete" class="AccountBtnDelete btn btn-danger btn-xs"><span class="fa fa-trash"></span></button> </td> ' +
                '   </tr>';

        });
        $('#accountTable').find('tbody:last').append(tableRows).hide().fadeIn();
        $("[data-toggle=tooltip]").tooltip();
    });
}

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

function addAccount(){

    var newRow = $("<tr>");
    var cols = "";

    var collEmpty = '<td></td>';
    var collUsername = '<td class="username" contenteditable="true" >test</td>';
    var collDeleteBtn = '<td><button data-placement="top" data-toggle="tooltip" title="Delete" class="accountBtnDelete btn btn-danger btn-xs"><span class="fa fa-trash"></span></button></td>';
    var collSaveBtn  = '<td><button data-placement="top" data-toggle="tooltip" title="Save" class="accountBtnSave btn btn-primary btn-xs"><span class="fa fa-floppy-o"></span></button></td>';
    cols += collEmpty + collUsername + collDeleteBtn + collSaveBtn;
    newRow.append(cols);
    $("#accountTable").prepend(newRow);
}

function deleteAccount(row){
    var username = row.find(".username").html();
    $.post("?controller=account&action=delete",
        {
            username: username
        },
        function(){
            row.fadeOut( function() {
            row.remove();
        });
    });
}

function saveAccount(row){
    var username = row.find(".username").html();
    $.post("?controller=account&action=save",
        {
            username: username
        },
        function(){
            //ToDo btn save disabled content editable false
        });
}

function getAllRoles(){
    $.ajax({
        method: "GET", url: "getRoles.php",
    }).done(function (data) {
        var result = $.parseJSON(data);
        var tableRows = "";
        //from result create a string of data and append to the div
        $.each(result, function (key, value) {

            tableRows += '<tr class="table-row"> ' +
                '   <td class="roleId"> ' + value['role_id'] + ' </td>' +
                '   <td> ' + value['role_name'] + '</td> ' +
                '   <td> <button data-placement="top" data-toggle="tooltip" title="Delete" class="roleBtnDelete btn btn-danger btn-xs"><span class="fa fa-trash"></span></button> </td> ' +
                '   </tr>';

        });
        $('#roleTable').find('tbody:last').append(tableRows).hide().fadeIn();
        $("[data-toggle=tooltip]").tooltip();
    });
}

function deleteRole(row){
    var roleId = row.find(".roleId").html();
    $.post("deleteRole.php",
        {
            roleId: roleId
        },
        function(data, status){
            if(status == 'success')
            {
                row.fadeOut( function() {
                    row.remove();
                });
            }
        });
}

function filterRoleTable(event) {
    var filter = event.target.value.toUpperCase();
    var rows = document.querySelector("#roleTable tbody").rows;

    for (var i = 0; i < rows.length; i++) {
        var firstCol = rows[i].cells[0].textContent.toUpperCase();
        var secondCol = rows[i].cells[1].textContent.toUpperCase();
        if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}