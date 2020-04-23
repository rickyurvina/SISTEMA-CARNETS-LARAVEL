<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Institution;
use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $institutions=Institution::pluck('INS_NOMBRE','id');
        $institution_id=$request->get('institution_id');
        if (!empty($institution_id))
        {
            $people=Person::orderBy('institution_id','DESC')
                ->where('institution_id',$institution_id)
                ->paginate(10);
        }
        else{
            $people=Person::orderBy('institution_id','DESC')
                ->paginate(5);
        }
        if (empty($people))
        {
            return view('identification.people.index', compact('people','institutions'));
        }
        return view('identification.people.index', compact('people','institutions'))->with('info','No se encontro esa persona');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $institutions=Institution::pluck('INS_NOMBRE','id');
        return view('identification.people.create',[
            'person'=>new Person,
            'institution'=>$institutions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonRequest $request)
    {
        //
        Person::create($request->validated());
        return redirect()
            ->route('person.index')
            ->with('info','Usuario registrado exitosamente');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return view('identification.people.show',[
            'person'=>$person
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        $institutions=Institution::pluck('INS_NOMBRE','id');
        return view('identification.people.edit',[
            'person'=>$person,
            'institution'=>$institutions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(PersonRequest $request, Person $person)
    {
        //
        $person->update( $request->validated() );
        return redirect()
            ->route('person.show',$person)
            ->with('info','Curso actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Person::findOrFail($id)->delete();
        return redirect()->route('person.index')->with('info','Usuario eliminado exitosamente');

    }
}
