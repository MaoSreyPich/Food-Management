<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('category')->paginate(8);
        $categories = Category::all(); 
        return view('admin.menus.index', compact('menus', 'categories'));
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
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name','category_id','subtitle','description','price','stock']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('uploads/menus');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $file->move($uploadPath, $imageName);
               $data['image'] = url('uploads/menus/' . $imageName);
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
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menu->name = $request->name;
        $menu->category_id = $request->category_id;
        $menu->subtitle = $request->subtitle;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->stock = $request->stock;

        // ✅ Handle image update
        if ($request->hasFile('image')) {
            if ($menu->image && file_exists(public_path($menu->image))) {
                unlink(public_path($menu->image));
            }

            $file = $request->file('image');
            $imageName = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('uploads/menus');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $file->move($uploadPath, $imageName);
            $menu->image = 'uploads/menus/' . $imageName;
        }

        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu updated successfully!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

    // ✅ Delete image file from storage if it exists
    if ($menu->image && File::exists(public_path($menu->image))) {
        File::delete(public_path($menu->image));
    }

    // ✅ Delete record from database
    $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu deleted successfully!');
    }
}