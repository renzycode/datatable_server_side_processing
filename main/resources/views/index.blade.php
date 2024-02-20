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
    <div class="row d-flex justify-content-center">
        <div class="col-10">
            <div class="border p-4 m-4">
                <div class="col-3 p-2 ps-0 d-flex">
                    <input class="input form-control my-1" type="text" id="search-input" placeholder="First Name">
                    <button id="search" type="button" class="ms-2 my-1 btn btn-success">Search</button>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th>PersonID</th>
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
            let FirstName = '';
            console.log("Loading");
            let dataTableOptions = {
                "paging": true,
                "processing": true,
                "scrollY": "410px",
                "pageLength": 10,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "serverSide": true,
                "columnDefs": [
                    { "title": "PersonID", "targets": 0, "data": "PersonID", "sortable": true },
                    { "title": "FirstName", "targets": 1, "data": "FirstName", "sortable": true },
                    { "title": "LastName", "targets": 2, "data": "LastName", "sortable": true },
                    { "title": "Age", "targets": 3, "data": "Age", "sortable": true },
                    { "title": "City", "targets": 4, "data": "City", "sortable": true },
                    { "title": "Country", "targets": 5, "data": "Country", "sortable": true },
                    { "title": "Action", "targets": 6,
                    "render": function(data, type, row, meta) {
                            return `<div>${row.PersonID}</div>`;
                    },
                    "sortable": false,
                    "searchable": false
                    }
                ],
                "ajax": {
                    url: 'view/persons',
                    type: "POST",
                    dataType: 'json',
                    data: {
                        FirstName: FirstName
                    },
                    error: function(){
                        console.warn('error');
                        console.log("Loading Done");
                    }
                },
                initComplete: function(settings, json) {
                    console.log(json);
                    console.log("Loading Done");
                }
            };
            let myTable = $("#myTable").DataTable(dataTableOptions);
            $('#search').on('click', function() {
                console.log("Searching \nLoading");
                FirstName = $('#search-input').val();
                myTable.destroy();
                $('#myTable').empty();
                myTable.clear();
                dataTableOptions.ajax.data.FirstName = FirstName; // Update data object with new FirstName value
                myTable = $("#myTable").DataTable(dataTableOptions);
            });
        });
    </script>
</body>
</html>