<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Functions\Airtable;
use App\Project;
use App\Airtables;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function airtable()
    {

        Project::truncate();
        $airtable = new Airtable(array(
            'api_key'   => 'keyIvQZcMYmjNbtUO',
            'base'      => 'appeLDUKUOowGqOP5',
        ));

        $request = $airtable->getContent( 'Projects' );
        $size = '';
        do {


            $response = $request->getResponse();

            $airtable_response = json_decode( $response, TRUE );

            foreach ( $airtable_response['records'] as $record ) {

                $project = new Project();
                $project->recordid = $record[ 'id' ];
                $project->project_id = isset($record['fields']['Project_ID'])?$record['fields']['Project_ID']:null;
                $project->project_title = isset($record['fields']['Project_Title'])?$record['fields']['Project_Title']:null;
                $project->project_description = isset($record['fields']['Project_Description'])?$record['fields']['Project_Description']:null;
                $project->project_status = isset($record['fields']['Project_Status'])?$record['fields']['Project_Status']:null;
                $project->category_re_coded = isset($record['fields']['Category_re-coded'])?implode(",", $record['fields']['Category_re-coded']):null;
                // if(isset($record['fields']['Project_Status']))
                // {
                //     $flag = array('Not funded: Lost vote'=> 3, 'Not funded: Not Eligible'=>3, 'Not funded: Requires Additional Funds'=>3, 'Not funded: Funds Not Appropriated'=>3,'In process: Funds Appropriated'=>2, 'In process: In Design'=>2, 'In process: Out for Bid'=> 2, 'In process: Part of Capital Plan - Funding Approved'=> 2,  'In process: Pre-construction'=> 2, 'In process: PREPARING BID'=> 2, 'In process: Scoping'=>2, 'In process: Under Construction'=>2, 'Complete'=>1, 'Project Status Needed'=>4);
                //     $project->project_status_flag = $flag[$record['fields']['Project_Status']];                    
                // }
                $project->project_status_category = isset($record['fields']['Project_Status_Category'])?$record['fields']['Project_Status_Category']:null;
                $project->project_status_detail = isset($record['fields']['Project_Status_Detail'])?$record['fields']['Project_Status_Detail']:null;
                $project->status_date_updated = isset($record['fields']['Status_date_updated'])?$record['fields']['Status_date_updated']:null;
                $project->agency_code = isset($record['fields']['Agency_Code'])?implode(",", $record['fields']['Agency_Code']):null;
                $project->process_id = isset($record['fields']['Process_ID'])? implode(",", $record['fields']['Process_ID']):null;

                $project->source_ballot_link = isset($record['fields']['Source_Ballot_Link'])?$record['fields']['Source_Ballot_Link']:null;
                $project->district_ward_name = isset($record['fields']['District-Ward_Name'])? implode(",", $record['fields']['District-Ward_Name']):null;
                $project->win_text = isset($record['fields']['Win_Text'])?$record['fields']['Win_Text']:null;
                $project->win_calculate = isset($record['fields']['Win_Calculate'])?$record['fields']['Win_Calculate']:null;
                $project->votes = isset($record['fields']['Votes'])?$record['fields']['Votes']:0;
                $project->vote_date = isset($record['fields']['Vote_Date'])?$record['fields']['Vote_Date']:null;
                $project->pb_cycle = isset($record['fields']['PB_Cycle'])?$record['fields']['PB_Cycle']:null;
                $project->cost_text = isset($record['fields']['Cost_Text'])?$record['fields']['Cost_Text']:null;
                $project->cost_num = isset($record['fields']['Cost_Num'])? $record['fields']['Cost_Num']:null;
                $project->fiscal_year = isset($record['fields']['fiscal_year'])? $record['fields']['fiscal_year']:null;              
                $project->cost_appropriated = isset($record['fields']['cost_appropriated'])? $record['fields']['cost_appropriated']:null;
                $project->cost_subproject = isset($record['fields']['cost_subproject'])? $record['fields']['cost_subproject']:null;
                $project->vote_year = isset($record['fields']['Vote_Year'])?implode(",", $record['fields']['Vote_Year']):null;
                $project->category_topic_committee_raw = isset($record['fields']['Category_Topic_Committee_Raw'])? $record['fields']['Category_Topic_Committee_Raw']:null;
                $project->category_type_topic_standardize = isset($record['fields']['Category_Type_Topic_Standardize'])? $record['fields']['Category_Type_Topic_Standardize']:null;
                $project->project_location_raw = isset($record['fields']['Project_Location_Raw'])?$record['fields']['Project_Location_Raw']:null;
                $project->project_address_clean = isset($record['fields']['Project_Address_Clean'])?$record['fields']['Project_Address_Clean']:null;
                $project->location_city = isset($record['fields']['Location_City'])?$record['fields']['Location_City']:null;
                $project->state = isset($record['fields']['State'])?$record['fields']['State']:null;
                $project->country = isset($record['fields']['Country'])?$record['fields']['Country']:null;
                $project->zipcode = isset($record['fields']['Zipcode'])?$record['fields']['Zipcode']:null;
                $project->full_address = isset($record['fields']['Full_Address'])?$record['fields']['Full_Address']:null;
                $project->latitude = isset($record['fields']['Latitude'])?$record['fields']['Latitude']:null;
                $project->longitude = isset($record['fields']['Longitude'])?$record['fields']['Longitude']:null;
                $project->neighborhood = isset($record['fields']['Neighborhood'])?$record['fields']['Neighborhood']:null;
                $project->census_tract_or_local_id = isset($record['fields']['Census_Tract-or-Local_ID'])?$record['fields']['Census_Tract-or-Local_ID']:null;
                $project->bin = isset($record['fields']['BIN'])?$record['fields']['BIN']:null;
                $project->borough_code = isset($record['fields']['Borough_Code'])?$record['fields']['Borough_Code']:null;
                $project->name_dept_agency_cbo = isset($record['fields']['Name_Dept_Agency_CBO'])? implode(",", $record['fields']['Name_Dept_Agency_CBO']):null;
                
                $project->agency_project_code = isset($record['fields']['Agency_Project_Code'])?$record['fields']['Agency_Project_Code']:null;

                $project->project_budget_type = isset($record['fields']['Project_Budget_Type'])?$record['fields']['Project_Budget_Type']:null;
                
                $project ->save();

            }
           
        }
        while( $request = $response->next() );

        $date = date("Y/m/d H:i:s");
        $airtable = Airtables::where('name', '=', 'Projects')->first();
        $airtable->records = Project::count();
        $airtable->syncdate = $date;
        $airtable->save();
    }


    public function index()
    {
        $projects = Project::orderBy('project_id')->paginate(20);

        return view('backEnd.tables.tb_projects', compact('projects'));
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
        $project = Project::find($id);
        return response()->json($project);
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
        $project = Project::find($id);
        // $project = Project::where('id', '=', $id)->first();
        $project->project_id = $request->project_id;
        $project->project_title = $request->project_title;
        $project->project_description = $request->project_description;
        $project->project_status_category = $request->project_status_category;
        $project->status_date_updated = $request->status_date_updated;
        $project->source_ballot_link = $request->source_ballot_link;
        $project->win_text = $request->win_text;
        $project->win_calculate = $request->win_calculate;
        $project->votes = $request->votes;
        $project->vote_date = $request->vote_date;
        $project->pb_cycle = $request->pb_cycle;
        $project->cost_text = $request->cost_text;
        $project->cost_num = $request->cost_num;
        $project->category_topic_committee_raw = $request->category_topic_committee_raw;
        $project->category_type_topic_standardize = $request->category_type_topic_standardize;
        $project->project_location_raw = $request->project_location_raw;
        $project->project_address_clean = $request->project_address_clean;
        $project->location_city = $request->location_city;
        $project->country = $request->country;
        $project->zipcode = $request->zipcode;
        $project->full_address = $request->full_address;
        $project->latitude = $request->latitude;
        $project->longitude = $request->longitude;
        $project->neighborhood = $request->neighborhood;
        $project->census_tract_or_local_id = $request->census_tract_or_local_id;
        $project->bin = $request->bin;
        $project->borough_code = $request->borough_code;
        $project->name_dept_agency_cbo = $request->name_dept_agency_cbo;
        $project->agency_project_code = $request->agency_project_code;
        $project->project_budget_type = $request->project_budget_type;
        $project->flag = 'modified';
        $project->save();
        // var_dump($project);
        // exit();
        return response()->json($project);
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
