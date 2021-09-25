<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Party;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index($id)
    {
       $party = Party::find($id);
        $candidates = Candidate::query()->where('party_id', $id)->get();
        return view('candidates.index', compact('party','candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

  public function CreateCandidate($id)
    {
        $party = Party::find($id);
        // dd($party);
        return view('candidates.create', compact('party'));
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validator($request);

        // $data = $request->all();

        $product = Candidate::create([
        'name' => $request['name'],
        'candidate_id' => $request['candidate_id'],
        'party_id' =>$request['party_id']
    ]);

        return redirect()->route('candidate.index',[$request->party_id])->with('success', 'candidate added successfully');      //for success message the redirect should be used



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $candidate = Candidate::findOrFail($id)->first();

        return view('candidates.show', compact('candidate'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($CanID, $PartID)
    {
        $candidate = Candidate::findOrFail($CanID);

        $party = Party::findOrFail($PartID);

        return view('candidates.edit', compact('candidate', 'party'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request);

        $candidate = Candidate::findOrFail($id);
        
        $input = $request->all();
        $candidate->update($input);

        return redirect()->route('candidate.index',[$request->party_id])->with('success', 'candidate Updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'candidate deleted successfully');

    }

    public function validator($request){

        $request->validate([
            'name'=>'required',
            'candidate_id'=>'required|unique:candidates|digits_between:2,20'
        ]);
    }
}
