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
                    <td hidden>
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
</script>