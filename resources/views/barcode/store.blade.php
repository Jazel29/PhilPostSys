<x-app-layout>
    <div class="mssg">

    </div>
    <form class="row g-3" action="/store" method="POST">
       @csrf
        <div class="col-auto">
          
          <label for="last-barcode" class="visually-hidden">Barcode</label>
          <input type="text" class="form-control rounded" id="last-barcode" placeholder="***" name="barcode">
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3">Confirm identity</button>
        </div>
      </form>
      <script>
        var barcode = '';
        var interval;
        document.addEventListener('keydown', function(evt) {
            if (interval)
                clearInterval(interval);
            if (evt.code == 'Enter') {
                if (barcode)
                    handleBarcode(barcode);
                barcode = '';
                return;
            }
            if (evt.key != 'Shift')
                barcode += evt.key;
            interval = setInterval(() => barcode = '', 20);
        });

        function handleBarcode(scanned_barcode) {
            document.querySelector('#last-barcode').value = scanned_barcode;
        }
    </script>
</x-app-layout>