<style>
    .highlight {
        border: 2px solid red; 
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
                                <a href="{{ route('edit', ['id' => $record->id]) }}" class="btn btn-success text-white">Update</a>
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
    $(document).ready(function() {
        $('#transmittalstable').dataTable();
    } );
    
</script>
