<!DOCTYPE html>
<html>
<head>
    <script src="scripts/jquery.min.js"></script>
    <script src="scripts/jspdf.min.js"></script>
    <script>
        $(function(){
            var doc = new jsPDF();
            var specialElementHandlers = {
                '#editor': function (element, renderer) {
                    return true;
                }
            };

            $('#cmd').click(function () {

                var table = tableToJson($('#StudentInfoListTable').get(0))
                var doc = new jsPDF('p','pt', 'a4', true);
                doc.cellInitialize();
                $.each(table, function (i, row){
                    console.debug(row);
                    $.each(row, function (j, cell){
                        doc.cell(10, 50,120, 50, cell, i);  // 2nd parameter=top margin,1st=left margin 3rd=row cell width 4th=Row height
                    })
                })


                doc.save('sample-file.pdf');
            });
            function tableToJson(table) {
                var data = [];

                // first row needs to be headers
                var headers = [];
                for (var i=0; i<table.rows[0].cells.length; i++) {
                    headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi,'');
                }


                // go through cells
                for (var i=0; i<table.rows.length; i++) {

                    var tableRow = table.rows[i];
                    var rowData = {};

                    for (var j=0; j<tableRow.cells.length; j++) {

                        rowData[ headers[j] ] = tableRow.cells[j].innerHTML;

                    }

                    data.push(rowData);
                }

                return data;
            }
        });
    </script>
</head>
<body>
<div id="table">
    <table id="StudentInfoListTable">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Track</th>
            <th>S.S.C Roll</th>
            <th>S.S.C Division</th>
            <th>H.S.C Roll</th>
            <th>H.S.C Division</th>
            <th>District</th>

        </tr>
        </thead>
        <tbody>

        <tr>
            <td>alimon  </td>
            <td>Email</td>
            <td>1</td>
            <td>2222</td>
            <td>as</td>
            <td>3333</td>
            <td>dd</td>
            <td>33</td>
        </tr>
        </tbody>
    </table>
    <button id="cmd">Submit</button>
</body>
</html>