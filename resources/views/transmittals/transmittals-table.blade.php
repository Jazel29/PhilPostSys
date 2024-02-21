<style>
    .highlight {
        border: 2px solid red; 
    }
 
    .container-dots {
        width: 60px; /* Adjust the width as needed */
        height: 40px; /* Adjust the height as needed */
        border: 1px solid #909090; /* Border color */
        border-radius: 20px; /* Half of the height to create a rounded rectangle */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .dots {
        font-size: 24px; /* Adjust the font size as needed */
        line-height: 1;
    }

    /* Add this style to apply ellipsis to the RRRTN column */
    .ellipsis {
        max-width: 100px; /* Adjust the max-width as needed */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Set font size to 14px for the entire table */
    #transmittalstable {
        font-size: 14px;
    }

    /* Add rounded corners to table rows on hover and change background color to blue */
    #transmittalstable tbody tr:hover {
        border-radius: 10px;
        background: linear-gradient(90deg, #0026C8, #2C54FF);
        color: #FFFFFF;
    }
</style>

<div class="mssg">
    <div class="mssg">
    @if(session('flash_mssg'))
        <div class="alert alert-primary" role="alert">
            <p>{{ session('flash_mssg') }}</p>
        </div>
    @endif
</div>
</div>
<div class="row">
    <h1 class="display-5"> Trace Transmittals </h1>
</div>

<div class="newtb">
    <table id="transmittalstable" class="table table-striped " cellspacing="0" width="90%">
        <thead class="text-center">
            <!-- starting dito, kulang pa ata ng mga functions sakin (kevin) -->
            <tr> 
                <th>Transmittal TN</th>
                <th>Date Posted</th>
                <th>Addressee</th>
                <th>Address</th>
                <th>RRR TN</th>
                <th>Action</th>
            </tr>
        </thead>

        <div class="container-dots">
            <div class="dots">•••</div>
        </div>
        
        <!-- Table body --> 
        <tbody>
            @if ($query->isEmpty())
                <tr class="border-b">
                    <td colspan="6">No Record Found</td>
                </tr>
            @else
            @foreach ($query as $record)
                @php
                    // Retrieve AddresseeList and ReturnCards for the current record
                    $addressee = $addressees[$record->id] ?? null;
                    $returnCards = $rrt_n[$record->id] ?? collect();
                @endphp
                <tr>
                    <th scope="row">{{ $record->mailTrackNum }}</th>
                    <td>{{ $record->date }}</td>
                    <td>{{ $addressee->name_primary }}, {{ $addressee->name_secondary }}
                    <td>{{ $addressee->address }}, {{ $addressee->zip }} {{ $addressee->city }}, {{ $addressee->province }}</td>
                    <td class="ellipsis"> <!-- Apply ellipsis to this column -->
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
                                <form method="POST" action="{{ url('/transmittals' . '/' . $record->id) }}" accept-charset="UTF-8">
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
    $(document).ready(function() {
        $('#transmittalstable').DataTable({
            "language": {
                "search": "" }
        });

        $('.dataTables_filter input').attr('placeholder', 'Search');
        $('#2').css('padding-top', '20px');
    });
</script>
