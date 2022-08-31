<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpropriationBaseModel extends Model
{
    use HasFactory;

    // statuses
    const PENDING = "Pending";
    const SUBMITTED = "Submitted";
    const APPROVED = "Approved";
    const REJECTED = "Rejected";
    /**
     * get application status for approval
     */
    public function getMyStatuses(): array
    {
        if (in_array($this->status, [self::SUBMITTED])) {
            return [self::APPROVED, self::REJECTED];
        }
        return [];
    }
    /**
     * set color of status
     */
    public function getStatusColorAttribute(): string
    {

        if ($this->status == self::PENDING) {
            $statusColor = "info";
        } else if ($this->status == self::REJECTED) {
            $statusColor = "danger";
        }else if ($this->status == self::SUBMITTED) {
            $statusColor = "primary";
    }else if ($this->status == self::APPROVED) {
            $statusColor = "success";
        }
        else{
            $statusColor = "secondary";
        }
        return $statusColor;
    }

    public static function statuses(): array
    {
        return[
            self::SUBMITTED,
            self::APPROVED,
            self::REJECTED,
        ];
    }

    public function getMessageStatuses(): array
    {
        return [self::REJECTED];
    }
}
