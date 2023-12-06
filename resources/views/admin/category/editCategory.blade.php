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
                <form action="{{ route('admin#updateCategory') }}" method="POST" class="info-container" id="myForm"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" hidden name="categoryId" value="{{ $category->id }}">
                    <div class="item-info">
                        <p>Category Information</p>
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative">Category Name<i
                                    class="fa-solid fa-star-of-life position-absolute top-0 mt-1"></i>
                            </span>
                            <input type="text" placeholder="Input name" class="mt-2" name="categoryName"
                                value="{{ old('categoryName', $category->name) }}">
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
                                    @if ($category->publish_status) checked @endif>

                                <span class="ms-2">Publish</span>
                            </div>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex float-end mt-4">
                            <button type="button" class="cancel-btn"  onclick="resetForm()">
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
