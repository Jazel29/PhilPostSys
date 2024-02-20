<style>
    .table-size {
        width: 50%;
    }
    .bold {
        font-weight: bold;
        text-align: right;
    }
    .labels {
        text-align: right;
    }
</style>

<div class="container">
    <div class="d-flex">
        <div class="row mt-3">
            <h1 class="display-6">Transmittal Record</h1>
        </div>
    </div>
    
    <div class="row text-right">
        <div class="col">
            <button class="btn btn-outline-success" onclick="exportToExcel()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-6">
            <p>Tracking Number: <span class="bold">{{ $records->mailTrackNum }}</span></p>
        </div>
        <div class="col-6">
            <p class="labels">Date Posted: <span class="bold">{{ $records->date }}</span></p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-6">
            <p>Addressee: 
                <span class="bold">
                    {{ $addressee->name_primary }}, 
                    {{ $addressee->name_secondary }}
                </span>
            </p>
        </div>
        <div class="col-6">
            <p class="labels">Address: 
                <span class="bold">
                    {{ $addressee->address }},
                    {{ $addressee->zip }} 
                    {{ $addressee->city }},
                    {{ $addressee->province }}
                </span>
            </p>
        </div>
    </div>
    <div class="row mt-5">
        <div class="row mt-5">
            <div class="col-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-outline-success" type="button">Search</button>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped " cellspacing="0" width="90%">
            <thead class="text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">RRR Tracking Numbers</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @if ($rrt_n->isEmpty())
                <tr>
                    <th>Error</th>
                    <td>No RRTN Found</td>
                </tr>
                
                @else
                    @foreach ($rrt_n as $index => $rrt)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $rrt->returncard }}</td>
                    </tr>
                    @endforeach
                @endif
                
            </tbody>
        </table>
    </div>
</div>
<div class="modal" id="exportStatusPrompt" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Export Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="promptText"> </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <a href="" id="downloadLink"><button type="button" class="btn btn-outline-success">Download Excel</button></a>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').dataTable();
    } );
    function exportToExcel() {
        console.log('exportToExcel called');
        // Collect table data
        var tableData = [];

        // Loop through each row in the table body
        $('#example tbody tr').each(function () {
            // Find the 'td' elements within the current row
            var rowData = [];

            // Loop through each 'td' element in the current row
            $(this).find('td').each(function () {
                // Push the text content of each 'td' into the rowData array
                rowData.push($(this).text());
            });

            // Push the rowData array into the tableData array
            tableData.push(rowData);
        });

        // Prepare data for sending to the server
        var exportData = {
            records: {
                mailTrackNum: "{{ $records->mailTrackNum }}",
                date: "{{ $records->date }}",
                addresseePN: "{{ $addressee->name_primary }}",
                addresseeSN: "{{ $addressee->name_secondary }}",
                address: "{{ $addressee->address }}",
                zip: "{{ $addressee->zip }}",
                city: "{{ $addressee->city }}",
                province: "{{ $addressee->province }}"
            },
            rrtn: tableData.flat() // Flatten the array to store only the returncard values
        };

        // Use AJAX to trigger the controller function
        $.ajax({
            type: 'GET',
            url: '/export-to-excel',
            data: { exportData: JSON.stringify(exportData) },
            success: function (response) {
                $('#promptText').text('Excel exported successfully and is ready for download.');
                $('#exportStatusPrompt').modal('show');

                // Assuming response.path contains the file path
                var filePath = response.path;

                // Update the href attribute of the downloadLink
                $('#downloadLink').attr('href', "{{ url('/download-excel') }}" + filePath);
            },
            error: function (error) {
                // Optional: Handle error response, if needed
                $('#promptText').text('Excel export failed. Please try again.');
                console.error('Error exporting Excel:', error);
            }
        });
    }
    
</script>



