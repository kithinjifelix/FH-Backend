<?php

namespace App\Http\Controllers;

use App\Person;
use App\Child;
use App\Sponsor;
use Illuminate\Http\Request;

class PersonController extends Controller
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
        $persons = Person::all();

        return response()->json($persons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function findSponsors(Request $request){
        $persons = Person::join('sponsors', function($join) {
            $join->on('people.id', '=', 'sponsors.personId');
        })
        ->where(function($query) use ($request) {
            if($request->firstName!='')
                $query->where('firstName', 'ilike',  $request->firstName );
            if($request->middleName!='')
                $query->where('middleName', 'ilike', $request->middleName);
            if($request->lastName!='')
                $query->where('lastName', 'ilike', $request->lastName);
        })
        ->get();

        return response()->json($persons);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getChildrenOrSponsors(Request $request)
    {
        $persontype = $request->input('persontype');
        $firstName =  $request->input('firstName');

        $persons;

        if($persontype == 1) {
            $persons = Person::join('children', function($join) {
                $join->on('people.id', '=', 'children.personId');
            })
            ->where(function($query) use ($request) {
                if($request->firstName!='')
                    $query->where('firstName', 'ilike',  $request->firstName );
                if($request->middleName!='')
                    $query->where('middleName', 'ilike', $request->middleName);
                if($request->lastName!='')
                    $query->where('lastName', 'ilike', $request->lastName);
                $query->where('sex', $request->sex);
            })
            ->get();
        }else if($persontype == 2){
            $persons = Person::join('sponsors', function($join) {
                $join->on('people.id', '=', 'sponsors.personId');
            })
            ->where(function($query) use ($request) {
                if($request->firstName!='')
                    $query->where('firstName', 'ilike',  $request->firstName );
                if($request->middleName!='')
                    $query->where('middleName', 'ilike', $request->middleName);
                if($request->lastName!='')
                    $query->where('lastName', 'ilike', $request->lastName);
                $query->where('sex', $request->sex);
            })
            ->get();
        } else {
            $persons = Person::all();
        }

        return response()->json($persons);
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
            'firstName'=>'required',
            'lastName'=>'required',
            'dob'=>'required',
            'sex'=>'required',
            'registrationDate'=>'required'
        ]);

        $input = $request->all();
        $personType = $request->persontype;
        unset($input['persontype']);

        $person = Person::create($input);

        $childId = 0;
        if($request->persontype == 1){
            $child = new Child();
            $child->personId = $person->id;
            $child->deleteFlag = false;
            $child->save();

            $childId = $child->id;
        }else{
            $sponsor = new Sponsor();
            $sponsor->personId = $person->id;
            $sponsor->deleteFlag = false;
            $sponsor->save();
        }

        return response()->json([
            'message' => 'Person successfully created',
            'person' => $person,
            'childId' => $childId
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return $person;
    }

    /**
     * Display the specified resource.
     *
     * @param $Id
     * @return \Illuminate\Http\Response
     */
    public function getPersonById($Id)
    {
        $person = Person::find($Id);

        return response()->json($person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $Id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Id)
    {
        /*$request->validate([
            'title' => 'nullable',
            'description' => 'nullable'
         ]);*/
 
        $input = $request->all();
        unset($input['persontype']);
        $person = Person::find($Id);
        $person->update($input);
 
         return response()->json([
             'message' => 'Successfully update person',
             'person' => $person
         ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();

        return response()->json([
            'message' => 'Successfully deleted person!'
        ]);
    }
}
