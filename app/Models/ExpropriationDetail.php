<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpropriationDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function expropriation()
    {
        return $this->belongsTo(Expropriation::class);
    }

    public function item()
    {
        return $this->belongsTo(PropertyItem::class,'property_item_id');
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class,'property_type_id');
    }
}
