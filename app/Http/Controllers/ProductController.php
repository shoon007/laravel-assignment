<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    //addItem page
    public function addItem()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.product.addItemPage', compact('categories'));
    }

    //create item page
    public function createItem(Request $request)
    {

        $this->postValidationCheck($request, 'create');
        $data = $this->postData($request);

        if ($request->hasFile('image')) {
            //unique img name
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            //save in file & database
            $request->file('image')->storeAs('public/' . $fileName);
            $data['image'] = $fileName;
        }

        Product::create($data);
        return redirect()->route('dashboard');

    }

    //changing the publish status
    public function statusChange(Request $request)
    {
        $status = Product::where('id', $request->productId)->update([
            'publish_status' => $request->checked == "true" ? 1 : 0,
        ]);
        return response()->json($status, 200);
    }

    //edit item page
    public function editItem($id)
    {
        $info = Product::where('id', $id)->first();
        $categories = Category::get();


        return view('admin.product.editItemPage', compact('info', 'categories'));
    }

    //update item
    public function updateItem(Request $request)
    {
        //dd($request->all());
        $this->postValidationCheck($request, 'update');
        $data = $this->postData($request);
        if ($request->hasFile('image')) {
            $oldImageName = Product::where('id', $request->productId)->first();
            $oldImageName = $oldImageName->image;
            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        Product::where('id', $request->productId)->update($data);
        return redirect()->route('dashboard');

    }
    //delete item
    public function deleteItem($id)
    {
        Product::where('id', $id)->delete();
        return back();
    }

    private function postData($request)
    {
        return [
            'name' => $request->itemName,
            'category_id' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'item_condition' => $request->itemCondition,
            'item_type' => $request->itemType,
            'publish_status' => $request->status,
            'owner_name' => $request->name,
            'owner_phone' => $request->phone,
            'owner_address' => $request->address,
        ];
    }

    //post validation check
    private function postValidationCheck($request, $status)
    {

        $validationRules = [
            'itemName' => 'required|min:5|unique:products,name,' . $request->id,
            'category' => 'required',
            'price' => 'required',
            'itemCondition' => 'required',
            'itemType' => 'required',
            'description' => 'required',
            'price' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];

        $validationRules['image'] = $status == 'create' ? 'required|mimes:jpg,jpeg,png,webp|file' : 'nullable';
        Validator::make($request->all(), $validationRules)->validate();
    }
}
