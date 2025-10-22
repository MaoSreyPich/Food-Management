<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // 👇 optional: define reverse relation
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}