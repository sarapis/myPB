<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Functions\Airtable;
use App\Agency;
use App\Airtables;

class AgencyController extends Controller
{

    public function airtable()
    {

        Agency::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appeLDUKUOowGqOP5',
        ));

        $request = $airtable->getContent( 'Agency_CBO' );

        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $agency = new Agency();
                $agency->recordid = $record[ 'id' ];
                $agency->agency_code = isset($record['fields']['Agency_Code'])?$record['fields']['Agency_Code']:null;
                $agency->agency_name = isset($record['fields']['Agency_Name'])?$record['fields']['Agency_Name']:null;
                $agency->projects = isset($record['fields']['Projects'])? implode(",", $record['fields']['Projects']):null;
                $agency->website = isset($record['fields']['Website'])?$record['fields']['Website']:null;
                $agency->contacts = isset($record['fields']['Contacts'])? implode(",", $record['fields']['Contacts']):null;
                $agency ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtables::where('name', '=', 'Agency')->first();
        $airtable->records = Agency::count();
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
        $agencies = Agency::orderBy('agency_code')->get();

        return view('backEnd.tables.tb_agency', compact('agencies'));
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
        $agency= Agency::find($id);
        return response()->json($agency);
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
        $agency = Agency::find($id);
        $agency->agency_code = $request->agency_code;
        $agency->agency_name = $request->agency_name;
        $agency->website = $request->website;
        $agency->flag = 'modified';
        $agency->save();

        return response()->json($agency);
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
