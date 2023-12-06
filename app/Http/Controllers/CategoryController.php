<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category list
    public function categoryList()
    {
        $categories = Category::orderBy('id', 'desc')
            ->paginate(5);

        $categories->appends(request()->all());
        return view('admin.category.categoryList', compact(['categories']));
    }

    //create category
    public function addCategory()
    {
        return view('admin.category.createCategory');
    }

//creating category
    public function createCategory(Request $request)
    {

        $this->categoryValidationCheck($request, 'create');
        $data = $this->categoryData($request);

        if ($request->hasFile('image')) {
            //unique img name
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            //save in file & database
            $request->file('image')->storeAs('public/' . $fileName);
            $data['image'] = $fileName;
        }
        Category::create($data);
        return redirect()->route('admin#categoryList');

    }
//changing the publish status
    public function categoryStatus(Request $request)
    {
        $status = Category::where('id', $request->categoryId)->update([
            'publish_status' => $request->checked == "true" ? 1 : 0,
        ]);
        return response()->json($status, 200);
    }

//edit category
    public function editCategory($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.category.editCategory', compact('category'));
    }
//update category
    public function updateCategory(Request $request)
    {

        $this->categoryValidationCheck($request, 'update');
        $data = $this->categoryData($request);
        if ($request->hasFile('image')) {
            $oldImageName = Category::where('id', $request->categoryId)->first();
            $oldImageName = $oldImageName->image;
            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Category::where('id', $request->categoryId)->update($data);
        return redirect()->route('admin#categoryList');
    }
//delete category
    public function deleteCategory($id)
    {
        Category::where('id', $id)->delete();
        return back();
    }

    private function categoryData($request)
    {
        return [
            'name' => $request->categoryName,
            'publish_status' => $request->status,

        ];
    }
//post validation check
    private function categoryValidationCheck($request, $status)
    {
        $validationRules = [

            'categoryName' => 'required|min:5|unique:categories,name,' . $request->categoryId,
        ];

        $validationRules['image'] = $status == 'create' ? 'required|mimes:jpg,jpeg,png,webp|file' : 'mimes:jpg,jpeg,png,webp|file';
        Validator::make($request->all(), $validationRules)->validate();
    }
}
