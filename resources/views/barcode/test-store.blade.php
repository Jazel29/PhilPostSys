<x-app-layout>
    <div class="container mt-5">
        <div class="h4 d-flex justify-content-center">
            Test Input to the Database
        </div>
        
        <div class="d-flex justify-content-center p-3">
            <form action="/addRecord" method="POST">
                @csrf
                    <div class="mb-3 p-2">
                        <label for="exampleFormControlInput1" class="form-label">Track Number</label>
                        <input type="text" name="tracknum" class="form-control rounded" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3 p-2">
                        <label for="exampleFormControlInput1" class="form-label">Reciever's Name</label>
                        <input type="text" name="recieverName" class="form-control rounded" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="mb-3 p-2">
                        <label for="exampleFormControlInput1" class="form-label">Reciever's Address</label>
                        <input type="text" name="recieverAddress"    class="form-control rounded" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3 p-2">
                        <label for="exampleFormControlInput1" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control rounded" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                </div>
                <div class="mb-3 p-2 d-flex justify-content-center">
                    <input type="submit" value="Submit" class="btn btn-primary hover:btn-primary">
                </div>
            </form>
        </div>
        
    </div>
</x-app-layout>