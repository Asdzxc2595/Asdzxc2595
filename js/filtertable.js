
function filterTable() {
    var input, filter, table, tr, tdName, tdId, i, txtValueName, txtValueId;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.getElementById("productTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        tdId = tr[i].getElementsByTagName("td")[0];  
        tdName = tr[i].getElementsByTagName("td")[1]; 

        if (tdId || tdName) {
            txtValueId = tdId.textContent || tdId.innerText;
            txtValueName = tdName.textContent || tdName.innerText;
            if (txtValueId.toLowerCase().indexOf(filter) > -1 || txtValueName.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            }
        }
    }
}


function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("productTable");
    switching = true;
    dir = "asc";

    while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            var xValue = x.innerHTML.toLowerCase();
            var yValue = y.innerHTML.toLowerCase();

            if (n === 0 || n === 8) {
                xValue = parseFloat(x.innerHTML) || 0;
                yValue = parseFloat(y.innerHTML) || 0;
            } else if (n === 7) {
                xValue = new Date(x.innerHTML);
                yValue = new Date(y.innerHTML);
            }

            if (dir === "asc") {
                if (xValue > yValue) {
                    shouldSwitch = true;
                    break;
                }
            } else if (xValue < yValue) {
                shouldSwitch = true;
                break;
            }
        }

        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount === 0 && dir === "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

