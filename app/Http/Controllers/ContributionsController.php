<?php

namespace App\Http\Controllers;

use App\ChildSponsor;
use App\Contributions;
use Illuminate\Http\Request;

class ContributionsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contributions = Contributions::all();

        return response()->json($contributions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'childSponsorId' => 'required',
            'amount'=>'required',
            'contributionDate'=>'required'
        ]);

        $contribution = Contributions::create($request->all());

        return response()->json([
            'message' => 'Contribution successfully created',
            'contribution' => $contribution
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $childId
     * @return \Illuminate\Http\Response
     */
    public function show($childId)
    {
        $contributions = Contributions::join('child_sponsors', function($join) {
            $join->on('child_sponsors.id', '=', 'contributions.childSponsorId');
        })
        ->where(function($query) use ($childId) {
            $query->where('child_sponsors.childId', $childId);
        })
        ->get();

        return response()->json($contributions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
