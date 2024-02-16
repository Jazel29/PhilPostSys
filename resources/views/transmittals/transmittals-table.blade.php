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


<div class="newtb">
    <table id="example" class="table table-striped " cellspacing="0" width="90%">
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
                    
                    <td class="">
                        <div class="d-flex">
                            <div class="">
                                <a class="btn btn-primary m-2 text-white" href="{{ url('/transmittals/' . $record->id) }}">View</a>
                            </div>
                            <div class="ms-3 mt-2">
                                <a href="{{ url('/transmittals/'.$record->id.'/edit') }}" class="btn btn-success text-white">Update</a>
                            </div>
                            <div class="ms-3 mt-2">
                                <form method="POST" action="{{ url('/transmittals' . '/' . $record->id) }}" accept-charset="UTF-8" style="" class="">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-warning" title="Delete Student" onclick="return confirm('Confirm delete? {{ $record->name }}')"> Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>              
            @endforeach
        
            @endif
            
        </tbody>
    </table>
</div>

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