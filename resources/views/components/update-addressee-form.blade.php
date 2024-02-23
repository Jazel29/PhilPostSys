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
</style>

<div class="ml-4">
    <div>
        <h1 class="display-5"> Update Addressee </h1>
    </div>
    <div class="mssg mt-2">
        @if(session('status'))
            <div class="alert alert-primary" role="alert">
                <p>{{ session('status') }}</p>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif
    </div>
</div>

<div class="row mt-3 m-4">
    <form action="/update-addressee-submit" method="post">
        @csrf
        <div class="row mt-2">
            <input class="form-control rounded-md text-19" list="datalistOptions" id="addresseeDataList" placeholder="Addressee" style="border-color:#a0aec0;" required>
            <datalist id="datalistOptions">
                <option value="Existing Addressee"></option>
            </datalist>
            <input class="form-control" type="hidden" name="addressee-id" id="addressee-id">
        </div>
        <div class="row mt-2">
            <input type="text" name="nameAbbrev" id="nameAbbrev" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Addressee Abbreviation" required disabled>
            <input type="text" name="namePrimary" id="namePrimary" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Addressee Name Line 1" required disabled>
            <input type="text" name="nameSecondary" id="nameSecondary" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Addressee Name Line 2" disabled>
            <input type="text" name="address" id="address" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Floor/Bldg/Street/Barangay" disabled>
            <input type="text" name="city" id="city" class="form-control mb-2 rounded-md text-19 form-border " placeholder="City/Municipality" required disabled>
            <input type="text" name="zip" id="zip" class="form-control mb-2 rounded-md text-19 form-border " placeholder="Zip Code" required disabled>
            <input type="text" name="province" id="province" class="form-control mb-2 rounded-md text-19 form-border " placeholder="Province" required disabled>
        </div>
        <div class="row mt-2">
            <div class="col">
                <button type="submit" class="btn btn-outline-primary">Update Addressee</button>
            </div>
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
</script>
