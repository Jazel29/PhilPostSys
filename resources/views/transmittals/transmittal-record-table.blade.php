<style>
    .table-size {
        width: 50%;
    }
    .bold {
        font-weight: bold;
        text-align: left;
    }

    .bold-addressee {
        font-weight: bold;
        font-size: 24px;
    }
    
    .labels {
        text-align: left;
    }
    
    .highlight {
    background: linear-gradient(90deg, #0026C8, #2C54FF); 
    border-radius: 10px;
    color: #FFFFFF;
    font-size: 19px;
    padding: 4px 6px;
    }

    .tracking {
    padding: 10px;
    }   

    .rounded-container {
    border: 1px solid #ccc; 
    border-radius: 20px; 
    padding: 20px; 
    background-color: #ffffff; 
    }

    .custom-line {
    border: 90px; /* Remove default border */
    margin-top: 20px; /* Adjust margin top as needed */
    }

    .form-control {
    border-radius: 15px;
    }

    .btn-outline-success {
        border-radius: 15px;
    }

    .table-size {
    width: 100%;
    border-collapse: collapse; /* Ensure borders collapse properly */
    }

    .table-size thead {
    border-bottom: 2px solid #303030;
    padding: 5px;
    }

    .text-center{
    border-bottom: 1px;
    }  

    .table-size tbody tr {
    border-radius: 10px; /* Adjust the radius value as needed */
    }

    .rounded-entries .rounded-entry {
    border-radius: 15px; /* Adjust the border radius as needed */
    padding: 7px; /* Adjust the padding as needed */
    background-color: #FFFFFF; /* Adjust the background color as needed */
}

</style>

<div class="container">
    <div class="row mt-3">
        <div class="col">
            <h1 class="display-6">Transmittal Record</h1>
        </div>
        <div class="col text-right">
            <button class="btn btn-outline-success" onclick="exportToExcel()">
            &nbsp;<i class="fa-solid fa-table"></i> &nbsp; Export as Excel
            </button>
</div>

    <!-- Left side column -->
    <div class="row mt-3">
        
    <!-- Left side column -->
    <div class="col-md-4">
        <div class="rounded-container">
            <p>
                <span class="tracking">Tracking Number</span>
                <span class="bold highlight">{{ $records->mailTrackNum }}</span>
            </p>
        </div>
            <p class="labels"><br>Date Posted :</p>
            <p><span class="bold">{{ $records->date }}</span></p>
            <hr class="custom-line">

            <p class="labels"><br>Address :</p>
            <p><span class="bold">{{ $records->recieverAddress }}</span><br></p>
        
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
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search RRR Tracking Number">
                    <button class="btn btn-outline-success" type="button">Search</button>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped " cellspacing="0" width="90%">
            <thead class="text-center">
                <tr>
                    <th scope="col">Items</th>
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
                
                </div>
            </tbody>
        </table>
    </div>
</div>
<div class="modal" id="exportStatusPrompt" tabindex="-1">
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
        <a href="" id="downloadLink">Download Excel</a>
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
                $('#promptText').text('Excel exported successfully!');
                $('#exportStatusPrompt').modal('show');

                // Assuming response.path contains the file path
                var filePath = response.path;

                // Update the href attribute of the downloadLink
                $('#downloadLink').attr('href', "{{ url('/download-excel') }}" + filePath);

                console.log("/download-excel" + response.path);
                console.log('Excel exported successfully');
            },
            error: function (error) {
                // Optional: Handle error response, if needed
                console.error('Error exporting Excel:', error);
            }
        });
    }
    // $(document).ready(function() {
    //     $('#transmittalstable').DataTable({
    //         "language": {
    //             "search": "search" // Customize search placeholder
    //         }
    //     });

    //     $('#transmittalstable').css('padding-top', '20px');
    // });
    
</script>



