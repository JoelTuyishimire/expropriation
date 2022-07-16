<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchServiceBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'service_id',
        'balance',
    ];

}
