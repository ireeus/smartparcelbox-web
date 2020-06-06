////ROUTINES FOR SCHEDULE SEARCH START////
document.getElementById("scheduleListSearch").addEventListener("keyup", (event) => {
    var input = document.getElementById("scheduleListSearch");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("scheduleListTable");
    var row = table.rows;
    for (var i = 1; i < row.length; i++) {
        var col00 = row[i].cells[0].textContent.toUpperCase();
        var col01 = row[i].cells[1].textContent.toUpperCase();
        var col02 = row[i].cells[2].textContent.toUpperCase();
        var col03 = row[i].cells[3].textContent.toUpperCase();
        var col04 = row[i].cells[4].textContent.toUpperCase();
        var col05 = row[i].cells[5].textContent.toUpperCase();
        if (col00.indexOf(filter) > -1 || col01.indexOf(filter) > -1 || col02.indexOf(filter) > -1 || col03.indexOf(filter) > -1 || col04.indexOf(filter) > -1 || col05.indexOf(filter) > -1) {
            row[i].style.display = "";
        } else {
            row[i].style.display = "none";
        }
    }
})
////ROUTINES FOR SCHEDULE SEARCH END////
