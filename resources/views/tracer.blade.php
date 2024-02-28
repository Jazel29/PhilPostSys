<x-app-layout>
    <style>
        .py-5 {
            /* Adjusted padding */
            padding: 1rem;
            /* Adjusted margin */
            margin: 2em auto; /* Adjusted margin */
            border-radius: 4px;
            filter: drop-shadow(0 0 0.75rem grey);
            background: white;
            position: relative;
            /* Adjusted max-width */
            max-width: 80%; /* You can adjust this value as needed */
        }

        .py-5::before {
            content: '';
            position: absolute;
            top: -18px;
            width: 200px;
            height: 25px;
            background: white;
            border-radius: 25px 0 0 0;
            clip-path: path('M 0 0 L 160 0 C 185 2, 175 16, 200 18 L 0 50 z');
        }

        .py-5::after {
            content: '';
            position: absolute;
            left: 40px;
            width: 85px;
            height: 5px;
            top: -18px;
            background: #7036e9;
            border-radius: 0 0 5px 5px;
        }

        /* Adjusted margin for message div */
        .mssg {
            margin-top: 1rem;
        }

        /* Ensure the table fills the container */
        #transmittalstable {
            width: 50%;
        }

        /* Adjusted container width for small screens */
        @media (max-width: 640px) {
            .py-5 {
                max-width: 100%; /* Adjusted for small screens */
                margin: 2em auto; /* Adjusted margin for small screens */
            }
        }

        /* Adjusted for moving the folder more to the right */
        @media (min-width: 1024px) {
            .py-5 {
                margin-left: 19%; /* Adjusted left margin */
            }
        }
    </style>

    <div class="py-5 ml-60">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @include('transmittals.transmittals-table')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
