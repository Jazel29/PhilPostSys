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
        <thead class="text-center">
            <tr>
                <th scope="col">Transmittal TN</th>
                <th scope="col">Date Posted</th>
                <th scope="col">Addressee</th>
                <th scope="col">Address</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @if ($records->isEmpty())
            <tr class="border-b">
                <td>No Record Found</td>
            </tr>
            @else
                @foreach ($records as $record)
                    <tr>
                        <th scope="row">{{ $record->mailTrackNum }}</th>
                        <td>{{ $record->date }}</td>
                        <td>{{ $record->recieverName }}</td>
                        <td>{{ $record->recieverAddress }}</td>
                        {{-- <td><a href="/transmittals"><button type="button" id="view_more" class="btn btn-outline-success" onclick="">View More</button></a></td> --}}
                        <td><a href="{{ url('/transmittals/' . $record->id) }}">View</a></td>
                    </tr>              
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
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