<?php

namespace App\Models;

use App\FileManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpropriationHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getAttachment()
    {
        return $this->nid_attachment ? \Storage::url(FileManager::APPROVAL_ATTACHMENT_DIR . $this->nid_attachment) : null;
    }
}
