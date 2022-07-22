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
function isNotBranch(): bool
{
    $user=auth()->user();
    return !$user->branch_id;
}
