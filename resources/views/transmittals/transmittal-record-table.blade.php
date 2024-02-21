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
    padding-top: 15px;
    padding-bottom: 15px;
    padding-right: 0px;
    padding-left: 15px; 
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
                    {{ $addressee->name_secondary }}, 
                        {{ $addressee->name_primary }}
                                    </span>
            </p>
        </div>

            <p class="labels"><br />Date Posted :</p>
            <p><span class="bold">{{ $records->date }}</span></p>
            <hr class="custom-line" /><br>

            <p class="labels">Address : <br>
                <span class="bold">
                    {{ $addressee->address }},
                        {{ $addressee->zip }} 
                        {{ $addressee->city }},
                        {{ $addressee->province }}
                                    </span>
            </p>
        </div>

    <!-- right side column -->
    <div class="col-md-8">

            <p class="labels">Addressee : <br /></p>
            <p><span class="bold-addressee">
                    {{ $addressee->name_primary }}, 
                    {{ $addressee->name_secondary }}
                </span></p>
        
            <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row mt-5">
                <div class="col-md-12">

        <!-- search bar -->
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search RRRTN">
                        <button class="btn btn-outline-success" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-24">

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
                </table>
            </div>
        </div>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        <table id="example" class="table table-striped " cellspacing="0" width="90%">
            <thead class="text-center">
                <tr>
                    <th scope="col">Items</th>
                    <th scope="col">RRR Tracking Numbers</th>
                    <th>Action</th>
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
                        <td>
                            <form method="POST" action="{{ route('return-cards.destroy', ['id' => $rrt->id]) }}" accept-charset="UTF-8" style="" class="">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-warning" title="remove rrtn" onclick="return confirm('Confirm delete?')"> Remove</button>
                            </form>
                            
                        </td>
                    </tr>
                    @endforeach
                @endif
                
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

<div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Add new RRTN</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/addReturn" class="m-3" method="POST">
            @csrf
            <div class="tracknum m-3">
                <label for="tracknumber">Track Number:</label>
                <input name="truckNumMail" class="rounded" type="text" value="{{ $records->mailTrackNum }}" readonly>
            </div>
            <div class="rrtn m-3">
                <label for="rrtNumber">RRT Number: </label>
                <input type="text" class="form-control rounded" id="last-barcode" placeholder="Transmittal_Barcode" name="trackingNum">
            </div>
            <div class="sub">
                <button class="btn btn-primary" type="submit">Add</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

        //Prepare data for sending to the server
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
    var barcode = '';
        var interval;
        document.addEventListener('keydown', function(evt) {
            if (interval)
                clearInterval(interval);
            if (evt.code == 'Enter') {
                if (barcode)
                    handleBarcode(barcode);
                barcode = '';
                return;
            }
            if (evt.key != 'Shift')
                barcode += evt.key;
            interval = setInterval(() => barcode = '', 20);
        });

        function handleBarcode(scanned_barcode) {
            document.querySelector('#last-barcode').value = scanned_barcode;
        }
   
    
</script>



