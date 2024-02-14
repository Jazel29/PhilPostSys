<style>
    .highlight {
        border: 2px solid red; /* You can customize the highlighting style */
    }
    
    /* #table_div {
        display: none;
    } */
</style>
<div class="row">
    <h1 class="display-5"> Trace Transmittals </h1>
</div>
    <form action="/tracer" method="GET">
        @csrf
        <div class="row mt-5">
            <div class="col" style="max-width: 600px;">
                <input placeholder="" type="text" id="search" name="search" placeholder="Search..." class="form-control"/>
                <i class="fas fa-calendar input-prefix" tabindex=0></i>
            </div>
            <div class="col-2">
                    <button type="submit" id="trace" class="btn btn-outline-success" onclick="verifyCheckbox()">Trace</button>
            </div>
        </div>
    </form>
    <div class="row mt-3">
        <div class="col">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="addressee_checkbox" value="addressee_val">
                <label class="form-check-label" for="addressee_checkbox">Addressee</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="rrrTN_checkbox" value="rrrTn_val">
                <label class="form-check-label" for="rrrTN_checkbox">RRR Tracking Num</label>
            </div>
        </div>
    </div>
<div class="row mt-5" id="table_div">
    <table id="trace_table" class="table table-bordered">
        
        <tbody>
            
        </tbody>
    </table>
</div>

<div class="newtb">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead class="text-center">
            <tr>
                <th scope="col">Transmittal TN</th>
                <th scope="col">Date Posted</th>
                <th scope="col">Addressee</th>
                <th scope="col">Address</th>
                <th scope="col">RRR TN</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
 
       
 
        <tbody>
            @if ($query->isEmpty())
            <tr class="border-b">
                <td>No Record Found</td>
            </tr>
            @else
            @foreach ($query as $record)
                <tr>
                    <th scope="row">{{ $record->mailTrackNum }}</th>
                    <td>{{ $record->date }}</td>
                    <td>{{ $record->recieverName }}</td>
                    <td>{{ $record->recieverAddress }}</td>
                    <td>
                        @if ($rrt_n[$record->id]->isEmpty())
                            No Record Found
                        @else
                            @foreach ($rrt_n[$record->id] as $item)
                                {{ $item->returncard }}
                            @endforeach
                        @endif
                        
                    </td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-primary m-2" href="{{ url('/transmittals/' . $record->id) }}">View</a> <a class="btn btn-warning  m-2" href="{{ url('/transmittals/' . $record->id) }}">View</a>
                        </div>
                    </td>
                </tr>              
            @endforeach
        
            @endif
            
        </tbody>
    </table>
</div>

<script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').dataTable();
    } );
    var addressee = document.getElementById("addressee_checkbox");
    var rrrTN = document.getElementById("rrrTN_checkbox");
    var tableDiv = document.getElementById("table_div");

    addressee.addEventListener("change", function() {
        if (addressee.checked) {
            rrrTN.checked = false;
        }
    });

    rrrTN.addEventListener("change", function() {
        if (rrrTN.checked) {
            addressee.checked = false;
        }
    });

    function verifyCheckbox() {
        if (!addressee.checked && !rrrTN.checked) {
            // alert("Please check at least one checkbox");
            // Highlight the checkboxes if none is checked
            addressee.classList.add("highlight");
            rrrTN.classList.add("highlight");
            $(document).ready(function() {
                $('#trace_table').DataTable();
            });
            // tableDiv.style.display = "none"; // Hide the table
        } else {
            // Remove the class if at least one checkbox is checked
            addressee.classList.remove("highlight");
            rrrTN.classList.remove("highlight");
            $(document).ready(function() {
                $('#trace_table').DataTable();
            });
            // tableDiv.style.display = "block"; // Hide the table
        }
    }
    
</script>