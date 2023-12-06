 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8" />
     <meta name="_token" content="{{ csrf_token() }}" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
     <link rel="stylesheet" href="styles.css" />
     <title>Product Managing Dashboard</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
         integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="https://unpkg.com/leaflet@latest/dist/leaflet.css" />
     <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
     <!-- Link to bootstrap CDN -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     {{-- custom css --}}
     <link rel="stylesheet" href="{{ asset('css/admin/layouts/master.css') }}">
 </head>

 <body>
     <div class="d-flex" id="wrapper">
         <!-- Sidebar -->
         <div class="" id="sidebar-wrapper">
             <div
                 class="sidebar-heading text-center py-1 primary-text fs-4 fw-bold d-flex justify-content-center align-items-center">
                 <div class="logo me-3">
                     LO
                     <br>
                     GO
                 </div>
                 <p class="fs-6 flex-nowrap m-0 ms-2">Admin Panel</p>
             </div>
             <div class="list-group list-group-flush my-3">
                 @yield('list')

                 <a href="{{ url('/logout') }}"
                     class="list-group-item  logout text-center list-group-item-action bg-transparent fw-bold position-absolute bottom-0 mb-5">
                     <i class="fa-solid fa-right-from-bracket me-2"></i>
                     Logout</a>
             </div>
         </div>

         <!-- page-content-wrapper -->
         @yield('content')
     </div>

     <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
     <!-- Jquery JS-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
         integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     {{-- map cdn js --}}
     <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
         integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
         crossorigin=""></script>
     <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

       {{--   /* custom js */ --}}
         <script src = "{{ asset('js/master.js') }}" ></script>

<script>
     //changing the publish status with ajax
     $(document).ready(function() {
         $('.statusChange').change(function() {
             $currentRole = $(this).val();
             $checked = $(this).is(":checked");
             $parentNode = $(this).parents('tbody tr td label');
             $productId = $parentNode.find('#productId').val();
             $.ajax({
                 type: 'get',
                 url: 'http://127.0.0.1:8000/admin/status/change',
                 data: {
                     'role': $currentRole,
                     'productId': $productId,
                     'checked': $checked
                 },
                 dataType: 'json',
             })

         })


         $('.categoryStatus').change(function() {
             $currentRole = $(this).val();
             $checked = $(this).is(":checked");
             $parentNode = $(this).parents('tbody tr td label');
             $categoryId = $parentNode.find('#categoryId').val();
             $.ajax({
                 type: 'get',
                 url: 'http://127.0.0.1:8000/admin/category/status',
                 data: {
                     'role': $currentRole,
                     'categoryId': $categoryId,
                     'checked': $checked
                 },
                 dataType: 'json',
             })

         })

     })

     var map_init = L.map('map', {
         center: [9.0820, 8.6753],
         zoom: 8
     });
     var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
     }).addTo(map_init);
     L.Control.geocoder().addTo(map_init);
     if (!navigator.geolocation) {
         console.log("Your browser doesn't support geolocation feature!")
     } else {
         setInterval(() => {
             navigator.geolocation.getCurrentPosition(getPosition)
         }, 5000);
     };
     var marker, circle, lat, long, accuracy;

     function getPosition(position) {
         // console.log(position)
         lat = position.coords.latitude
         long = position.coords.longitude
         accuracy = position.coords.accuracy

         if (marker) {
             map_init.removeLayer(marker)
         }

         if (circle) {
             map_init.removeLayer(circle)
         }

         marker = L.marker([lat, long])
         circle = L.circle([lat, long], {
             radius: accuracy
         })

         var featureGroup = L.featureGroup([marker, circle]).addTo(map_init)

         map_init.fitBounds(featureGroup.getBounds())

         console.log("Your coordinate is: Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy)
     }


</script>
