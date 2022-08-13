<?php

function countBranches(): int
{
    $user=auth()->user();
    return 5;
}

function countServiceProviders(): int
{
    return 5;
}

function countServices(): int
{
    return 5;
}
function countTransactions(): int
{
    $user=auth()->user();
    return 5;
}

function chargesPerService(): \Illuminate\Support\Collection
{
    $user=auth()->user();
   $transactions= collect();
   $data=collect();
   foreach ($transactions as $transaction){
       $data->put($transaction->name,intval($transaction->sum));
   }
   return $data;

}

function chargesPerMonth(): \Illuminate\Support\Collection
{
    $user=auth()->user();
    $transactions= collect();
    $data=collect();

    for ($i=1;$i<=12;$i++){
        $monthName=date('F', mktime(0, 0, 0, $i, 10));
        $data->put($monthName,$transactions->where("month",$i)->sum("sum"));
    }

    return $data;

}
function salesPerMonth(): \Illuminate\Support\Collection
{
    $user=auth()->user();

    return collect();

}

function monthlyAmount($value="amount")
{
    $user=auth()->user();
    return 5;
}

function annualAmount($value="amount")
{
    $user=auth()->user();
    return 5;
}

function totalTransations()
{
    return \App\Models\Expropriation::query()
        ->where('status', \App\Models\Expropriation::APPROVED)
        ->sum("amount");
}

function totalRejected(): int
{
    return \App\Models\Expropriation::query()
        ->where('status', \App\Models\Expropriation::REJECTED)
        ->count();
}

function totalApproved(): int
{
    return \App\Models\Expropriation::query()
        ->where('status', \App\Models\Expropriation::APPROVED)
        ->count();
}

function getExpropriationItems(\App\Models\Expropriation $expropriation)
{
    $items = '';
    foreach ($expropriation->details as $detail)
    {
        $items .= $detail->quantity ." ". optional($detail->item)->name . ", ";
    }

    return $items;
}

function expropriatedPropertyByType($propertyType = 1)
{
    $type = \App\Models\PropertyType::find($propertyType)->name_en;
    $count= \App\Models\Expropriation::query()
        ->where('status', "<>", \App\Models\Expropriation::PENDING)
        ->where('property_type_id', $propertyType)
        ->count();
    return json_decode(json_encode(['name'=>str_plural($type), 'count'=>$count]));
}

function canReviewExpropriation(\App\Models\Expropriation $expropriation): bool
{
    $user = auth()->user();
    if (in_array($expropriation->status, [\App\Models\Expropriation::SUBMITTED]) && $user->can('Approve Expropriation')) {
        return true;
    }
    return false;
}
