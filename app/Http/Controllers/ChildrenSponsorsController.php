<?php

namespace App\Http\Controllers;

use App\ChildSponsor;
use Illuminate\Http\Request;

class ChildrenSponsorsController extends Controller
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
        $childsponsors = ChildSponsor::all();

        return response()->json($childsponsors);
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
            'childId'=>'required',
            'sponsorId'=>'required',
            // 'deleteFlag'=>false
        ]);

        $childsponsor = ChildSponsor::create($request->all());

        return response()->json([
            'message' => 'ChildSponsor successfully created',
            'childsponsor' => $childsponsor
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param $childId
     * @return \Illuminate\Http\Response
     */
    public function getChildSponsors($childId)
    {
        $childSponsors = ChildSponsor::where('childId', $childId)->with('Sponsor.person')->get();

        return response()->json($childSponsors);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
