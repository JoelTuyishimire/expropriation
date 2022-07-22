<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyItemHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function propertyItem()
    {
        return $this->belongsTo(PropertyItem::class);
    }
}
