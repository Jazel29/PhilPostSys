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
</style>
<div class="container">
    <div class="row mt-3">
        <h1 class="display-6">Transmittal Record</h1>
    </div>
    <div class="row text-right">
        <div class="col">
            <a href="/tracer"><button class="btn btn-outline-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64"/>
                </svg>
            </button></a>
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
            <p>Addressee: <span class="bold">{{ $records->recieverName }}</span></p>
        </div>
        <div class="col-6">
            <p class="labels">Address: <span class="bold">{{ $records->recieverAddress }}</span></p>
        </div>
    </div>
    <div class="row mt-5">
        <div class="row mt-5">
            <div class="col-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-outline-success" type="button">Search</button>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped " cellspacing="0" width="50%">
            <thead class="text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">RRR Tracking Numbers</th>
                </tr>
            </thead>
            <tbody class="text-center">
              
                @if ($rrt_n->isEmpty())
                    <td>404</td>
                    <td>No Record Found</td>
                @else
                    @foreach ($rrt_n as $rrt_n )
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $rrt_n->returncard }}</td>
                    </tr>
                    @endforeach
                @endif
                
            </tbody>
        </table>
    </div>
    <div class="newtb">
        
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#example').dataTable();
    } );
</script>