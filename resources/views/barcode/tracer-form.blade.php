<style>
    .highlight {
        border: 2px solid red; /* You can customize the highlighting style */
    }
    
    #table_div {
        display: none;
    }
</style>
<div class="row">
    <h1 class="display-5"> Trace Transmittals </h1>
</div>
<form>
    <div class="row mt-5">
        <div class="col" style="max-width: 600px;">
            <input placeholder="" type="text" name="tracer_input" id="tracer_input" class="form-control">
            <i class="fas fa-calendar input-prefix" tabindex=0></i>
        </div>
        <div class="col-2">
            <button type="button" id="trace" class="btn btn-outline-success" onclick="verifyCheckbox()">Trace</button>
        </div>
    </div>
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
</form>
<div class="row mt-5" id="table_div">
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th scope="col">Transmittal TN</th>
                <th scope="col">Date Posted</th>
                <th scope="col">Addressee</th>
                <th scope="col">Details</th>
                <th scope="col">Address</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">RE796528127ZZ</th>
                <td>07/11/2023</td>
                <td>DOLE-NLRC</td>
                <td>DEPARTMENT OF LABOR AND EMPLOYMENT NATIONAL LABOR RELATIONS COMMISSION REGIONAL ARBITRATION BRANCH</td>
                <td>Rawis, Legazpi City</td>
                <td><button type="button" id="view_more" class="btn btn-outline-success" onclick=""><a href="/transmittals">View More</a></button></td>
            </tr>
            <tr>
                <th scope="row">RE795531884ZZ</th>
                <td>30/11/2023</td>
                <td>DOLE-NLRC</td>
                <td>DEPARTMENT OF LABOR AND EMPLOYMENT NATIONAL LABOR RELATIONS COMMISSION REGIONAL ARBITRATION BRANCH</td>
                <td>Rawis, Legazpi City</td>
                <td><button type="button" id="view_more" class="btn btn-outline-success" onclick="">View More</button></td>
            </tr>
            <tr>
                <th scope="row">RE795541161ZZ</th>
                <td>12/12/2023</td>
                <td>DOLE-NLRC</td>
                <td>DEPARTMENT OF LABOR AND EMPLOYMENT NATIONAL LABOR RELATIONS COMMISSION REGIONAL ARBITRATION BRANCH</td>
                <td>Rawis, Legazpi City</td>
                <td><button type="button" id="view_more" class="btn btn-outline-success" onclick="">View More</button></td>
            </tr>
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
            alert("Please check at least one checkbox");
            // Add a class to highlight the checkboxes
            addressee.classList.add("highlight");
            rrrTN.classList.add("highlight");
            tableDiv.style.display = "none"; // Hide the table
        } else {
            // Remove the class if at least one checkbox is checked
            addressee.classList.remove("highlight");
            rrrTN.classList.remove("highlight");
            tableDiv.style.display = "block"; // Hide the table
        }
    }
</script>