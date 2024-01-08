<?php

namespace App\Http\Controllers;

use App\Models\MhsAgenda;
use Illuminate\Http\Request;
use App\DataTables\MhsAgendaDataTable;

class MhsAgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MhsAgendaDataTable $dataTable)
    {
        return $dataTable->render('mahasiswa.agenda.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MhsAgenda  $mhsAgenda
     * @return \Illuminate\Http\Response
     */
    public function show(MhsAgenda $mhsAgenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MhsAgenda  $mhsAgenda
     * @return \Illuminate\Http\Response
     */
    public function edit(MhsAgenda $mhsAgenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MhsAgenda  $mhsAgenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MhsAgenda $mhsAgenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MhsAgenda  $mhsAgenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(MhsAgenda $mhsAgenda)
    {
        //
    }
}
