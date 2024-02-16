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
    <!--<form action="/tracer" method="GET">
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
</div>-->

<!--<div class="search-bar-container">
    <input type="search" id="search-input" class="custom-search-input" placeholder="Search records . . .">
</div>

<div class="filter-container">
    <label for="filter-select">Filter by:</label>
    <select id="filter-select" class="custom-filter-select">
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
    </select>
</div>-->

<div class="table-wrapper">
    <table id="transmittalstable" class="custom-table" cellspacing="0">
        <!-- Table headers -->
        <thead class="text-center">
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
                    <tr>
                        <td>{{ $record->mailTrackNum }}</td>
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
                            <div class="action-buttons">
                                <a class="btn btn-primary" href="{{ url('/transmittals/' . $record->id) }}">View</a>
                            </div>
                        </td>
                    </tr>              
                @endforeach
            @endif
        </tbody>
    </table>
</div>

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
        border-radius:15px;
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

    .transmittalstable thead {

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

