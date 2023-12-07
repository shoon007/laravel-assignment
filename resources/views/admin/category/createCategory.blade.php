@extends('admin.layouts.master')
@section('list')
    <a href="{{ route('dashboard') }}" class="list ">
        <i class="fa-solid fa-grip me-2"></i>Item</a>
    <a href="{{ route('admin#categoryList') }}" class="list active">
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
        <p class="text-black ms-3">Categories List >
            <span class="text-blue "> Add Category</span>
        </p>
        <p class="addItem-title">Add Categories</p>
        <div class="container-fluid px-4">
            <div class="form-container">
                <form action="{{ route('admin#createCategory') }}" method="POST" class="info-container"
                    enctype="multipart/form-data" id="myForm">
                    @csrf
                    <div class="item-info">
                        <p>Category Information</p>
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative">Category Name<i
                                    class="fa-solid fa-star-of-life position-absolute top-0 mt-1"></i>
                            </span>
                            <input type="text" placeholder="Input name" class="mt-2" name="categoryName"
                                value="{{ old('categoryName') }}">
                            @error('categoryName')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold">Item Photo</span>
                            <div class="drag-area mt-2">
                                <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>

                                <button class="file-btn">Choose File</button>
                                <input type="file" hidden name="image">

                            </div>

                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative mb-1">Status</span>
                            <div class="d-flex  align-items-center">

                                <input type="hidden" name="status" value="0">
                                <input type="checkbox" class="ui-checkbox" name="status" value="1"
                                    @if (old('status')) checked @endif>

                                <span class="ms-2">Publish</span>
                            </div>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
