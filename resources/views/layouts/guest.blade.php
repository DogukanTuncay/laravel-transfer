<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="{{route('login')}}">
                    <img src="{{asset('assets/img/icon.png')}}" alt="">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white  dark:bg-gray-800 shadow-md sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script>
  const input = document.querySelector("#phone");
  if(input){
   var phone =  window.intlTelInput(input, {
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
    initialCountry: "auto",
    geoIpLookup: function(callback) {
    fetch("https://ipapi.co/json")
      .then(function(res) { return res.json(); })
      .then(function(data) { callback(data.country_code); })
      .catch(function() { callback("us"); });
        }
    })
  }
  $("#registerForm").submit(function() {

  var full_number = phone.getNumber(intlTelInputUtils.numberFormat.E164);
$("input[name='phone[main]'").val(full_number);
});
</script>
    </body>
</html>
