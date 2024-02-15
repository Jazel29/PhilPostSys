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
<div class="mssg">
    @if(session('flash_mssg'))
        <div class="alert alert-primary" role="alert">
            <p>{{ session('flash_mssg') }}</p>
        </div>
    @endif
</div>
<form action="/addRecord" method="POST" class="p-3">
    @csrf
    <div class="row mt-4">
        <div class="col-6">
            <input placeholder="Select date" type="date" name="date_posted" id="date_posted" class="form-control" required>
            <i class="fas fa-calendar input-prefix" tabindex=0></i>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <input placeholder="Mail Tracking Number" type="text" name="mail_tn" id="mail_tn" class="form-control" required>
            <i class="fas fa-calendar input-prefix" tabindex=0></i>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <input class="form-control" list="datalistOptions" id="addresseeDataList" placeholder="Addressee" required>
            <datalist id="datalistOptions">
                <option value="Add New Addressee"></option>
            </datalist>
            <input class="form-control" type="hidden" name="receiver" id="receiver">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <b>Address:</b><br>
            <textarea id="address" name="address" cols="64" rows="2"></textarea>
        </div>
    </div>
    
    {{-- comment ko muna kasi for testing --}}
    {{-- <div class="row mt-5">
        <div class="col" style="max-width: 500px;">
                <input placeholder="Tracking Number/s of Registry Return Recepits/Proofs of Delivery" type="text" name="rrr_tn" id="rrr_tn" class="form-control">
                <i class="fas fa-calendar input-prefix" tabindex=0></i>
                </div>
                <div class="col-2">
                <button type="button" id="add" class="btn btn-outline-success btn-sm" onclick="addTN()">Add</button>
        </div>
    </div> --}}

    {{-- <div class="row mt-5 custom-border" id="rrr_div"> --}}
    </div>
    <div class="row mt-3">
        <div class="col-6 text-right">
            <button type="submit" class="btn btn-outline-success">Submit</button>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="newAddresseeModal" tabindex="-1" role="dialog" aria-labelledby="newAddresseeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAddresseeModalLabel">Add New Addressee</h5>
            </div>
            <div class="mssg">
                @if(session('record_added'))
                    <div class="alert alert-primary" role="alert">
                        <p>{{ session('record_added') }}</p>
                    </div>
                    <script>
                        $(document).ready(function () {
                            $('#newAddresseeModal').modal('show');
                        });
                    </script>
                @endif
            </div>
            <form action="/add_addressee" method="post">
                @csrf
                <div class="modal-body">
                    <!-- Add your form fields for adding a new addressee here -->
                    <!-- Example: -->
                    <input type="text" name="nameAbbrev" id="nameAbbrev" class="form-control mb-2" placeholder="Addressee Abbreviation" required>
                    <input type="text" name="namePrimary" id="namePrimary" class="form-control mb-2" placeholder="Addressee Name Line 1" required>
                    <input type="text" name="nameSecondary" id="nameSecondary" class="form-control mb-2" placeholder="Addressee Name Line 2">
                    <input type="text" name="address" id="address" class="form-control mb-2" placeholder="Floor/Bldg/Street/Barangay ">
                    <input type="text" name="city" id="city" class="form-control mb-2" placeholder="City/Municipality" required>
                    <input type="text" name="zip" id="zip" class="form-control mb-2" placeholder="Zip Code" required>
                    <input type="text" name="province" id="province" class="form-control mb-2" placeholder="Province" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="closeModal()">Close</button>
                    <button type="submit" class="btn btn-outline-primary">Save Addressee</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="content mt-5">
    <div class="d-flex justify-content-center">
        displahy the content here
    </div>
</div>
   
<script>
    document.getElementById('addresseeDataList').addEventListener('input', function() {
    var addressValue = document.getElementById('address');
    var addresseeVal = document.getElementById('receiver');
    var tn = document.getElementById('mail_tn');
    var selectedValue = this.value;

    if (selectedValue === 'Add New Addressee') {
        $('#newAddresseeModal').modal('show');
        this.value = '';
    } else {
        // Get the selected option element
        var selectedOption = document.querySelector('#datalistOptions option[value="' + selectedValue + '"]');
        
        // Check if the selected option exists
        if (selectedOption) {
            selectedId = selectedOption.id;
            var selectedAddressee = addressees.find(addressee => addressee.id == selectedId)
            addressValue.value = selectedAddressee.address + " " + selectedAddressee.city + " " + selectedAddressee.zip + " " + selectedAddressee.province;
            addresseeVal.value = selectedId;
        }else {
            addressValue.value = '';
        }
    }
});

function closeModal() {
    $('#newAddresseeModal').modal('hide');
}

function saveNewAddressee() {
    $('#newAddresseeModal').modal('hide');
}

document.addEventListener('DOMContentLoaded', function () {
    // Fetch addressees from the server
    fetch('/get-addressees')
        .then(response => response.json())
        .then(data => {
            const datalist = document.getElementById('datalistOptions');
            addressees = data.addressees; // Store addressees globally for later access

            addressees.forEach(addressee => {
                const option = document.createElement('option');
                option.value = `${addressee.abbrev} - ${addressee.name_primary}`;
                option.id = addressee.id;
                datalist.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching addressees:', error));
});
</script>