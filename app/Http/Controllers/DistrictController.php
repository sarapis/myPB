<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Functions\Airtable;
use App\District;
use App\Airtables;

class DistrictController extends Controller
{

    public function airtable()
    {

        District::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appeLDUKUOowGqOP5',
        ));

        $request = $airtable->getContent( 'District-Ward' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $district = new District();
                $district->recordid = $record[ 'id' ];
                $district->name = isset($record['fields']['Name'])?$record['fields']['Name']:null;
                $district->projects = isset($record['fields']['Projects'])? implode(",", $record['fields']['Projects']):null;
                $district->active_pb = isset($record['fields']['Active_PB'])?$record['fields']['Active_PB']:null;
                $district->processes_annual = isset($record['fields']['Processes_Annual'])? implode(",", $record['fields']['Processes_Annual']):null;
                $district->contact_district = isset($record['fields']['Contact_District'])? implode(",", $record['fields']['Contact_District']):null;
                $district->cityCouncilDistrict = isset($record['fields']['cityCouncilDistrict'])?$record['fields']['cityCouncilDistrict']:null;
                $district ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtables::where('name', '=', 'District-Ward')->first();
        $airtable->records = District::count();
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
        $districts = District::orderBy('name')->get();

        return view('backEnd.tables.tb_district', compact('districts'));
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
        $district= District::find($id);
        return response()->json($district);
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
        $district = District::find($id);
        $district->name = $request->name;
        $district->active_pb = $request->active_pb;
        $district->flag = 'modified';
        $district->save();

        return response()->json($district);
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
