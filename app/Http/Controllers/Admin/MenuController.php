<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.menus.create', compact('categories'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = $request->only(['name','category_id','price','stock']);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
    
            // Make sure the directory exists
            $uploadPath = public_path('uploads/menus');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
    
            $file->move($uploadPath, $imageName);
            $data['image'] = 'uploads/menus/' . $imageName;
        }
    
        Menu::create($data);
    
        return redirect()->route('admin.menu.index')->with('success', 'Menu added successfully!');
    }
    

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Category::all();
        return view('admin.menus.edit', compact('menu','categories'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name'=>'required|string|max:255',
            'category_id'=>'required|exists:categories,id',
            'price'=>'required|numeric',
            'stock'=>'required|integer|min:0',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validate image
        ]);

        $data = $request->all();

        // handle image update
        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($menu->image && file_exists(public_path($menu->image))) {
                unlink(public_path($menu->image));
            }

            $imageName = Str::slug($request->name) . '_' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/menus'), $imageName);
            $data['image'] = 'uploads/menus/' . $imageName;
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')->with('success','Menu updated!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // delete image if exists
        if ($menu->image && file_exists(public_path($menu->image))) {
            unlink(public_path($menu->image));
        }

        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success','Menu deleted!');
    }
}
