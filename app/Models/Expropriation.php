<?php

namespace App\Models;

use App\FileManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expropriation extends ExpropriationBaseModel
{
    use HasFactory;

    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(ExpropriationDetail::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function citizen()
    {
        return $this->belongsTo(User::class, 'citizen_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }

    public function histories()
    {
        return $this->hasMany(ExpropriationHistory::class, 'expropriation_id');
    }

    public function history()
    {
        return $this->HasOne(ExpropriationHistory::class);
    }
    //set total price from unit price times quantity
    public function setTotalPriceAttribute($value)
    {
        $this->attributes['total_price'] = $value * $this->attributes['quantity'];
    }
}
