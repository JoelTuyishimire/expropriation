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

    public function propertyItem()
    {
        return $this->belongsTo(PropertyItem::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
