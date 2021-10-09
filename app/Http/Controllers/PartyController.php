<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Party;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PartyRequest;
use App\Http\Controllers\Controller;
use Validator;
use File;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parties = Party::with('candidate')->get();
        // dd($parties);

        $candidate_delete_request_Noti = Candidate::with('Party')->whereNotNull('delete_request')->get()->all();
        // dd($candidate_delete_request_Noti);
        return view('politicalParty.index', compact('parties', 'candidate_delete_request_Noti'));
        
        // $candidate = $party->candidate;

        // dd($party);

        //  // dd($party);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('politicalParty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartyRequest $request)

    {
            
            $party = $request->validated(); 

            $party = $request->all();
            

            if ($image = $request->file('party_logo')) {

            $destinationPath = 'party_logos/';

            $imageName =  time().'.'.$image->extension();

            $image->move($destinationPath, $imageName);

            $party['party_logo'] = "$imageName";

                 }

            Party::create($party);

            
            return redirect()->route('party.index')->with('success', 'Party Added successfully');
    }
 
     


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $party = Party::find($id);
        // dd($party);
        return view('politicalParty.show', compact('party'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $party = Party::find($id);

        return view('politicalParty.edit', compact('party'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartyRequest $request, $id)
    {
        $party = $request->validated();          //as we hve used th form 
        $party = Party::find($id);

        $input = $request->all();

        $file_path = public_path('party_logos').'/'.$party->party_logo; 

          if(File::exists($file_path)){

        File::delete($file_path);

        }

         if ($image = $request->file('party_logo')) {

            $destinationPath = 'party_logos/';

            $imageName = time() . "." . $image->getClientOriginalExtension();

            $image->move($destinationPath, $imageName);

            $input['party_logo'] = "$imageName";

        }else{

            unset($input['party_logo']);

        }

        $party->update($input);

        \Session::flash('msg', 'Party Updated successfully.' );
        return redirect()->route('party.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $party_logo)
    {
        $party = Party::find($id); //Reports is my model

         $file_path = public_path('party_logos').'/'.$party->party_logo; 

          if(File::exists($file_path)){

        File::delete($file_path); 
        $party->delete(); 

        }

         return redirect()->back()->with('success', 'Party Deleted successfully');

    }
}
