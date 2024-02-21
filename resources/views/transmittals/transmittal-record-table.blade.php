<style>
    .table-size {
        width: 50%;
    }
    .bold-address {
    font-weight: bold;
    text-align: left;
    line-height: 5px;
    }


    .bold-date {
        font-weight: bold;
        text-align: left;
        line-height: 5px;
    }

    .bold-addressee {
        font-weight: bold;
        font-size: 24px;
        line-height: 20px;
    }

    .labels-address {
        color: #9F9F9F;
    }

    .labels-addressee {
        color: #9F9F9F;
        margin-bottom: 10px;
    }

    .labelsdate {
        color: #9F9F9F;
        text-align: left;
        line-height: 20px;
        padding-top: 5px;
    }
    
    .highlight {
        background: linear-gradient(90deg, #0026C8, #2C54FF); 
        border-radius: 10px;
        color: #FFFFFF;
        font-size: 19px;
        padding: 4px 6px;
    }

    .abbrev {
    border: 1px;
    font-size: 31px;
    font-family: 'ABC Diatype Bold', sans-serif;
    background: linear-gradient(45deg, #0026C8, #2C54FF);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

    .secondary {
        color: #909090;
        font-size: 20px;
    }

    .tracking {
    padding: 10px;
    }   

    .rounded-container {
        border: 1px solid #ccc; 
        border-radius: 20px; 
        padding-top: 15px;
        padding-bottom: 15px;
        padding-right: 0px;
        padding-left: 15px; 
        background-color: #ffffff; 
    }

    .custom-line {
    border: 90px; 
    margin-top: 20px; 
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
    border-radius: 10px; 
    }

    .rounded-entries .rounded-entry {
    border-radius: 15px; 
    padding: 7px; 
    background-color: #FFFFFF;
    }

    .fa-envelope {
        font-size: 29px;
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

    <!-- left side column -->
    <!-- left side column -->
    <div class="row mt-3">
        <div class="col-md-4">
        <div class="rounded-container">
            <p>
                <span class="tracking">Tracking Number </span>
                <span class="bold highlight">{{ $records->mailTrackNum }}</span>
            </p>
            </div>

            <p class="labelsdate"><br />Date Posted</p>
            <p><span class="bold-date">{{ $records->date }}</span></p>
            <hr class="custom-line" /><br>

            <p class="labels-address">Address<br></p>
                <span class="bold-address">
                    {{ $addressee->address }}<br>
                    {{ $addressee->city }},
                    {{ $addressee->province }}<br>
                    {{ $addressee->zip }}
                </span>
            
        </div>

    <!-- right side column -->
    <div class="col-md-7">

    <p class="labels-addressee">Addressee<br /></p>
    <p>
        <span class="bold-addressee">
             <span class="abbrev"><i class="fa-solid fa-envelope"></i> {{ $addressee->abbrev }}</span> <br>
                {{ $addressee->name_primary }} <br>
        </span>
            <span class="secondary">{{ $addressee->name_secondary }}</span>
    
</p>

        
            <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row mt-5">
                <div class="col-md-12">

        <!-- search bar -->

        <!-- search bar -->
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search RRRTN">
                        <button class="btn btn-outline-success" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" class="form-control" placeholder="Search RRRTN">
                        <button class="btn btn-outline-success" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-24">

        <!-- table -->
        
    <div class="container-fluid">

        <!-- table -->
        
    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="rounded-entries">
                <table class="table table-size mt-4">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Items</th>
                            <th scope="col">RRR Tracking Numbers</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                @if ($rrt_n->isEmpty())
                <tr>
                    <th>Empty Record</th>
                    <td>No RRRTN Found</td>
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
                @if ($rrt_n->isEmpty())
                <tr>
                    <th>Empty Record</th>
                    <td>No RRRTN Found</td>
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
    </div>
</div>


        <table id="example" class="table table-striped " cellspacing="0" width="90%">
            <thead class="text-center">
                <tr>
                    <th scope="col">Items</th>
                    <th scope="col">Items</th>
                    <th scope="col">RRR Tracking Numbers</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @if ($rrt_n->isEmpty())
                <tr>
                    <th>Empty Record</th>
                    <td>No RRRTN Found</td>
                    <th>Empty Record</th>
                    <td>No RRRTN Found</td>
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
    // $(document).ready(function() {
    //     $('#transmittalstable').DataTable({
    //         "language": {
    //             "search": "search" // Customize search placeholder
    //         }
    //     });

    //     $('#transmittalstable').css('padding-top', '20px');
    // });
    
</script>



