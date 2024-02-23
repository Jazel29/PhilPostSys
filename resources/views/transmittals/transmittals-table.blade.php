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
                                <a class="btn btn-primary m-2 text-white" href="{{ url('/transmittals/' . $record->id) }}" title="View Record">View</a>
                            </div>
                            <div class="ms-3 mt-2">
                                <a href="{{ url('/transmittals/'.$record->id.'/edit') }}" class="btn btn-success text-white" title="Delete Record">Update</a>
                            </div>
                            <div class="ms-3 mt-2">
                                <form method="POST" action="{{ route('transmittals.destroy', $record->id) }}" accept-charset="UTF-8">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="btn btn-warning delete-button" data-delete-url="{{ route('transmittals.destroy', $record->id) }}" title="Delete Record">Delete</button>
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


<!-- Modal for Delete Transmittal Record -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header custom-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Transmittal Record</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="closeModal()">Close</button>
                <form id="deleteForm" method="POST" action="">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger text-color">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Add this script for handling the modal and form submission
    $(document).ready(function() {
        $('.delete-button').on('click', function() {
            var deleteUrl = $(this).data('delete-url');
            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteConfirmationModal').modal('show');
        });
        window.closeModal = function() {
            $('#deleteConfirmationModal').modal('hide');
        };
    });
</script>

<style>
    /* Custom table styles */
    .table-wrapper th {
        border-radius: 0px;
        overflow: hidden;
    }

    .text-center {
        border-radius: 50px;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table th,
    .custom-table td {
        padding: 1px;
        text-align: left;
    }

    .custom-table th {
        background-color: #f2f2f2;
    }

    .custom-table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .custom-table tbody tr:hover {
        background-color: #f0f0f0;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .btn {
        border-radius:5px;
        padding-left: 7px;
        padding-right: 7px;
        padding-top: 4px;
        padding-bottom: 4px;
    }

    .custom-search-input,
    .custom-filter-select {
        width: 500px;
        padding: 5px;
        font-size: 16px; 
        border-radius: 11px; 
        border: 1px solid #ccc; 
        box-shadow: none; 
    }

    .search-bar-container,
    .filter-container {
        margin-bottom: 20px; 
    }

    .input{
        padding-left: 10px;
    }
    .text-color {
        color: #BB2D3B;
    }
    .custom-header{
        background-color: #BB2D3B;
    }
    .modal-title {
    color: #ffffff;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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
<style>
    .highlight {
        border: 2px solid red; /* You can customize the highlighting style */
    }
    
    /* #table_div {
        display: none;
    } */
</style>
