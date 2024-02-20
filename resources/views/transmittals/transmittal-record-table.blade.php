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

    .btn-primary-add {
        transform: translate(200, 300);
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
                    {{ $addressee->name_secondary }}, 
                        {{ $addressee->name_primary }}
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
        <div class="row mb-5">
            <div class="col"></div> <!-- This column will occupy the left space -->
            <div class="col-auto"> <!-- This column will display the content on the right side -->
                <div>
                    <div class="add">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add RRTN</button>
                    </div>
                </div>
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
                    <th scope="col">#</th>
                    <th scope="col">RRR Tracking Numbers</th>
                    <th>Action</th>
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



