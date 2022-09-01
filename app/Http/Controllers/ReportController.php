<?php

namespace App\Http\Controllers;

use App\Exports\ExpropriationReport;

use App\Models\Expropriation;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function expropriations(Request $request)
    {
        $data=Expropriation::query()->with(["citizen","propertyType","province","district","sector"])
            ->when($request->start_date,function (Builder $builder) use ($request){
                return $builder->whereDate("created_at",'>=',$request->start_date);
            })
            ->when($request->end_date,function (Builder $builder) use ($request){
                return $builder->whereDate("created_at",'<=',$request->end_date);
            })
            ->when($request->status,function (Builder $builder) use ($request){
                return $builder->whereIn("status",$request->status);
            })
            ->when($request->citizens, function (Builder $builder) use ($request) {
                return $builder->whereIn("citizen_id",$request->citizens);
            })
            ->when($request->property_types, function (Builder $builder) use ($request) {
                return $builder->whereIn("property_type_id",$request->property_types);
            })
            ->when($request->provinces, function (Builder $builder) use ($request) {
                return $builder->whereIn("province_id",$request->provinces);
            })
            ->when($request->districts, function (Builder $builder) use ($request) {
                return $builder->whereIn("district_id",$request->districts);
            })
            ->when($request->sectors, function (Builder $builder) use ($request) {
                return $builder->whereIn("sector_id",$request->sectors);
            })
            ->select("expropriations.*");
        if($request->is_download==1){
            if ($request->type=="pdf"){
                return PDF::loadView('reports.expro-pdf',['title'=>'Expropriations Report', 'expropriations'=>$data->get()])
                    ->setPaper('a4', 'landscape')
                    ->download("expropriations.pdf");
            }else{
                $time=time();
                $name = "expropriations_$time.xlsx";
                return Excel::download(new ExpropriationReport($data, $title = "Expropriations Report"), $name);
            }
        }
        $provinces=Province::all();
        $propertyTypes=PropertyType::all();
        $citizens = User::query()->where("is_citizen",1)->get();
        $expropriations = $data->get();
        return view("reports.expropriations",compact('provinces','propertyTypes','citizens','expropriations'));
    }

}
