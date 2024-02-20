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
<form action="/addRecord" method="POST" class="p-3 needs-validation" onsubmit="submitForm()">
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
            <span id="mail_tn_error" class="text-danger"></span>
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
        <div id="popover-content" style="display:none;" class="mt-2 text-danger">Addressee Not Found.<a href="" onclick="openModal()"> Add New Addressee?</a></span></div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <b>Address:</b><br>
            <textarea id="address" name="address" cols="64" rows="2"></textarea>
        </div>
    </div>
    
    <div id="addRRR_div" style="display: none;">
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
            <input type="hidden" name="rrr_tns" id="rrr_tns_input">
        </div>
        <div class="row mt-3">
            <div class="col-6 text-right">
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </div>
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
                    <button type="submit" class="btn btn-outline-primary" onclick="saveAddresee()">Save Addressee</button>
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
    var rrr_tns = [];
    var count = 0;

    function removeTN(element, rrr_tn_value) {
        // Remove the container from the DOM
        element.parentNode.removeChild(element);

        // Remove the corresponding rrr_tn_value from the rrr_tns array
        var index = rrr_tns.indexOf(rrr_tn_value);
        if (index !== -1) {
            rrr_tns.splice(index, 1);
        }

        // Log the updated rrr_tns array (for testing purposes)
        console.log(rrr_tns);
        updateCounts();
    }

    function updateCounts() {
    // Get all tn_containers in the rrr_div
        var tnContainers = document.getElementById('rrr_div').getElementsByClassName('container');

        // Update the counts based on the current index in the rrr_tns array
        for (var i = 0; i < tnContainers.length; i++) {
            var countElement = tnContainers[i].getElementsByTagName('p')[0];
            countElement.innerText = (i + 1) + '. ' + rrr_tns[i];
        }
    }

    function addTN() {
        var rrr_tn_value = document.getElementById('rrr_tn').value;

        // Check if rrr_tn_value is truthy before appending
        if (rrr_tn_value) {
            // Add the rrr_tn_value to the rrr_tns array
            rrr_tns.push(rrr_tn_value);

            // Get the current index in the rrr_tns array
            var count = rrr_tns.length;

            // Create a new tn_container with the extracted value
            var tn_container = document.createElement('div');
            tn_container.className = 'container';
            tn_container.innerHTML = '<span class="exit-button" onclick="removeTN(this.parentNode, \'' + rrr_tn_value + '\')">✖</span><p>' + count + ". " + rrr_tn_value + '</p>';

            // Append the new tn_container to the rrr_div
            document.getElementById('rrr_div').appendChild(tn_container);

            // Clear the value of rrr_tn input field
            document.getElementById('rrr_tn').value = '';

            // Log the updated rrr_tns array (for testing purposes)
            console.log(rrr_tns);
        }
    }


    var rrr_tn_value = document.getElementById("rrr_tn");
    rrr_tn_value.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            addTN();
        }
    });

    var mailTn = document.getElementById("mail_tn");
    mailTn.addEventListener("keypress", function(evt) {
        if (event.key === "Enter") {
            evt.preventDefault();
        }
    });

    function submitForm() {

        // Set the rrr_tns array value to the hidden input
        document.getElementById('rrr_tns_input').value = JSON.stringify(rrr_tns);

        // Submit the form
        document.forms[0].submit();
    }

    
    document.getElementById('addresseeDataList').addEventListener('input', function() {
        var addressValue = document.getElementById('address');
        var addresseeVal = document.getElementById('receiver');
        var RRRdiv = document.getElementById('addRRR_div');
        var popUp = document.getElementById('popover-content');
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
                RRRdiv.style.display = 'block';
                popUp.style.display = 'none';
            } else {
                addressValue.value = '';
                RRRdiv.style.display = 'none';
                popUp.style.display = 'block';

            }
            
            if(!selectedOption & selectedValue == '') {
                popUp.style.display = 'none';
            }
        }
    });


    function closeModal() {
        $('#newAddresseeModal').modal('hide');
    }

    function openModal() {
        $('#newAddresseeModal').modal('show');
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
    
    $(document).ready(function () {
        $('#mail_tn').on('blur', function () {
            var mail_tn = $(this).val();

            // Perform AJAX request to check existence
            $.ajax({
                type: 'GET',
                url: '/checkMailTN', // Replace with your actual route
                data: { mail_tn: mail_tn },
                success: function (response) {
                    if (response.exists) {
                        $('#mail_tn_error').text('Mail Tracking Number already exists');
                    } else {
                        $('#mail_tn_error').text('');
                    }
                },
                error: function (error) {
                    console.error('Error checking Mail Tracking Number:', error);
                }
            });
        });
    });

</script>