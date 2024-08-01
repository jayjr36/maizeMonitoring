@extends('layouts.app')
@section('content')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> --}}

   
    <div class="container mt-4">
        <h3 class="mb-4 text-center">Maize Monitoring Data</h3>
        <table class="table table-striped table-bordered" id="maize-table">
            <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>Height</th>
                    <th>Thickness</th>
                    <th>Color</th>
                    <th>Defective</th>
                    <th>Deficiency</th>
                    <th>Suggestion</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated here by Ajax -->
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            function fetchLatestData() {
                $.ajax({
                    url: '{{ route("fetch.latest.data") }}',
                    method: 'GET',
                    success: function (data) {
                        var tbody = '';
                        $.each(data, function (key, value) {
                            tbody += '<tr>';
                            tbody += '<td><img src="' + value.image + '" alt="Image" class="img-fluid" width="100" height="200"></td>';
                            tbody += '<td>' + value.height + ' cm</td>';
                            tbody += '<td>' + value.thickness + ' cm</td>';
                            tbody += '<td>' + value.color + '</td>';
                            tbody += '<td>' + (value.defective ? 'Yes' : 'No') + '</td>';
                            tbody += '<td>' + value.deficiency + '</td>';
                            tbody += '<td>' + value.suggestion + '</td>';
                            tbody += '</tr>';
                        });
                        $('#maize-table tbody').html(tbody);
                    }
                });
            }

            fetchLatestData(); // Initial fetch

            // Fetch data every 5 seconds
            setInterval(fetchLatestData, 2000);
        });
    </script>
@endsection