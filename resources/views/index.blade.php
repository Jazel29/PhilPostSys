<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>PhilPost-Legazpi</title>
</head>
<body>
  <div class="content-center">
    <div class="d-flex justify-content-center mt-10 mx-5 p-4 rounded-md shadow bg-gray-200  border-3">
      <div class="content ">
          <div class="">
            <div class="img">
              <img src="{{ asset('assets/PhilPostLogo.jfif') }}" alt="PhilPostLogo" class="">
            </div>
            <div class="mt-5 p-4 justify-content-center">
              <div class="fw-bold">Please Click Login</div>
              <button class="btn-secondary m-4 p-2 rounded-md mx-auto">
                <a href="/login" class="text-white">Proceed to Login -></a>
              </button>
            </div>
          </div>
      </div>
    </div>
  </div>   
</html>