<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'subtitle',
        'description',
        'category_id',
        'price',
        'stock',
    ];

    // 👇 define relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function index() {
        $menus = Menu::all(); // Make sure this returns all menu items
        return view('customer.menu', compact('menus'));
    }
    

}
