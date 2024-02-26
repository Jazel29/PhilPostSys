<x-app-layout>
    <div class="py-5 ml-40">
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="title text-center h5">List of Addressee</div>
                    <table class="table table-size mt-4" id="example">
                        <thead class="text-center">
                            <tr>
                                <th scope="col-items">Items</th>
                                <th scope="col">Department Name</th>
                                <th scope="col">Abbrev</th>
                                <th scope="col">Address</th>
                                <th scope="col">City</th>
                                <th scope="col">Province</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @if ($addresseeAll->isEmpty())
                                <tr>
                                    <th scope="row-item">----</th>
                                    <th scope="row-item">----</th>
                                    <th scope="row-item">----</th>
                                    <th scope="row-item">No Record Found</th>
                                    <th scope="row-item">----</th>
                                    <th scope="row-item">----</th>
                                    <th scope="row-item">----</th>
                                </tr>
                            @else
                                @foreach ($addresseeAll as $index => $addressee)
                                    <tr class="hover-row">
                                        <th scope="row-item">{{ $index + 1 }}</th>
                                        <th scope="row-item">{{ $addressee->name_primary }}</th>
                                        <th scope="row-item">{{ $addressee->abbrev }}</th>
                                        <th scope="row-item">{{ $addressee->address }}</th>
                                        <th scope="row-item">{{ $addressee->city }}</th>
                                        <th scope="row-item">{{ $addressee->province }}</th>
                                        <td>
                                            <form method="POST" action="{{ route('addressee.destroy', $addressee->id) }}" accept-charset="UTF-8" style="" class="">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="" title="Delete Student" onclick="return confirm('Confirm delete? {{ $addressee->returncard }}')"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<script>
    $(document).ready(function() {
        $('#example').dataTable();
    });
</script>
</x-app-layout>