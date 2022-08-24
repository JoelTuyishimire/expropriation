<?php

namespace App\Models;

use App\FileManager;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Claim extends ExpropriationBaseModel
{
    use HasFactory;

    protected $guarded = [];

    public function getAttachment(): ?string
    {
        return $this->attachment ? Storage::url(FileManager::CLAIMS_ATTACHMENT_PATH.$this->attachment) : null;
    }

    public function citizen(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'citizen_id');
    }

    public function expropriation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Expropriation::class, 'expropriation_id');
    }
}
