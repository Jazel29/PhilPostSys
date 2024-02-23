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
    
    .right-section {
        display: none;
    }

    .underline-link {
        text-decoration: underline;
        color: blue; /* Set the desired color */
        cursor: pointer; /* Set cursor to pointer on hover */
    }

    .underline-link:hover {
        text-decoration: none; /* Remove underline on hover if needed */
    }
</style>

<div class="ml-4">
    <div>
        <h1 class="display-5"> Add New Transmittal </h1>
    </div>
    <div class="mssg">
        @if(session('flash_mssg'))
        <div class="alert alert-primary" role="alert">
            <p>{{ session('flash_msg') }}</p>
        </div>
        @endif
    </div>
</div>
<form action="/addRecord" id="addAddresseeForm" method="POST" class="p-3 needs-validation" onsubmit="event.preventDefault(); showConfirmationModal();">
    @csrf
    <div class="add-transmittal-form flex">
        <div class="left-section w-1/2 ">
            <div class="mx-4">          
                <div class="row mt-4">
                    <input type="date" name="date_posted" id="date_posted" class="form-control rounded-md text-19" style="border-color:#a0aec0;" required>
                </div>
                <div class="row mt-2">
                    <input placeholder="Mail Tracking Number" type="text" name="mail_tn" id="mail_tn" class="form-control rounded-md text-19" style="border-color:#a0aec0;" required>
                </div>
                <div id="mail_tn_error" class="text-danger mt-2"></div>
                <div class="row mt-2">
                    <input class="form-control rounded-md text-19" list="datalistOptions" id="addresseeDataList" placeholder="Addressee" style="border-color:#a0aec0;" required>
                    <datalist id="datalistOptions">
                        <option value="Add New Addressee"></option>
                    </datalist>
                    <input class="form-control" type="hidden" name="receiver" id="receiver">
                </div>
                <div id="popover-content" class="mt-2 text-danger" style="display: none;">
                    Invalid Addressee. <a href="#" onclick="openModal()" class="underline-link">Click here</a> to add new addressee.
                </div>
                <div class="row mt-4">
                   <div class="text-gray-500">
                        Address:
                   </div> 
                    <textarea id="address" name="address" rows="2" class="rounded-md text-19" style="border-color:#a0aec0;"></textarea>
                </div>
            </div>
        </div>    
        <div class="right-section w-1/2" id="addRRR_div">
            <div class="flex flex-col mt-4">
                <div>
                    <div class="flex flex-row">
                        <input placeholder="Tracking Number/s of Registry Return Recepits/Proofs of Delivery" type="text" name="rrr_tn" id="rrr_tn" class="form-control rounded-md text-gray-500 border-gray-500 text-19 ml-1" style="border-color:#a0aec0;">
                        <div>
                            <button type="button" id="add" class="ml-3 btn btn-md text-19 border-2 border-blue-600 hover:text-white hover:bg-blue-600" onclick="addTN()">Add</button>
                        </div>
                    </div>
                    <div class="mt-4 custom-border font-md rounded-md" id="rrr_div" style="border-color:#a0aec0;">
                        <input type="hidden" name="rrr_tns" id="rrr_tns_input">
                    </div>
                    <div class="flex justify-end mt-3">
                        <button type="submit" class="btn border-2 btn-md border-blue-600 hover:text-white hover:bg-blue-600" id="submitBtn">Submit</button>
                    </div>
                </div>
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
                    <input type="text" name="province" id="province" class="form-control mb-2" placeholder="Province"   required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" onclick="closeModal()">Close</button>
                    <button type="submit" class="btn btn-outline-primary" onclick="saveAddresee()">Save Addressee</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-3" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to submit this form?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded-4 mr-1" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn-outline-primary rounded-4 ml-1" onclick="confirmSubmit()">Yes, Submit</button>
            </div>
        </div>
    </div>
</div>


<div class="content mt-5">
    <div class="d-flex justify-content-center">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
   
<script>
    $(document).ready(function () {
        $('#mail_tn').on('blur', checkMailTrackingNumber);
    });

    function checkMailTrackingNumber() {
        var mail_tn = $('#mail_tn').val();

        $.ajax({
            type: 'GET',
            url: '/checkMailTN',
            data: { mail_tn: mail_tn },
            success: handleMailTrackingNumberCheck,
            error: handleMailTrackingNumberError
        });
    }

    function handleMailTrackingNumberCheck(response) {
        var mailTnErrorElement = $('#mail_tn_error');
        var submitButton = $('#submitBtn');

        if (response.exists) {
            mailTnErrorElement.text('Mail Tracking Number already exists!');
            submitButton.prop('disabled', true); // Disable the submit button
        } else {
            mailTnErrorElement.text('');
            submitButton.prop('disabled', false); // Enable the submit button
        }
    }

    function handleMailTrackingNumberError(error) {
        console.error('Error checking Mail Tracking Number:', error);
        var div = document.getElementById("addRRR_div");
    }

    function confirmSubmit() {
        $('#confirmationModal').modal('hide');
        document.getElementById('rrr_tns_input').value = JSON.stringify(rrr_tns);
        document.getElementById('addAddresseeForm').submit();
    }

    function showConfirmationModal() {
        $('#confirmationModal').modal('show');
    }

    function closeModal() {
        $('#newAddresseeModal').modal('hide');
        $('#confirmationModal').modal('hide');
    }

    function openModal() {
        $('#newAddresseeModal').modal('show');
    }

    function saveNewAddressee() {
        $('#newAddresseeModal').modal('hide');
    }

    var rrr_tns = [];

    function addTN() {
        var rrr_tn_value = $('#rrr_tn').val();

        if (rrr_tn_value) {
            rrr_tns.push(rrr_tn_value);

            var count = rrr_tns.length;
            var tn_container = createTNContainer(count, rrr_tn_value);

            document.getElementById('rrr_div').appendChild(tn_container);

            $('#rrr_tn').val('');
            console.log(rrr_tns);
        }
    }

    function createTNContainer(count, rrr_tn_value) {
        var tn_container = document.createElement('div');
        tn_container.className = 'container';
        tn_container.innerHTML = `<span class="exit-button" onclick="removeTN(this.parentNode, '${rrr_tn_value}')">✖</span><p>${count}. ${rrr_tn_value}</p>`;
        return tn_container;
    }

    function removeTN(element, rrr_tn_value) {
        element.parentNode.removeChild(element);

        var index = rrr_tns.indexOf(rrr_tn_value);
        if (index !== -1) {
            rrr_tns.splice(index, 1);
        }

        console.log(rrr_tns);
        updateCounts();
    }

    function updateCounts() {
        var tnContainers = document.getElementById('rrr_div').getElementsByClassName('container');

        for (var i = 0; i < tnContainers.length; i++) {
            var countElement = tnContainers[i].getElementsByTagName('p')[0];
            countElement.innerText = `${i + 1}. ${rrr_tns[i]}`;
        }
    }

    function submitForm() {
        document.getElementById('rrr_tns_input').value = JSON.stringify(rrr_tns);
        document.getElementById('addAddresseeForm').submit();
    }

    // var rrr_tn_value = document.getElementById("rrr_tn");
    document.getElementById("rrr_tn").addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            addTN();
        }
    });

    // var mailTn = document.getElementById("mail_tn");
    document.getElementById("mail_tn").addEventListener("keypress", function (evt) {
        if (event.key === "Enter") {
            evt.preventDefault();
        }
    });

    document.getElementById('addresseeDataList').addEventListener('input', handleAddresseeDataListInput);
    document.addEventListener('DOMContentLoaded', fetchAddressees);
    function handleAddresseeDataListInput() {
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
            var selectedOption = document.querySelector('#datalistOptions option[value="' + selectedValue + '"]');

            if (selectedOption) {
                var selectedId = selectedOption.id;
                var selectedAddressee = addressees.find(addressee => addressee.id == selectedId);
                addressValue.value = `${selectedAddressee.address} ${selectedAddressee.city} ${selectedAddressee.zip} ${selectedAddressee.province}`;
                addresseeVal.value = selectedId;
                RRRdiv.style.display = 'block';
                popUp.style.display = 'none';
            } else {
                addressValue.value = '';
                RRRdiv.style.display = 'none';
                popUp.style.display = 'block';
            }

            if (!selectedOption & selectedValue == '') {
                popUp.style.display = 'none';
            }
        }
    }

    function fetchAddressees() {
        fetch('/get-addressees')
            .then(response => response.json())
            .then(populateAddresseesDatalist)
            .catch(error => console.error('Error fetching addressees:', error));
    }

    function populateAddresseesDatalist(data) {
        const datalist = document.getElementById('datalistOptions');
        addressees = data.addressees;

        addressees.forEach(addressee => {
            const option = document.createElement('option');
            option.value = `${addressee.abbrev} - ${addressee.name_primary}`;
            option.id = addressee.id;
            datalist.appendChild(option);
        });
    }
</script>
