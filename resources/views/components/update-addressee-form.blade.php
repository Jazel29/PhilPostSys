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

    .form-border {
        border-color:#a0aec0;
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
    #flashMessage.alert-primary {
        background-color:#0D6EFD; 
        color: #fff;
        text-align: center; 
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600; 
        position: relative; /* Add relative positioning for overlay */
        z-index: 50;
        border-radius: 15px !important;
    }
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
    .box-with-shadow {
        box-shadow: 2px 2px rgba(0, 0, 0, 0.2);
    }
    .border {
        box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);

    }
</style>

<div class="ml-4">
    <div class="mb-2 mx-3">
        <h1 class="display-5"> Update Addressee </h1>
    </div>
    <div class="mssg position-fixed top-6 start-50 translate-middle-x h-5 w-1/4 z-50">
        <div class="mssg">
            @if(session('flash_mssg'))
                <div id="flashMessage" class="alert alert-primary" role="alert">
                    <p>{{ session('flash_mssg') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<div id="overlay"></div><!-- Add overlay div -->

<div class="row mt-3 m-4">
    <form action="/update-addressee-submit" method="post">
        @csrf
        <div class="row mt-2 mb-3 mx-0">
            <input class="form-control rounded-md box-with-shadow text-19" list="datalistOptions" id="addresseeDataList" placeholder="Select Addressee" style="border-color:#a0aec0;" required>
            <datalist id="datalistOptions">
                <option value="Existing Addressee"></option>
            </datalist>
            <input class="form-control " type="hidden" name="addressee-id" id="addressee-id">
        </div>

        <div class="list-addressee-form border rounded-md p-3">
            <div class="row">
                <h1 class="text-gray-700 mb-3 ml-1"> Addressee Information : </h1>
                <div class="col-md-3">
                    <input type="text" name="nameAbbrev" id="nameAbbrev" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Addressee Abbreviation" required disabled>
                </div>
                <div class="col-md-9">
                    <div class="flex flex-col">
                        <input type="text" name="namePrimary" id="namePrimary" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Addressee Name Line 1" required disabled>
                        <input type="text" name="nameSecondary" id="nameSecondary" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Addressee Name Line 2" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3 border rounded-md p-3">
            <h1 class="text-gray-700 mb-3 ml-1"> Addressee Addressee : </h1>
            <input type="text" name="address" id="address" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Floor/Bldg/Street/Barangay" disabled>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="city" id="city" class="form-control mb-2 rounded-md text-19 form-border" placeholder="City/Municipality" required disabled>
                </div>
                <div class="col-md-4">
                    <input type="text" name="zip" id="zip" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Zip Code" required disabled>
                </div>
                <div class="col-md-4">
                    <input type="text" name="province" id="province" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Province" required disabled>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-3">
            <button type="submit" class="btn btn-outline-primary">Save Addressee</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('addresseeDataList').addEventListener('input', handleAddresseeDataListInput);
    document.addEventListener('DOMContentLoaded', fetchAddressees);
    
    function handleAddresseeDataListInput() {
        var id = document.getElementById('addressee-id');
        var abbrev = document.getElementById('nameAbbrev');
        var namePrimary = document.getElementById('namePrimary');
        var nameSecondary = document.getElementById('nameSecondary');
        var address = document.getElementById('address');
        var city = document.getElementById('city');
        var zip = document.getElementById('zip');
        var province = document.getElementById('province');
        var selectedValue = this.value;
            
        var selectedOption = document.querySelector('#datalistOptions option[value="' + selectedValue + '"]');

        if (selectedOption) {
            var selectedId = selectedOption.id;
            var selectedAddressee = addressees.find(addressee => addressee.id == selectedId);
            nameAbbrev.value = `${selectedAddressee.abbrev}`;
            namePrimary.value = `${selectedAddressee.name_primary}`;
            nameSecondary.value = `${selectedAddressee.name_secondary}`;
            address.value = `${selectedAddressee.address}`;
            city.value = `${selectedAddressee.city}`;
            zip.value = `${selectedAddressee.zip}`;
            province.value = `${selectedAddressee.province}`;
            id.value = selectedId;

            nameAbbrev.disabled = false;
            namePrimary.disabled = false;
            nameSecondary.disabled = false;
            address.disabled = false;
            city.disabled = false;
            zip.disabled = false;
            province.disabled = false;
        } else {
            nameAbbrev.value = '';
            namePrimary.value = '';
            nameSecondary.value = '';
            address.value = '';
            city.value = '';
            zip.value = '';
            province.value = '';
            id.value = '';

            nameAbbrev.disabled = true;
            namePrimary.disabled = true;
            nameSecondary.disabled = true;
            address.disabled = true;
            city.disabled = true;
            zip.disabled = true;
            province.disabled = true;
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
            option.value = `${addressee.abbrev} - ${addressee.name_primary}`
            option.id = addressee.id;
            datalist.appendChild(option);
        });
    }
    $(document).ready(function() {
        if ($('#flashMessage').length > 0) {
            $('#overlay').fadeIn('slow');
        }

        setTimeout(function() {
            $('#flashMessage').fadeOut('slow');
            $('#overlay').fadeOut('slow');
        }, 2000);
    });
</script>
