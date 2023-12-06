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
                <form action="{{ route('admin#createItem') }}" method="POST" class="info-container " id="myForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="item-info">
                        <p>Item Information</p>
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative">Item Name<i
                                    class="fa-solid fa-star-of-life position-absolute top-0 mt-1"></i>
                            </span>
                            <input type="text" placeholder="Input name" class="mt-2" name="itemName"
                                value="{{ old('itemName') }}">
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
                                        @if (old('category') == $category->id) selected="selected" @endif>
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
                                value="{{ old('price') }}">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold position-relative mb-2">
                                Description<i class="fa-solid fa-star-of-life position-absolute top-0 mt-1"></i>
                            </span>
                            <div id="editor" contenteditable="true" name="description">{{ old('description') }}</div>
                            <input type="hidden" id="hidden-input" name="description" value="{{ old('description') }}">
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

                                <option value="new" @if (old('itemCondition') == 'new') selected="selected" @endif>New
                                </option>
                                <option value="used" @if (old('itemCondition') == 'used') selected="selected" @endif>Used
                                </option>
                                <option value="second-hand" @if (old('itemCondition') == 'second-hand') selected="selected" @endif>
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
                                <option value="sell" @if (old('itemType') == 'sell') selected="selected" @endif>Sell
                                </option>
                                <option value="buy" @if (old('itemType') == 'buy') selected="selected" @endif>Buy
                                </option>
                                <option value="exchange" @if (old('itemType') == 'exchange') selected="selected" @endif>
                                    Exchange</option>
                            </select>
                            @error('itemType')
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
                        <div class="d-flex flex-column my-4">
                            <span class="fw-bold">Item Photo</span>

                            <div class="drag-area mt-2 ">
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
                                value="{{ old('name') }}">
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
                                    value="{{ old('phone') }}">

                            </div>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex flex-column my-4">

                            <span class="fw-bold"> Address
                            </span>
                            <textarea name="address" id="" cols="30" rows="10" placeholder="Enter Address"class="mt-2 ">
                            {{ old('address') }}
                            </textarea>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div id="map" width="100%" height="500px">
                        </div>

                        <div class="d-flex float-end mt-4">
                            <button type="button" class="cancel-btn"  onclick="resetForm()">
                                Cancel
                            </button>
                            <button type="submit" class="save-btn" id="submit">
                                Save
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
