<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\District;
use App\Contact;
use App\Agency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use PDF;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
            $districts = District::orderBy('name')->get();
            $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
            $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
            $cities = Agency::whereNotNull('projects')->orderBy('agency_name')->get(['agency_name']);
            $address_district= District::where('name', '=', 1)->get();
            

            if ($request->input('search')) {

                $search = $request->input('search');
                $projects= Project::with('district')->where('project_title', 'like', '%'.$search.'%')->orwhere('project_description', 'like', '%'.$search.'%')->orwhere('neighborhood', 'like', '%'.$search.'%')->orwhereHas('district', function ($q)  use($search){
                    $q->where('name', 'like', '%'.$search.'%');
                })->sortable()->paginate(20);

                return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities', 'address_district'));
            }

            if ($request->input('address')) {
                $location = $request->input('address');
                // var_dump($location);
                // exit();
                $location = str_replace("+","%20",$location);
                $location = str_replace(",",",",$location);
                $location = str_replace(" ","%20",$location);
                

                $content = file_get_contents("https://geosearch.planninglabs.nyc/v1/autocomplete?text=".$location);


                $result  = json_decode($content);
                
                // var_dump($result->features[0]);
                // exit();
                //$housenumber=$result->features[3]->properties->housenumber;
                // var_dump($housenumber);
                // exit();
                $name=$result->features[0]->properties->name;
                $zip=$result->features[0]->properties->postalcode;
                // var_dump($street, $zipcode);
                // exit();
                $name = str_replace(" ","%20",$name);
                $url = 'https://api.cityofnewyork.us/geoclient/v1/place.json?name=' . $name . '&zip=' . $zip . '&app_id=0359f714&app_key=27da16447759b5111e7dcc067d73dfc8';

                $geoclient = file_get_contents($url);

                $geo  = json_decode($geoclient);

                $cityCouncilDistrict=$geo->place->cityCouncilDistrict;
                
                $projects= Project::with('district')->orwhereHas('district', function ($q)  use($cityCouncilDistrict){
                    $q->where('cityCouncilDistrict', '=', $cityCouncilDistrict);
                })->sortable()->paginate(20);

                $address_district=District::where('cityCouncilDistrict', '=', $cityCouncilDistrict)->first();
                
                
                if($address_district == NULL){

                    $projects = Project::where('project_title', '=', 'aaaaa')->paginate(20);
                    $address_district = "";
                    return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities', 'address_district','location'))->with('success','no project');
                }
                
                $address_district=$address_district->name;
                
                return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities', 'address_district','location'));
            }

        $projects = Project::sortable()->paginate(20);

        $location_maps = Project::all();
        
        return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities', 'count', 'address_district', 'location_maps'));
    }

  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $districts = District::orderBy('name')->get();
        $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
        $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
        $cities = Agency::whereNotNull('projects')->orderBy('agency_name')->get(['agency_name']);

        $project = Project::where('project_title', '=', $id)->first();
        $district = $project->district_ward_name;
        $contact = Contact::where('district_ward_name', 'like', '%'.$district.'%')->first();
        return view('frontEnd.profile', compact('districts', 'states', 'categories', 'cities', 'project', 'contact'))->render();
    }


    public function district($id)
    {
            $districts = District::orderBy('name')->get();
            $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
            $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
            $cities = Agency::whereNotNull('projects')->orderBy('agency_name')->get(['agency_name']);
            $address_district= District::where('cityCouncilDistrict', '=', $id)->first()->name;
            
            $distinct_name = District::where('cityCouncilDistrict', '=', $id)->first()->recordid;
            $projects = Project::where('district_ward_name', '=', $distinct_name)->paginate(20);

            $location_maps = Project::where('district_ward_name', '=', $distinct_name)->get();
            
            return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities', 'count', 'address_district', 'location_maps'))->render();
    }

    public function filterexplore(Request $request)
    {
       
                
                $price_min = (int)$request->input('price_min');
                $price_max = (int)$request->input('price_max');
                $year_min = $request->input('year_min');
                $year_max = $request->input('year_max');
                $vote_min = (int)$request->input('vote_min');
                $vote_max = (int)$request->input('vote_max');

                $search = $request->input('Search');


                // $district = $request->input('District');
                $status = $request->input('Status');

                $category = $request->input('Category');        
                $city = $request->input('City');

                $sort = $request->input('selected_sort');
                $location = $request->input('address');
                // var_dump($location);
                // exit();
                $profile_name = $request->input('profile_name');


                $projects = Project::whereBetween('cost_num', [$price_min, $price_max])->whereBetween('votes', [$vote_min, $vote_max])->whereBetween('vote_year', [$year_min, $year_max]);
                           
               
                if ($profile_name!=null) {

                    $districts = District::orderBy('name')->get();
                    $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
                    $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
                    $cities = Agency::whereNotNull('projects')->orderBy('agency_name')->get(['agency_name']);

                    $project = Project::where('project_title', '=', $profile_name)->first();

                    // var_dump($project);
                    // exit();
                    $district = $project->district_ward_name;

                    $contact = Contact::where('district_ward_name', 'like', '%'.$district.'%')->first();

                    return view('frontEnd.profile1', compact('districts', 'states', 'categories', 'cities', 'project', 'contact'));
                }
          
                // if($district!=NULL){

                //     $district = District::where('name', '=', $district)->first();
                //     $district = $district->recordid;
                //     $projects = $projects->where('district_ward_name', '=', $district);
                    
                // }
                
                if($status!=NULL){

                    $projects = $projects->where('project_status_category', 'like', '%'.$status.'%');
                }

                if($category!=NULL){
                    $projects = $projects->where('category_type_topic_standardize', '=', $category);
                }

                if($city!=NULL){
                    
                    $projects = $projects->where('name_dept_agency_cbo', '=', $city);
                }
                
                if($sort!=NULL){

                    if($sort=='Price: Low to High'){
                        $projects = $projects->orderBy('cost_num');
                    }

                    if($sort=='Price: High to Low'){
                        $projects = $projects->orderBy('cost_num', 'desc');
                    }

                    if($sort=='Year: Low to High'){
                        $projects = $projects->orderBy('vote_year');
                    }

                    if($sort=='Year: High to Low'){
                        $projects = $projects->orderBy('vote_year', 'desc');
                    }

                    if($sort=='Votes: Low to High'){
                        $projects = $projects->orderBy('votes');
                    }

                    if($sort=='Votes: High to Low'){
                        $projects = $projects->orderBy('votes', 'desc');
                    }

                    if($sort=='Status: Complete to Needed'){
                        $projects = $projects->orderBy('project_status_category');
                    }

                    if($sort=='Status: Needed to Complete'){
                        $projects = $projects->orderBy('project_status_category', 'desc');
                    }

                }
                $address_district="";

                if($location != NULL)
                {

                    $location = str_replace("+","%20",$location);
                    $location = str_replace(",",",",$location);
                    $location = str_replace(" ","%20",$location);
                    

                    $content = file_get_contents("https://geosearch.planninglabs.nyc/v1/autocomplete?text=".$location);


                    $result  = json_decode($content);
                    
                    // var_dump($result->features[0]);
                    // exit();
                    //$housenumber=$result->features[3]->properties->housenumber;
                    // var_dump($housenumber);
                    // exit();
                    $name=$result->features[0]->properties->name;
                    $zip=$result->features[0]->properties->postalcode;
                    // var_dump($street, $zipcode);
                    // exit();
                    $name = str_replace(" ","%20",$name);
                    $url = 'https://api.cityofnewyork.us/geoclient/v1/place.json?name=' . $name . '&zip=' . $zip . '&app_id=0359f714&app_key=27da16447759b5111e7dcc067d73dfc8';

                    $geoclient = file_get_contents($url);

                    $geo  = json_decode($geoclient);

                    $cityCouncilDistrict=$geo->place->cityCouncilDistrict;

                    // var_dump($cityCouncilDistrict);
                    // exit();
                    
                    $projects= $projects->with('district')->whereHas('district', function ($q)  use($cityCouncilDistrict){
                        $q->where('cityCouncilDistrict', '=', $cityCouncilDistrict);
                    });

                    $address_district=District::where('cityCouncilDistrict', '=', $cityCouncilDistrict)->first();
                    
                
                    if($address_district == NULL){
                        // return redirect('/project')->with('success', 'no project')->render();
                        $projects = [];
                        $address_district = "";
                        return view('frontEnd.explore1', compact('projects','address_district'))->with('successMsg','Property is updated .')->render();
                    }
                    
                    $address_district=$address_district->name;

                }
                 if($search != NULL)
                {

                    $projects = $projects->with('district')->where(function($q) use($search){
                        $q->where('project_title', 'like', '%'.$search.'%')->orwhere('project_description', 'like', '%'.$search.'%')->orwhere('neighborhood', 'like', '%'.$search.'%')->orwhereHas('district',function($qq) use($search) {
                            $qq->where('name', 'like', '%'.$search.'%');
                        });
                    });
                }
                $projects = $projects->get();

                
                return view('frontEnd.explore1', compact('projects','address_district'))->render();


    }

    public function exportcsv(Request $request)
    {
                
        $price_min = (int)$request->input('price_min');
        $price_max = (int)$request->input('price_max');
        $year_min = $request->input('year_min');
        $year_max = $request->input('year_max');
        $vote_min = (int)$request->input('vote_min');
        $vote_max = (int)$request->input('vote_max');

        $search = $request->input('Search');


        // $district = $request->input('District');
        $status = $request->input('Status');

        $category = $request->input('Category');        
        $city = $request->input('City');

        $sort = $request->input('selected_sort');
        $location = $request->input('address');
        // var_dump($location);
        // exit();
        $profile_name = $request->input('profile_name');


        $projects = Project::whereBetween('cost_num', [$price_min, $price_max])->whereBetween('votes', [$vote_min, $vote_max])->whereBetween('vote_year', [$year_min, $year_max]);
                   
        
        if($status!=NULL){

            $projects = $projects->where('project_status_category', 'like', '%'.$status.'%');
        }

        if($category!=NULL){
            $projects = $projects->where('category_type_topic_standardize', '=', $category);
        }

        if($city!=NULL){
            
            $projects = $projects->where('name_dept_agency_cbo', '=', $city);
        }
        

        $address_district="";

        if($location != NULL)
        {

            $location = str_replace("+","%20",$location);
            $location = str_replace(",",",",$location);
            $location = str_replace(" ","%20",$location);
            

            $content = file_get_contents("https://geosearch.planninglabs.nyc/v1/autocomplete?text=".$location);


            $result  = json_decode($content);
            
            // var_dump($result->features[0]);
            // exit();
            //$housenumber=$result->features[3]->properties->housenumber;
            // var_dump($housenumber);
            // exit();
            $name=$result->features[0]->properties->name;
            $zip=$result->features[0]->properties->postalcode;
            // var_dump($street, $zipcode);
            // exit();
            $name = str_replace(" ","%20",$name);
            $url = 'https://api.cityofnewyork.us/geoclient/v1/place.json?name=' . $name . '&zip=' . $zip . '&app_id=0359f714&app_key=27da16447759b5111e7dcc067d73dfc8';

            $geoclient = file_get_contents($url);

            $geo  = json_decode($geoclient);

            $cityCouncilDistrict=$geo->place->cityCouncilDistrict;

            // var_dump($cityCouncilDistrict);
            // exit();
            
            $projects= $projects->with('district')->whereHas('district', function ($q)  use($cityCouncilDistrict){
                $q->where('cityCouncilDistrict', '=', $cityCouncilDistrict);
            });

            $address_district=District::where('cityCouncilDistrict', '=', $cityCouncilDistrict)->first();
            
        
            if($address_district == NULL){
                // return redirect('/project')->with('success', 'no project')->render();
                $projects = [];
                $address_district = "";
                return view('frontEnd.explore1', compact('projects','address_district'))->with('successMsg','Property is updated .')->render();
            }
            
            $address_district=$address_district->name;

        }
         if($search != NULL)
        {

            $projects = $projects->with('district')->where(function($q) use($search){
                $q->where('project_title', 'like', '%'.$search.'%')->orwhere('project_description', 'like', '%'.$search.'%')->orwhere('neighborhood', 'like', '%'.$search.'%')->orwhereHas('district',function($qq) use($search) {
                    $qq->where('name', 'like', '%'.$search.'%');
                });
            });
        }
        
        $projects = $projects->select('id')->get();
        return json_encode($projects);

    }

    public function downloadcsv(Request $request){
        $projects = $request->input('projects');
        $projects = json_decode($projects);
        $ids = [];

        for($i = 0; $i < count($projects); $i++){
            $ids[$i] = $projects[$i]->id;
        }
        $projects = Project::whereIn('id',$ids)->get();
        $csvExporter = new \Laracsv\Export();

        return $csvExporter->build($projects, ['project_id'=>'Project_ID', 'project_title'=>'Project_Title', 'project_description'=>'Project_Description', 'category_re_coded'=>'Category re-coded','project_status'=>'Project_Status', 'district.name'=>'District-Ward_Name', 'win_text'=>'Win_Text', 'votes'=>'Votes', 'pb_cycle'=>'PB_Cycle', 'cos_num'=>'Cost_Num', 'fiscal_year', 'cost_appropriated', 'vote_year'=>'Vote_Year', 'name_dept_agency_cbo'=>'Name_Dept_Agency_CBO', 'project_status_category'=>'Project_Status_Category', 'project_status_detail'=>'Project_Status_Detail'])->download();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

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
