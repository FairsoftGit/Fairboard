$( document ).ready(function() {
    document.querySelector('#searchRoleInput').addEventListener('keyup', filterRoleTable, false);
});

function filterRoleTable(event) {
    var filter = event.target.value.toUpperCase();
    var rows = document.querySelector("#roleTable tbody").rows;

    for (var i = 0; i < rows.length; i++) {
        var firstCol = rows[i].cells[0].textContent.toUpperCase();
        //var secondCol = rows[i].cells[1].textContent.toUpperCase();
        if (firstCol.indexOf(filter) > -1) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}