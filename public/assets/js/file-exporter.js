$(document).ready(function() {
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Users
    $(".saveAsCSV").click(function() {
        exportCSV("Users.csv");
    });

    $(".saveAsExcel").click(function() {
        exportExcel("Users.xlsx");
    });

     // Appointment
     $(".appSaveAsCSV").click(function() {
        exportCSV("Appointment.csv");
    });

    $(".appSaveAsExcel").click(function() {
        exportExcel("Appointment.xlsx");
    });

    // Appointment Request
    $(".reqSaveAsCSV").click(function() {
        exportCSV("Appointment Request.csv");
    });

    $(".reqSaveAsExcel").click(function() {
        exportExcel("Appointment Request.xlsx");
    });
    
    // Medical Records
    $(".medSaveAsCSV").click(function() {
        exportCSV("Medical Records.csv");
    });

    $(".medSaveAsExcel").click(function() {
        exportExcel("Medical Records.xlsx");
    });

    // User History
    $(".hisSaveAsCSV").click(function() {
        exportCSV("History.csv");
    });

    $(".hisSaveAsExcel").click(function() {
        exportExcel("History.xlsx");
    });

    // Function to export CSV
    function exportCSV(filename) {
        var csv = [];
        var rows = $("#mytable").find('tr');

        rows.each(function(index, row) {
            var rowData = [];
            $(row).find('td, th').each(function(index, cell) {
                if ($(cell).index() !== $(row).find('td, th').length - 1) {
                    var cellText = $(cell).text().trim().replace(/"/g, '""');
                    rowData.push('"' + cellText + '"');
                }
            });
            csv.push(rowData.join(','));
        });

        var csvContent = "data:text/csv;charset=utf-8," + csv.join('\n');
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", filename);
        document.body.appendChild(link);
        link.click();
    }

    // Function to export Excel
    function exportExcel(filename) {
        var tableClone = $("#mytable").clone();
        tableClone.find("th:last-child, td:last-child").remove();
        var workbook = XLSX.utils.book_new();
        var worksheet = XLSX.utils.table_to_sheet(tableClone[0]);

        workbook.SheetNames.push("Test");
        workbook.Sheets["Test"] = worksheet;

        return XLSX.writeFile(workbook, filename);
    }
});