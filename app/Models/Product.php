<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'image', 'category_id', 'price', 'sale_price', 'quantity', 'weight', 'height', 'wedth', 'length ', 'sku', 'status'];

    protected $perPage = 5;
    
    function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function toArray()
    {
        return [
            'id'=>$this->id ,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'image'=>asset('storage/' .$this->image),
            'description'=>$this->description ,
            'origin'=>'test',
            'usage'=> 'test' ,
            'natural_info'=> [
                'size'=> '250g' ,
                'calories'=>'44g',
                'protien'=>'10g' ,
                'sugar'=> '5g' ,
                'fibre'=> '2g' ,
                'fat'=> '2g' ,
                'saturated fat' => '3g',
                'vitaminA'=> '20mg',
                'vitaminC'=> '20mg' ,
            ],
        ];
    }
}
