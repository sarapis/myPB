<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Functions\Airtable;
use App\Community;
use App\Agency;
use App\Airtables;

class CommunityController extends Controller
{

    public function airtable()
    {

        Community::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appeLDUKUOowGqOP5',
        ));

        $request = $airtable->getContent( 'Community_Board' );

        do {

            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $community = new Community();
                $community->recordid = $record[ 'id' ];
                $community->community_board = isset($record['fields']['Community Board'])?$record['fields']['Community Board']:null;
                $community->district_ward = isset($record['fields']['District-Ward'])? implode(",", $record['fields']['District-Ward']):null;
                $community->cccnewyork = isset($record['fields']['Citizen\'s Committee for Children'])?$record['fields']['Citizen\'s Committee for Children']:null;
                $community->data2go = isset($record['fields']['Data2go.NYC'])?$record['fields']['Data2go.NYC']:null;
                $community->community_profiles_planning = isset($record['fields']['Community Profiles @ Planning NYC'])?$record['fields']['Community Profiles @ Planning NYC']:null;
                $community->civicdashboards = isset($record['fields']['Civic Dashboards'])?$record['fields']['Civic Dashboards']:null;
                $community->nyc_boroughs = isset($record['fields']['NYC Boroughs'])?$record['fields']['NYC Boroughs']:null;
                $community->nyc_community_board = isset($record['fields']['NYC Community Board'])?$record['fields']['NYC Community Board']:null;
                $community ->save();

            }
            
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtables::where('name', '=', 'Community_Board')->first();
        $airtable->records = Community::count();
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
