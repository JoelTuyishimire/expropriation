<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function histories()
    {
        return $this->hasMany(PropertyItemHistory::class);
    }
}
