<?php

namespace App\Http\Controllers;

use App\FileManager;
use App\Http\Requests\ValidateClaims;
use App\Models\Claim;
use App\Models\Expropriation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('claims.index',[
           'claims'=>Claim::all(),
            'expropriations' => Expropriation::query()
                ->where('status', Expropriation::APPROVED)
                ->where('citizen_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateClaims $request)
    {
        $input = $request->validated();
        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $destinationPath = FileManager::CLAIMS_ATTACHMENT_PATH;
            $path = $file->store($destinationPath);
            $input['attachment'] = str_replace($destinationPath, '', $path);
        }
        $request->user()->claims()->create($input);
        return redirect()->back()->with('success', 'Claim Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function show(Claim $claim)
    {
        return view('claims.show', [
            'expropriation' => $claim,
//            'histories' => $expropriation->histories()->get()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateClaims $request, Claim $claim)
    {
        $input = $request->validated();
        if ($request->file('attachment')) {
            $file = $request->file('attachment');
            $destinationPath = FileManager::CLAIMS_ATTACHMENT_PATH;
            $path = $file->store($destinationPath);
            $input['attachment'] = str_replace($destinationPath, '', $path);
        }
        $claim->update($input);
        return redirect()->back()->with('success', 'Claim updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function destroy(Claim $claim)
    {
        try {
            if ($claim->attachment){
                Storage::delete($claim->getAttachment());
            }
            $claim->delete();
            return redirect()->back()->with('success','Claim deleted successfully');
        }catch (Exception $exception){
            return redirect()->back()->with('success',"Claim can\'t be delete! Please try again later.");
        }
    }

    public function submit(Claim $claim)
    {
        $claim->update([
            'status' => Claim::SUBMITTED,
        ]);
        return redirect()->route('admin.claims.index')->with('success', 'Claim submitted successfully');
    }
    public function review(Request $request,Claim $claim)
    {
        $claim->update([
            'status' => $request->status,
            'comment' => $request->comment
        ]);
        return redirect()->route('admin.claims.index')->with('success', 'Claim reviewed successfully');
    }
}
