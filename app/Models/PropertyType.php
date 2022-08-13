<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function propertyItems()
    {
        return $this->hasMany(PropertyItem::class);
    }
    public function expropriations()
    {
        return $this->hasMany(Expropriation::class);
    }
}
