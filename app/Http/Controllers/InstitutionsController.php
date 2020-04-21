<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitutionMesageRequest;
use App\Institution;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;

class InstitutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showIE(Request $request){
        $INS_TIPO='Educativa';
        $institutions=Institution::latest('created_at')
            ->where('INS_TIPO','LIKE',"% $INS_TIPO%")
            ->paginate(5);
        return view('identification.institutions.index',compact('institutions'));
    }
    public function showO(Request $request){
        $INS_TIPO='Organisación';
        $institutions=Institution::latest('created_at')
            ->where('INS_TIPO','LIKE',"%$INS_TIPO%")
            ->paginate(5);
        return view('identification.institutions.index',compact('institutions'));
    }

    public function index(Request $request)
    {
        $INS_NOMBRE=$request->get('INS_NOMBRE');
        $institutions=Institution::latest('created_at')
        ->where('INS_NOMBRE','LIKE',"%$INS_NOMBRE%")
        ->paginate(5);
        return view('identification.institutions.index',compact('institutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('identification.institutions.create',[
            'institution'=>new Institution
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitutionMesageRequest $request)
    {
        Institution::create($request->validated());
        return redirect()
            ->route('institution.index')
            ->with('info','Institución registrada exitosamente');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show(Institution $institution)
    {
//        $institution=Institution::findOrFail($institution);
//        return view('identification.institutions.institutions.show',compact('institutions'));
        return view('identification.institutions.show',[
            'institution'=>$institution
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution)
    {
        return view('identification.institutions.edit',[
            'institution'=>$institution
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(InstitutionMesageRequest $request, Institution $institution)
    {
        $institution->update( $request->validated() );
        return redirect()
            ->route('institution.show',$institution)
            ->with('info','Institución actualizada exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Institution::findOrFail($id)->delete();
        return redirect()->route('institution.index')->with('info','Institución eliminada exitosamente');
    }
}
