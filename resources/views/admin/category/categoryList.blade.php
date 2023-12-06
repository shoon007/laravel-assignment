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
            <div class="ps-logo">
                PS
            </div>
        </nav>
        <p class="text-blue ms-4">
            items List
        </p>
        <div class="container-fluid px-4">
            <a href="{{ route('admin#addCategoryPage') }}">
                <button class="add-item">
                    <i class="fa-solid fa-plus me-2"></i> Add Category
                </button>
            </a>

            Show:
            <select name="" id="">
                <option value=" ">{{ $categories->count() }} {{ $categories->count() > 1 ? 'rows' : 'row' }}</option>
            </select>

            <div class=" my-5">
                @if ($categories->count() > 0)
                    <table class="table bg-white rounded shadow-sm  table-hover">
                        <thead class="table-header">
                            <tr>
                                <th scope="col" width="150" class="">
                                    Action<i class="fa-solid fa-chevron-down ms-2 hidden"></i>
                                </th>
                                <th scope="col">No<i class="fa-solid fa-chevron-down ms-2 hidden"></i></th>

                                <th scope="col">Category<i class="fa-solid fa-chevron-down  ms-2"></i></th>

                                <th scope="col">Publish<i class="fa-solid fa-chevron-down  ms-2"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="item-lists">
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin#editCategoryPage', $category->id) }}" class="pen me-2">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <a href="{{ route('admin#deleteCategory', $category->id) }}" class="trash">
                                                <i class="fa-solid fa-trash "></i>
                                            </a>
                                        </div>

                                    </td>
                                    <td>
                                        <span> {{ $category->id }} </span>
                                    </td>

                                    <td>
                                        <span>
                                            {{ $category->name }}
                                        </span>
                                    </td>

                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="categoryStatus"
                                                @if ($category->publish_status) checked @endif>
                                            <span class="slider"></span>
                                            <input type="hidden" name="" id="categoryId"
                                                value="{{ $category->id }}">
                                        </label>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @else
                    <h3 class="message"> There is no category yet!</h3>
                @endif

            </div>
            <div class="">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
