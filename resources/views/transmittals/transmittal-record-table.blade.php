<style>
    
    .table-size {
        width: 50%;
    }

    .bold-address {
    font-weight: bold;
    font-size: 15px;
    text-align: left;
    line-height: 1px;
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
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

    .secondary {
        color: #909090;
        font-size: 20px;
    }

    .tracking {
    padding: 11px;
    color: #9F9F9F;
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
    border: 1px #ccc; 
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
    border-collapse: collapse;
    }

    .table-size thead {
    border-bottom: 2px solid #303030;
    padding: 5px;
    }

    .rrt-cell {
        position: relative;
    }

    .text-center{
    border-bottom: 1px;
    }  

    .table-size tbody tr {
    border-radius: 10px; 
    }

    .hover-row:hover {
        background: linear-gradient(90deg, #0026C8, #2C54FF);
        color: #FFFFFF;
    }

    .caret {
        margin-right: 5px;
        display: none;
    }

    .hover-row:hover .caret {
        display: inline;
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
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="row mt-3">
    <!-- First Column -->
    <div class="col-md-3">
        <div class="rounded-container">
            <span class="tracking">Tracking Number</span>
            <br>&nbsp;&nbsp;&nbsp;<span class="bold highlight"><i class="fa-solid fa-caret-right"></i>&nbsp; {{ $records->mailTrackNum }} &nbsp;<i class="fa-solid fa-caret-left"></i></span>
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

    <!-- Second Column -->
    <div class="col-md-1">
    </div>

    <!-- Third Column -->
    <div class="col-md-8">
        <p class="labels-addressee">Addressee<br /></p>
        <span class="bold-addressee">
            <span class="abbrev"><i class="fa-solid fa-envelope"></i> {{ $addressee->abbrev }}</span>
            <br>{{ $addressee->name_primary }}
            <br><span class="secondary">{{ $addressee->name_secondary }}</span>
        </span>
        <div class="container-fluid">
            <div class="row mt-1">
                <!-- table -->
                <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-size mt-4" id="example">
                <thead class="text-center">
                    <tr>
                        <th scope="col-items">Items</th>
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
                            <tr class="hover-row">
                                <th scope="row-item">{{ $index + 1 }}</th>
                                <td><span class="caret"><i class="fa-solid fa-caret-right"></i></span>&nbsp; {{ $rrt->returncard }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
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
    });

    // (kevin) start - frontend javascript for table //

    $('#example').on('length.dt', function (e, settings, len) {
                // Modify length select dropdown items
                var select = $(this).closest('.dataTables_wrapper').find('div.dataTables_length select');
                select.removeClass('table'); // Remove any existing custom class
                select.addClass('your-custom-class'); // Add your custom class to the select dropdown
            });

    $(document).ready(function() {
    $(".hover-row").hover(
        function() {
            $(this).find('.caret').css('display', 'inline');
        },
        function() {
            $(this).find('.caret').css('display', 'none');
        }
    );
    });

    // (kevin) start - frontend javascript for table //

    function exportToExcel() {
        console.log('exportToExcel called');
        var dataTable = $('#example').DataTable();
        dataTable.page.len(-1).draw();
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
                $('#promptText').text('Excel exported successfully and is ready for download.');
                $('#exportStatusPrompt').modal('show');

                var filePath = response.path;
                $('#downloadLink').attr('href', "{{ url('download-excel') }}" + filePath);
            },
            error: function (error) {
                // Optional: Handle error response, if needed
                $('#promptText').text('Excel export failed. Please try again.');
                console.error('Error exporting Excel:', error);
            }
        });
    }
    
</script>



