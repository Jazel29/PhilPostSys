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
    .no-margin {
        margin-bottom: 0 !important;
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
</style>

<div class="mb-8 mx-3">
    <div class="flex justify-between items-center ">
        <h1 class="display-5"> Add New Addressee </h1>
        <div>
            <a href="/update-addressee-form"><button type="button" class="btn btn-outline-primary">Edit Existing Addressee</button></a>
        </div>
    </div>
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

<div id="overlay"></div><!-- Add overlay div -->

<div class="row mt-3 mx-2">
    <form action="/add_addressee" method="post" id="addresseeForm">
        @csrf
        <div class="list-addressee-form border rounded-md p-3">
            <div class="row">
                <h1 class="text-gray-700 mb-3 ml-1"> Addressee Information : </h1>

                <div class="col-md-3">
                    <input type="text" name="nameAbbrev" id="nameAbbrev" class="form-control rounded-md text-19 form-border no-margin" placeholder="Addressee Abbreviation" required>
                </div>
                <div class="col-md-9">
                    <div class="flex flex-col">
                        <input type="text" name="namePrimary" id="namePrimary" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Addressee Name Line 1" required>
                        <input type="text" name="nameSecondary" id="nameSecondary" class="form-control rounded-md text-19 form-border" placeholder="Addressee Name Line 2">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-7 border rounded-md p-3">
            <h1 class="text-gray-700 mb-3 ml-1"> Addressee Addressee : </h1>
   
            <input type="text" name="address" id="address" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Floor/Bldg/Street/Barangay ">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="city" id="city" class="form-control mb-2 rounded-md text-19 form-border" placeholder="City/Municipality" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="zip" id="zip" class="form-control mb-2 rounded-md text-19 form-border" placeholder="Zip Code" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="province" id="province" class="form-control rounded-md text-19 form-border" placeholder="Province" required>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-3">
            <button type="button" class="btn btn-outline-secondary mr-4" onclick="clearForm()">Clear</button>
            <button type="submit" class="btn btn-outline-primary">Save Addressee</button>
        </div>
    </form>
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
    function clearForm() {
        // Clear all input fields inside the form
        document.getElementById("addresseeForm").reset();
    }
</script>