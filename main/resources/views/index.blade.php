<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="./assets/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="./assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/datatables/media/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="row d-flex align-items-center">
        <div class="col-10">
            <div>
                <div class="table-responsive">
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Age</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./assets/datatables/media/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var dataTableColumnDefinitions = [
                {
                    "targets": 0, "data": "PersonID", "sortable": true
                },
                {
                    "targets": 1, "data": "FirstName", "sortable": true
                },
                {
                    "targets": 2, "data": "LastName", "sortable": true
                },
                {
                    "targets": 3, "data": "Age", "sortable": true
                },
                {
                    "targets": 4, "data": "City", "sortable": true
                },
                {
                    "targets": 5, "data": "Country", "sortable": true
                },
                {
                    "targets": 6,
                    "render": function(data,type,row,meta){
                        return `<div>${row.PersonID}</div>`
                    },
                    "sortable": false,
                    "searchable": false
                },
            ];
            
            var dataTableOptions = {
                "paging": true,
                "processing": true,
                // "scrollY": "350px",
                "lengthMenu": [[10, 25], [10, 25]], // Set the options for the number of records per page
                "pageLength": 10,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "serverSide": true,
                "columnDefs": dataTableColumnDefinitions,
                "ajax": {
                    url: 'view/persons',
                    type: "POST",
                    dataType: 'json',
                    error: function(){
                        console.warn('error');
                    },
                    initComplete: function(settings, json) {
                        console.log(json);
                    }
                }
            };
            var myTable = $("#myTable").DataTable(dataTableOptions);
        });
    </script>
</body>
</html>