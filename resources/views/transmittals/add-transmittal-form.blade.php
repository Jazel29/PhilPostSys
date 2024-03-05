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
    .custom-header{
        background-color: #0D6EFD;
    }
    .modal-title {
    color: #ffffff;
    }
    #flashMessage.alert-primary {
        background-color: #0D6EFD; 
        color: #fff;
        text-align: center; 
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600; 
    }
    #flashMessage.alert-primary {
        background-color:#0D6EFD; 
        color: #fff;
        text-align: center; 
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600; 
        position: relative; /* Add relative positioning for overlay */
        z-index: 50; /* Ensure flash message is above overlay */
        border-radius: 15px !important;
    }

    /* Add a blur overlay */
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.2); /* Adjust the opacity as needed */
        display: none; /* Initially hidden */
        z-index: 40; /* Below flash message */
    }
    .btn {
        border-radius: 15px !important;
    }

    .input-border {
        border-color: #a0aec0;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }
    .display-6 {
        color: #505050;
    }
    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .form-control {
        font-size: 1rem;
        padding: 1rem;
        border: none;
        border-bottom: 2px solid #ccc;
        width: 100%;
        transition: border-color 0.3s;
        background-color: transparent;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #0026C8; /* Change focus border color */
    }
    
    .form-control + label {
        position: absolute;
        top: 1rem;
        left: 1rem;
        transition: top 0.3s, font-size 0.3s;
        pointer-events: none; /* Ensure label doesn't interfere with input */
    }
    
    .form-control:focus + label,
    .form-control:not(:placeholder-shown) + label {
        top: 0.25rem;
        font-size: 0.75rem;
        color: #0026C8; /* Change label color on focus or when input is not empty */
    }

    .input-bx{
    position: relative;


    }
    .input-bx input{
        width: 100%;
        padding: 10px;
        border: 1px solid #7f8fa6;
        border-radius: 15px;
        outline: none;
        font-size: 1rem;
        transition: 0.6s;
    }

    .input-bx span{
        position: absolute;
        top: 1px;
        left: 20px;
        padding: 10px;
        font-size: 1rem;
        color: #7f8fa6;
        pointer-events: none;
        transition: 0.1s;
    }
    .input-bx input:valid ~ span,
    .input-bx input:focus ~ span{
        color: #3742fa;
        transform: translateX(5px) translateY(-9px);
        font-size: 0.65rem;
        font-weight: 600;
        padding: 0 10px;
        background: #fff;
    }

    .input-bx input:valid,
    .input-bx input:focus{
        color: #000;
        border: 1px solid #0026C8;

    }
    .text-color {
        color: #000;
    }
</style>


<div class="mssg position-fixed top-8 start-50 translate-middle-x w-1/4 z-50">
    <div class="mssg">
        @if(session('flash_mssg'))
            <div id="flashMessage" class="alert alert-primary" role="alert">
                <p>{{ session('flash_mssg') }}</p>
            </div>
        @endif
    </div>
</div>

<div id="overlay"></div> <!-- Add overlay div -->

<div class="ml-8">
    <div class="row">
        <h1 class="display-6"> Add New Transmittal </h1>
    </div>
</div>

<form action="/addRecord" id="addAddresseeForm" method="POST" class="p-3 needs-validation" onsubmit="event.preventDefault(); showConfirmationModal();">
    @csrf
    <div class="add-transmittal-form flex flex-col md:flex-row">
        <div class="left-section w-full md:w-1/2">
            <div class="row">          
                <div class="mt-4 input-bx">
                    <input type="date" name="date_posted" id="date_posted" class="form-control form-border rounded-md text-19 input-border" required>
                </div>
            
                <div class="mt-2 input-bx">
                    <input type="text" name="mail_tn" id="mail_tn" class="form-control rounded-md text-19 input-border" required>
                    <span>Mail Tracking Number</span>
                </div>
                <div id="mail_tn_error" class="text-danger mt-2 mb-2"></div>
                <div class="input-bx">
                    <input class="form-control rounded-md text-19 input-border form-border" list="datalistOptions" id="addresseeDataList" required>
                    <span>Addressee</span>
                    <datalist id="datalistOptions">
                        <option value="Add New Addressee"></option>
                    </datalist>
                    <input class="form-control" type="hidden" name="receiver" id="receiver">
                </div>
                <div id="popover-content" class="mt-2 text-danger" style="display: none;">
                    Invalid Addressee. <a href="#" onclick="openModal()" class="underline-link">Click here</a> to add new addressee.
                </div>
                <div class="row mt-3 input-bx ml-0"> 
                    <div class="text-gray-500 ml-2">
                        Address:
                   </div> 
                    <textarea id="address" name="address" rows="2" class="rounded-lg text-19 form-border" style="border-color:#a0aec0;"></textarea>
                </div>
            </div>
        </div>    
        <div class="right-section w-full md:w-1/2 mt-4" id="addRRR_div">
            <div class="flex flex-col">
                <div class="flex flex-row input-bx">
                    <div class="w-full ml-3">
                        <input type="text" name="rrr_tn" id="rrr_tn" class="form-control rounded-md text-gray-500 border-gray-500 text-19 mb-2">
                        <span>Tracking Number/s of Registry Return Receipts/Proofs of Delivery</span>
                    </div>
                    <div class="ml-2">
                        <button type="button" id="add" class="btn btn-md text-19 border-2 border-blue-600 hover:text-white hover:bg-blue-600" onclick="addTN()">Add</button>
                    </div>
                </div>
                <div class="ml-2 mt-2">
                    <div class="custom-border font-md rounded-md" id="rrr_div" style="border-color:#a0aec0;">
                        <div id="rrrtn_error" class="text-danger mt-2"></div>
                        <input type="hidden" name="rrr_tns" id="rrr_tns_input">
                    </div>
                </div>
                <div class="flex justify-end mt-3">
                    <button type="submit" class="btn border-2 btn-md border-blue-600 hover:text-white hover:bg-blue-600" id="submitBtn">Submit</button>
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
            <div class="modal-header custom-header">
                <h5 class="modal-title" id="confirmationModalLabel">Add New Transmittal</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to submit this form?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn-outline-primary" onclick="confirmSubmit()">Yes, Submit</button>
            </div>
        </div>
    </div>
</div>


<div class="content mt-5">
    <div class="d-flex justify-content-center">
        @if (session('success'))
        <script src="https://cdn.lordicon.com/lordicon.js"></script>
            <lord-icon
            src="https://cdn.lordicon.com/lomfljuq.json"
            trigger="in"
            delay="5"
            state="in-check"
            colors="primary:#ffffff"
            style="width:30px; height:30px">
            </lord-icon>

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
    $(document).ready(function() {
        if ($('#flashMessage').length > 0) {
            $('#overlay').fadeIn('slow');
        }

        setTimeout(function() {
            $('#flashMessage').fadeOut('slow');
            $('#overlay').fadeOut('slow');
        }, 2000);
    });

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
                mailTnErrorElement.html('<i class="fa-solid fa-circle-exclamation fa-fade fa-sm"></i>   Transmittal Tracking Number already exists');
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
        var rrrtn_error = $('#rrrtn_error');

        // Check if the value already exists in the list
        if (rrr_tns.includes(rrr_tn_value)) {
            //alert('RRR Tracking Number already exists.'); // Prompt user with alert message
            rrrtn_error.html('<i class="fa-solid fa-circle-exclamation fa-fade fa-sm"></i>   RRR Tracking Number already exists');
            return; // Exit the function if the value already exists
        }else{
            rrrtn_error.text('');
            if (rrr_tn_value) {
                rrr_tns.push(rrr_tn_value);

                var count = rrr_tns.length;
                var tn_container = createTNContainer(count, rrr_tn_value);

                document.getElementById('rrr_div').appendChild(tn_container);

                $('#rrr_tn').val('');
                console.log(rrr_tns);
            }
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
