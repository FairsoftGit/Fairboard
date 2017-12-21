$( document ).ready(function() {

    $('#accountTable').on('click', ".accountBtnSuspend", function(){
        var row = $(this).closest('tr');
        suspendAccount(row);
    });

    $('#accountTable').on('click', "#accountBtnAdd", function(){
        addAccount();
    });

    $('#accountTable').on('click', "#accountBtnSave", function(){
        var row = $(this).closest('tr');
        saveAccount(row);
    });
    document.querySelector('#searchAccountInput').addEventListener('keyup', filterAccountTable, false);
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

function suspendAccount(row){
    var username = row.find(".username").html();
    $.post("?controller=account&action=suspend",
        {
            username: username
        },
        function(){

            // row.fadeOut( function() {
            // row.remove();
            //});
        });
}

function saveAccount(row){
    var username = row.find(".username").html();
    $.post("?controller=account&action=save",
        {
            username: username
        },
        function(){
        });
}