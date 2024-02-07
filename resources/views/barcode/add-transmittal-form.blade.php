<style>
    .custom-border {
        border: 2px solid #333; /* Change #333 to the desired dark color code */
        padding: 20px;
        margin-left: 5px;
        max-width: 540px;
    }

    .container {
        position: relative;
        max-width: 200px;
        margin-left: 5px;
        margin-right: 20px;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .exit-button {
        position: absolute;
        top: 20px;
        right: 10px;
        cursor: pointer;
        font-size: 18px;
        color: #333;
    }    
</style>
<div class="row">
    <h1 class="display-5"> New Transmittal </h1>
</div>
<form>
    <div class="row mt-4">
        <div class="col-6">
            <input placeholder="Select date" type="date" name="date_posted" id="date_posted" class="form-control">
            <i class="fas fa-calendar input-prefix" tabindex=0></i>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <input placeholder="Mail Tracking Number" type="text" name="mail_tn" id="mail_tn" class="form-control">
            <i class="fas fa-calendar input-prefix" tabindex=0></i>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <input placeholder="Addressee" type="text" name="receiver" id="receiver" class="form-control">
            <i class="fas fa-calendar input-prefix" tabindex=0></i>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <input placeholder="Address" type="text" name="address" id="address" class="form-control">
            <i class="fas fa-calendar input-prefix" tabindex=0></i>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col" style="max-width: 500px;">
            <input placeholder="Tracking Number/s of Registry Return Recepits/Proofs of Delivery" type="text" name="rrr_tn" id="rrr_tn" class="form-control">
            <i class="fas fa-calendar input-prefix" tabindex=0></i>
        </div>
        <div class="col-2">
            <button type="button" id="add" class="btn btn-outline-success btn-sm" onclick="addTN()">Add</button>
        </div>
    </div>

    <div class="row mt-5 custom-border" id="rrr_div">
    </div>
</form>

<script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    function removeTN(element) {
        // Remove the container from the DOM
        element.parentNode.removeChild(element);
    }

    function addTN() {
        var rrr_tn_value = document.getElementById('rrr_tn').value;

        // Create a new tn_container with the extracted value
        var tn_container = document.createElement('div');
        tn_container.className = 'container';
        tn_container.innerHTML = '<span class="exit-button" onclick="removeTN(this.parentNode)">✖</span><p>' + rrr_tn_value + '</p>';

        // Append the new tn_container to the rrr_div
        document.getElementById('rrr_div').appendChild(tn_container);

        // Clear the value of rrr_tn input field
        document.getElementById('rrr_tn').value = '';
    }

    var rrr_tn_value = document.getElementById("rrr_tn");
    rrr_tn_value.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            addTN();
        }
    });
</script>