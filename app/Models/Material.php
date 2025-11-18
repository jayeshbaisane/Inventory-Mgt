<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Material extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'category_id',
        'name',
        'opening_balance',
        'internal_material_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function inward()
    {
        return $this->hasMany(Inward::class, 'material_id');
    }
}
