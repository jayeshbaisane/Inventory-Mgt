<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inward extends Model
{
   
    protected $fillable = [
        'category_id',
        'material_id',
        'entry_date',
        'quantity',
        'internal_inward_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

}
