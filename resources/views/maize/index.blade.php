@extends('layouts.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
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
                    <th>Date</th>
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
                            tbody += '<td><img src="{{ asset('storage') }}/' + value.image + '" alt="Image" class="img-fluid" width="100" height="200"></td>';
                            
                            // Convert height to 2 decimal places
                            var heightInCm = parseFloat(value.height).toFixed(2);
                            tbody += '<td>' + heightInCm + ' cm</td>';

                            // Convert thickness from cm to mm and fix to 2 decimal places
                            var thicknessInCm = parseFloat(value.thickness.split(' ')[0]);
                            var thicknessInMm = (thicknessInCm * 10).toFixed(2);
                            tbody += '<td>' + thicknessInMm + ' mm</td>';

                            tbody += '<td>' + value.color + '</td>';
                            tbody += '<td>' + (value.defective ? 'Yes' : 'No') + '</td>';
                            tbody += '<td>' + value.deficiency + '</td>';
                            tbody += '<td>' + value.suggestion + '</td>';
                            
                            // Format date and time
                            var createdAt = new Date(value.created_at);
                            var formattedDate = createdAt.toLocaleDateString();
                            var formattedTime = createdAt.toLocaleTimeString();
                            tbody += '<td>' + formattedDate + ' ' + formattedTime + '</td>';
                            
                            tbody += '</tr>';
                        });
                        $('#maize-table tbody').html(tbody);
                    }
                });
            }

            fetchLatestData(); // Initial fetch

            // Fetch data every 5 seconds
            setInterval(fetchLatestData, 5000);
        });
    </script>
@endsection
