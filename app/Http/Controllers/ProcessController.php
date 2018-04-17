<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Functions\Airtable;
use App\Process;
use App\Airtables;

class ProcessController extends Controller
{

    public function airtable()
    {

        Process::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appeLDUKUOowGqOP5',
        ));

        $request = $airtable->getContent( 'Processes_Annual' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $process = new Process();
                $process->recordid = $record[ 'id' ];
                $process->name_process_annual = isset($record['fields']['Name_Process_Annual'])?$record['fields']['Name_Process_Annual']:null;
                $process->projects = isset($record['fields']['Projects'])? implode(",", $record['fields']['Projects']):null;
                $process->vote_year = isset($record['fields']['Vote_Year'])?$record['fields']['Vote_Year']:null;
                $process->process_name = isset($record['fields']['Process_Name'])?$record['fields']['Process_Name']:null;
                $process->district_ward_name = isset($record['fields']['District-Ward_Name'])? implode(",", $record['fields']['District-Ward_Name']):null;
                $process->voters = isset($record['fields']['Voters'])? implode(",", $record['fields']['Voters']):null;       
                $process->city = isset($record['fields']['City'])?$record['fields']['City']:null;
                
                $process ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtables::where('name', '=', 'Processes_Annual')->first();
        $airtable->records = Process::count();
        $airtable->syncdate = $date;
        $airtable->save();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::orderBy('name_process_annual')->paginate(15);

        return view('backEnd.tables.tb_process', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $process= Process::find($id);
        return response()->json($process);
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
        $process = Process::find($id);
        // $project = Project::where('id', '=', $id)->first();
        $process->name_process_annual = $request->name_process_annual;
        $process->vote_year = $request->vote_year;
        $process->process_name = $request->process_name;
        $process->voters = $request->voters;
        $process->city = $request->city;
        $process->flag = 'modified';
        $process->save();
        // var_dump($project);
        // exit();
        return response()->json($process);
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
