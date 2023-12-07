@extends('admin.layouts.master')
@section('list')
    <a href="{{ route('dashboard') }}" class="list active">
        <i class="fa-solid fa-grip me-2"></i>Item</a>
    <a href="{{ route('admin#categoryList') }}" class="list">
        <i class="fa-solid fa-list me-2"></i>Category</a>
@endsection
@section('content')
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4 d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <i class="fas fa-align-left primary-text fs-4 me-3 text-black-50" id="menu-toggle"></i>

            </div>

        </nav>
        <p class="text-black ms-3">Items List >
            <span class="text-blue "> Add Item</span>
        </p>
        <p class="addItem-title">Add items</p>
        <div class="container-fluid px-4">
            <div class="form-container">
                <form action="{{ route('admin#updateItem') }}" method="POST" class="info-container" id="myForm"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="text" value="{{ $info->id }}" hidden name="productId">
                    <div class="item-info">
                        <p>Item Information</p>
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative">Item Name<i
                                    class="fa-solid fa-star-of-life position-absolute top-0 mt-1"></i>
                            </span>
                            <input type="text" placeholder="Input name" class="mt-2" name="itemName"
                                value="{{ old('itemName', $info->name) }}">
                            @error('itemName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative">Select Category<i
                                    class="fa-solid fa-star-of-life position-absolute top-0 mt-1"></i></span>
                            <select name="category" id="" class="mt-2">

                                <option value="">
                                    Select Category
                                </option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category', $category->id) == $info->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>
                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative">
                                Price<i class="fa-solid fa-star-of-life position-absolute top-0 mt-1"></i>
                            </span>
                            <input type="text" name="price" placeholder="Price" class="mt-2"
                                value="{{ old('price', $info->price) }}">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative mb-2">
                                Description<i class="fa-solid fa-star-of-life position-absolute top-0 mt-1"></i>
                            </span>
                            <div id="editor" contenteditable="true" name="description">
                                {{ old('description', $info->description) }}</div>
                            <input type="hidden" id="hidden-input" name="description">
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative">
                                Select Item Condition
                            </span>
                            <select name="itemCondition" id="" class="mt-2">

                                <option value="">Select Item Condition</option>

                                <option value="new"
                                    {{ old('itemCondition', $info->item_condition) == 'new' ? 'selected' : '' }}>New
                                </option>
                                <option value="used"
                                    {{ old('itemCondition', $info->item_condition) == 'used' ? 'selected' : '' }}>Used
                                </option>
                                <option value="second-hand"
                                    {{ old('itemCondition', $info->item_condition) == 'second-hand' ? 'selected' : '' }}>
                                    Good Second Hand</option>
                            </select>
                            @error('itemCondition')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative">
                                Select Item Type
                            </span>
                            <select name="itemType" id="" class="mt-2">
                                <option value="">Select Item Type</option>
                                <option value="sell" {{ old('itemType', $info->item_type) == 'sell' ? 'selected' : '' }}>
                                    Sell</option>
                                <option value="buy" {{ old('itemType', $info->item_type) == 'buy' ? 'selected' : '' }}>
                                    Buy</option>
                                <option value="exchange"
                                    {{ old('itemType', $info->item_type) == 'exchange' ? 'selected' : '' }}>Exchange
                                </option>
                            </select>
                            @error('itemType')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative mb-1">Status</span>
                            <div class="d-flex  align-items-center">

                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" id="publish" class="ui-checkbox" name="status" value="1"
                                    {{ old('status', $info->publish_status) ? 'checked' : '' }}>
                                <label for="publish" class="ms-2">Publish</label>

                            </div>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold">Item Photo</span>

                            <div class="drag-area mt-2">
                                <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>

                                <button class="file-btn">Choose File</button>
                                <input type="file" hidden name="image" id="file">
                                <!-- add a hidden input field for the file name -->
                                <input type="hidden" name="image" id="file_name">
                            </div>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="owner-info">
                        <p>Owner Information</p>

                        <div class="d-flex flex-column my-4">

                            <span class="fw-bold position-relative">Owner Name<i
                                    class="fa-solid fa-star-of-life position-absolute top-0 mt-1"></i>
                            </span>
                            <input type="text" placeholder="Input Owner Name"class="mt-2" name="name"
                                value="{{ old('name', $info->owner_name) }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column my-4">

                            <span class="fw-bold">Contact Number
                            </span>
                            <div class="d-flex">
                                <select id="" class="p-0">
                                    <option value="95">+95</option>
                                </select>
                                <input type="text" name="phone" placeholder="Add Number" maxlength="9"
                                    value="{{ old('phone', $info->owner_phone) }}">

                            </div>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column my-4">

                            <span class="fw-bold"> Address
                            </span>
                            <textarea name="address" id="" cols="30" rows="10" placeholder="Enter Address"class="mt-2 ">{{ old('address', $info->owner_address) }}</textarea>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div id="map" width="100%" height="500px">
                        </div>
                        <div class="d-flex float-end mt-4">
                            <button type="button" class="cancel-btn" onclick="resetForm()">
                                Cancel
                            </button>
                            <button type="submit" class="save-btn">
                                Save
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        /* uploading or dragging folder */
        //selecting all required elements
        const dropArea = document.querySelector(".drag-area"),
            button = dropArea.querySelector("button"),
            input = dropArea.querySelector("input");
        let file; //this is a global variable and we'll use it inside multiple functions

        button.onclick = () => {
            event.preventDefault(); //
            input.click(); //if user click on the button then the input also clicked
        }

        input.addEventListener("change", function() {
            //getting user select file and [0] this means if user select multiple files then we'll select only the first one
            file = this.files[0];
            dropArea.classList.add("active");
            showFile(); //calling function
        });


        function showFile() {
            let fileType = file.type; //getting selected file type
            let validExtensions = ["image/jpeg", "image/webp", "image/jpg",
            "image/png"]; //adding some valid image extensions in array
            if (validExtensions.includes(fileType)) { //if user selected file is an image file
                let fileReader = new FileReader(); //creating new FileReader object
                fileReader.onload = () => {
                    let fileURL = fileReader.result; //passing user file source in fileURL variable
                    // assign the file name to the hidden input field value
                    document.getElementById("file_name").value = file.name;

                }
                fileReader.readAsDataURL(file);
            } else {
                alert("This is not an Image File!");
                dropArea.classList.remove("active");
                dragText.textContent = "Drag & Drop to Upload File";
            }
        }

        //Map js

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

        // Add an event listener for the form submission
        document.querySelector("form").addEventListener("submit", function(event) {
            // Prevent the default form behavior
            //  event.preventDefault ();


            // Get the HTML content of the editable div
            let html = editor.innerHTML;

            // Remove the HTML tags using a regular expression
            let text = html.replace(/<[^>]*>/g, "");

            // Assign it to the value of the hidden input
            hiddenInput.value = text;

            // Submit the form
            // this.submit ();
        });
    </script>
@endsection
