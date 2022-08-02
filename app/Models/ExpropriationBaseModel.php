<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpropriationBaseModel extends Model
{
    use HasFactory;

    //application statuses
    const DRAFT = "Draft";
    const SUBMITTED = "Submitted";
    const UNDER_REVIEW = "Under review";
    const REVIEWED = "Reviewed";
    const APPROVED = "Approved";
    const REJECTED = "Rejected";
    const SUSPENDED = "Suspended";
    const RETURN_BACK = "Returned";
    const PROPOSE_TO_APPROVE = "Propose to approve";
    const PROPOSE_TO_RETURN_BACK = "Propose to return";
    const PROPOSE_TO_REJECT = "Propose to reject";
    const RETURN_BACK_TO_REVIEW="Returned for review";

    /**
     * get application status for approval
     */
    public function getMyStatuses(): array
    {
        if (in_array($this->status, [self::SUBMITTED])) {
            return [self::PROPOSE_TO_APPROVE, self::REJECTED];
        }
        if ($this->status == self::REVIEWED) {
            if (in_array($this->review_decision, [self::PROPOSE_TO_APPROVE])) {
                return [self::APPROVED,self::RETURN_BACK_TO_REVIEW];
            } else if (in_array($this->review_decision, [self::PROPOSE_TO_RETURN_BACK])) {
                return [self::RETURN_BACK,self::RETURN_BACK_TO_REVIEW];
            } else {
                return [self::REJECTED,self::RETURN_BACK_TO_REVIEW];
            }
        }
        return [];
    }
    /**
     * set color of application status
     */
    public function getStatusColorAttribute(): string
    {
        if (in_array($this->status, [self::PROPOSE_TO_APPROVE,self::REVIEWED])) {
            $statusColor = "info";
        } else if (in_array($this->status, [self::REJECTED, self::PROPOSE_TO_REJECT, self::SUSPENDED])) {
            $statusColor = "danger";
        } else if (in_array($this->status, [self::DRAFT, self::PROPOSE_TO_RETURN_BACK, self::RETURN_BACK,self::RETURN_BACK_TO_REVIEW])) {
            $statusColor = "warning";
        }else if (in_array($this->status, [self::UNDER_REVIEW,self::SUBMITTED])) {
            $statusColor = "primary";
        }else{
            $statusColor = "success";
        }
        return $statusColor;
    }

    public static function statuses(): array
    {
        return[
            self::SUBMITTED,
//            self::UNDER_REVIEW,
            self::REVIEWED,
            self::APPROVED,
//            self::RETURN_BACK,
            self::REJECTED,
        ];
    }

    public function getMessageStatuses(): array
    {
        return [self::PROPOSE_TO_RETURN_BACK, self::PROPOSE_TO_REJECT, self::RETURN_BACK, self::REJECTED];
    }
}
