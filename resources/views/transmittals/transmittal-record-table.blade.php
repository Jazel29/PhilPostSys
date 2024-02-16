<style>
    .table-size {
        width: 50%;
    }
    .bold {
        font-weight: bold;
        text-align: left;
    }

    .bold-addressee {
        font-weight: bold;
        font-size: 24px;
    }
    
    .labels {
        text-align: left;
    }
    
    .highlight {
    background: linear-gradient(90deg, #0026C8, #2C54FF); 
    border-radius: 10px;
    color: #FFFFFF;
    font-size: 19px;
    padding: 4px 6px;
    }

    .tracking {
    padding: 10px;
    }   

    .rounded-container {
    border: 1px solid #ccc; 
    border-radius: 20px; 
    padding: 20px; 
    background-color: #ffffff; 
    }

    .custom-line {
    border: 90px; /* Remove default border */
    margin-top: 20px; /* Adjust margin top as needed */
    }

    .form-control {
    border-radius: 15px;
    }

    .btn-outline-success {
        border-radius: 15px;
    }

    .table-size {
    width: 100%;
    border-collapse: collapse; /* Ensure borders collapse properly */
    }

    .table-size thead {
    border-bottom: 2px solid #303030;
    padding: 5px;
    }

    .text-center{
    border-bottom: 1px;
    }  

    .table-size tbody tr {
    border-radius: 10px; /* Adjust the radius value as needed */
    }

    .rounded-entries .rounded-entry {
    border-radius: 15px; /* Adjust the border radius as needed */
    padding: 7px; /* Adjust the padding as needed */
    background-color: #FFFFFF; /* Adjust the background color as needed */
}

</style>

<div class="container">
    <div class="row mt-3">
        <div class="col">
            <h1 class="display-6">Transmittal Record</h1>
        </div>
        <div class="col text-right">
            <button class="btn btn-outline-success" id="exportExcelButton">
            &nbsp;<i class="fa-solid fa-table"></i> &nbsp; Export as Excel
            </button>
        </div>
    </div>
</div>

    <!-- Left side column -->
    <div class="row mt-3">
    <!-- Left side column -->
    <div class="col-md-4">
        <div class="rounded-container">
            <p>
                <span class="tracking">Tracking Number</span>
                <span class="bold highlight">{{ $records->mailTrackNum }}</span>
            </p>
        </div>
            <p class="labels"><br>Date Posted :</p>
            <p><span class="bold">{{ $records->date }}</span></p>
            <hr class="custom-line">

            <p class="labels"><br>Address :</p>
            <p><span class="bold">{{ $records->recieverAddress }}</span><br></p>
        
    </div>

    <!-- Right side column -->
    <div class="col-md-8">

            <p class="labels">Addressee :</p>
            <p><span class="bold-addressee">{{ $records->recieverName }}</span></p>

            <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row mt-5">
                <div class="col-md-12">
                    <!-- Search Bar -->
                    
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                        <button class="btn btn-outline-success" type="button">Search</button>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-24">
                    <!-- Table -->
                    <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="rounded-entries">
                <table class="table table-size mt-4">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Items</th>
                            <th scope="col">RRR Tracking Numbers</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($rrt_n as $index => $rrt)
                        <tr>
                            <td class="rounded-entry">{{ $index + 1 }}</td>
                            <td class="rounded-entry">{{ $rrt->returncard }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



