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
use VerumConsilium\Browsershot\Facades\PDF;
use App\Layout;

class SummaryController extends Controller
{
    public function compare($a, $b)
    {
       return ($a['total']< $b['total']);
    }
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
                });

                $projects_origin = $projects;

                $location_maps = $projects->get();

                $category_query = $projects->select('category_type_topic_standardize', 'project_status_category', DB::raw('count(*) as count'))->groupBy('category_type_topic_standardize', 'project_status_category')->get();

                $category_reports=[];

                foreach ($category_query as $value) {
                    if ($value->category_type_topic_standardize == null){ 
                        continue;
                    }
                    $category_reports[$value->category_type_topic_standardize][$value->project_status_category] = $value->count;
                }

                $id_array = $location_maps->pluck('id')->toArray();
                $ids = join(', ', $id_array);
                // var_dump($ids);
                // exit();

                $sqlQuery = 'SELECT vote_range, project_status_category, count(*) as count FROM (select project_status_category, case  when votes = 0 then \'unknown\'when votes >= 1 and votes < 500 then \'1-499\'when votes >= 500 and votes < 1000 then \'500-999\'when votes >= 1000 and votes < 1500 then \'1000-1499\'when votes >= 1500 and votes < 2000 then \'1500-1999\'when votes >= 2000 and votes < 2500 then \'2000-2499\'when votes >= 2500 and votes < 3000 then \'2500-2999\'else \'3000+\' end as vote_range from projects where projects.id in (' . $ids . ')) as temp group by temp.vote_range, temp.project_status_category';
                $vote_query = DB::select($sqlQuery); 

                $vote_reports;
                foreach ($vote_query as $value) {
                    $vote_reports[$value->vote_range][$value->project_status_category] = $value->count;
                }

                $sql_cost = 'SELECT cost_range, project_status_category, count(*) as count FROM (select project_status_category, case  when cost_num >= 0 and cost_num < 100000 then \'0-$99,999\'when cost_num >= 100000 and cost_num < 200000 then \'100k-$199,999\'when cost_num >= 200000 and cost_num < 300000 then \'200k-$299,999\'when cost_num >= 300000 and cost_num < 400000 then \'300k-$399,999\'when cost_num >= 400000 and cost_num <
                    500000 then \'400k-$499,999\'when cost_num >= 500000 and cost_num <
                    600000 then \'500k-$599,999\'when cost_num >= 600000 and cost_num <
                    700000 then \'600k-$699,999\'when cost_num >= 700000 and cost_num <
                    800000 then \'700k-$799,999\'when cost_num >= 800000 and cost_num <
                    900000 then \'800k-$899,999\'when cost_num >= 900000 and cost_num <
                    1000000 then \'900k-$999,999\'else \'$1,000,000+\' end as cost_range from
                    mypb.projects where cost_num != \'null\' and projects.id in (' . $ids . ')) as temp group by temp.cost_range, temp.project_status_category';

                $cost_query = DB::select($sql_cost); 
                $cost_reports;
                foreach ($cost_query as $value) {
                    $cost_reports[$value->cost_range][$value->project_status_category] = $value->count;
                }

                // $project_agency = Project::with('agency')->where('project_title', '=', 'Laptops for Schools in District 8 - Renaissance Charter HS - Site 7 of 9')->first();

                $agency_reports = Agency::orderBy('agency_name')->get();
                // var_dump($project_agency);
                // exit();
                foreach ($agency_reports as $value) {

                }

                $count = [];

                foreach ($projects as $array_key => $value) {
                    if(isset($value->agency_code))
                    {
                        $agency_codes = explode(',',$value->agency_code);
                        
                        $status = $value->project_status_category;
                        for($i = 0; $i < count($agency_codes); $i++)
                        {
                            $code_name;
                            foreach ($agency_reports as $key => $agency) {
                                if($agency->recordid == $agency_codes[$i])
                                {
                                    $code_name = $agency->agency_name;
                                }
                            }
                            if(isset($count[$code_name]))
                            {

                                if(isset($count[$code_name][$status]))
                                    $count[$code_name][$status] ++;
                                else
                                    $count[$code_name][$status] = 1;
                                $count[$code_name]['total'] ++;

                            }
                            else
                            {
                                $count[$code_name] = [];
                                $count[$code_name]['key'] = $code_name;
                                $count[$code_name]['total'] = 0;
                            }
                        }
                    }
                }

                
                usort($count,array($this,'compare'));

                $output = [];

                for($i = 0; $i < count($count); $i ++)
                {

                    if($i < 9)
                        $output[$i] = $count[$i];
                    else
                    {
                        $output[8]['total'] += $count[$i]['total'];

                        $output[8]['key'] = "Other";                    

                        if(isset($output[8]['In process']) && isset($count[$i]['In process']))
                            $output[8]['In process'] += $count[$i]['In process'];
                        else if(!isset($output[8]['In process']) && isset($count[$i]['In process']))
                            $output[8]['In process'] = $count[$i]['In process'];
                        if(isset($output[8]['Complete']) && isset($count[$i]['Complete']))
                            $output[8]['Complete'] += $count[$i]['Complete'];
                        else if(!isset($output[8]['Complete']) && isset($count[$i]['Complete']))
                            $output[8]['Complete'] = $count[$i]['Complete'];
                        if(isset($output[8]['Lost vote']) && isset($count[$i]['Lost vote']))
                            $output[8]['Lost vote'] += $count[$i]['Lost vote'];
                        else if(!isset($output[8]['Lost vote']) && isset($count[$i]['Lost vote']))
                            $output[8]['Lost vote'] = $count[$i]['Lost vote'];
                        if(isset($output[8]['Project Status Needed']) && isset($count[$i]['Project Status Needed']))
                            $output[8]['Project Status Needed'] += $count[$i]['Project Status Needed'];
                        else if(!isset($output[8]['Project Status Needed'])  && isset($count[$i]['Project Status Needed']))
                            $output[8]['Project Status Needed'] = $count[$i]['Project Status Needed'];
                    }
                }

                $location_maps = $projects;

                return view('frontEnd.summary', compact('projects', 'districts', 'states', 'categories', 'cities', 'address_district', 'location_maps', 'category_reports', 'vote_reports', 'cost_reports', 'output'));
            }

            if ($request->input('address')) {
                $location = $request->get('address');
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
                });


                $address_district=District::where('cityCouncilDistrict', '=', $cityCouncilDistrict)->first();
                
                
                if($address_district == NULL){
                    return redirect('/summary')->with('success', 'no project');
                }
                
                $address_district=$address_district->name;

                $projects_origin = $projects;

                $location_maps = $projects->get();

                $category_query = $projects->select('category_type_topic_standardize', 'project_status_category', DB::raw('count(*) as count'))->groupBy('category_type_topic_standardize', 'project_status_category')->get();

                $category_reports=[];

                foreach ($category_query as $value) {
                    if ($value->category_type_topic_standardize == null){ 
                        continue;
                    }
                    $category_reports[$value->category_type_topic_standardize][$value->project_status_category] = $value->count;
                }

                

                $id_array = $location_maps->pluck('id')->toArray();
                $ids = join(', ', $id_array);
                
                // var_dump($ids);
                // exit();

                $sqlQuery = 'SELECT vote_range, project_status_category, count(*) as count FROM (select project_status_category, case  when votes = 0 then \'unknown\'when votes >= 1 and votes < 500 then \'1-499\'when votes >= 500 and votes < 1000 then \'500-999\'when votes >= 1000 and votes < 1500 then \'1000-1499\'when votes >= 1500 and votes < 2000 then \'1500-1999\'when votes >= 2000 and votes < 2500 then \'2000-2499\'when votes >= 2500 and votes < 3000 then \'2500-2999\'else \'3000+\' end as vote_range from projects where projects.id in (' . $ids . ')) as temp group by temp.vote_range, temp.project_status_category';
                $vote_query = DB::select($sqlQuery); 

                $vote_reports;
                foreach ($vote_query as $value) {
                    $vote_reports[$value->vote_range][$value->project_status_category] = $value->count;
                }

                $sql_cost = 'SELECT cost_range, project_status_category, count(*) as count FROM (select project_status_category, case  when cost_num >= 0 and cost_num < 100000 then \'0-$99,999\'when cost_num >= 100000 and cost_num < 200000 then \'100k-$199,999\'when cost_num >= 200000 and cost_num < 300000 then \'200k-$299,999\'when cost_num >= 300000 and cost_num < 400000 then \'300k-$399,999\'when cost_num >= 400000 and cost_num <
                    500000 then \'400k-$499,999\'when cost_num >= 500000 and cost_num <
                    600000 then \'500k-$599,999\'when cost_num >= 600000 and cost_num <
                    700000 then \'600k-$699,999\'when cost_num >= 700000 and cost_num <
                    800000 then \'700k-$799,999\'when cost_num >= 800000 and cost_num <
                    900000 then \'800k-$899,999\'when cost_num >= 900000 and cost_num <
                    1000000 then \'900k-$999,999\'else \'$1,000,000+\' end as cost_range from
                    mypb.projects where cost_num != \'null\' and projects.id in (' . $ids . ')) as temp group by temp.cost_range, temp.project_status_category';

                $cost_query = DB::select($sql_cost); 
                $cost_reports;
                foreach ($cost_query as $value) {
                    $cost_reports[$value->cost_range][$value->project_status_category] = $value->count;
                }

                // $project_agency = Project::with('agency')->where('project_title', '=', 'Laptops for Schools in District 8 - Renaissance Charter HS - Site 7 of 9')->first();

                $agency_reports = Agency::orderBy('agency_name')->get();
                // var_dump($project_agency);
                // exit();

                $projects = $location_maps;
                $count = [];

                foreach ($projects as $array_key => $value)
                {
                    if(isset($value->agency_code))
                    {
                        $agency_codes = explode(',',$value->agency_code);
                        
                        $status = $value->project_status_category;
                        for($i = 0; $i < count($agency_codes); $i++)
                        {
                            $code_name;
                            foreach ($agency_reports as $key => $agency) {
                                if($agency->recordid == $agency_codes[$i])
                                {
                                    $code_name = $agency->agency_name;
                                }
                            }
                            if(isset($count[$code_name]))
                            {

                                if(isset($count[$code_name][$status]))
                                    $count[$code_name][$status] ++;
                                else
                                    $count[$code_name][$status] = 1;
                                $count[$code_name]['total'] ++;

                            }
                            else
                            {
                                $count[$code_name] = [];
                                $count[$code_name]['key'] = $code_name;
                                $count[$code_name]['total'] = 0;
                            }
                        }
                    }
                }

                
                usort($count,array($this,'compare'));

                $output = [];

                for($i = 0; $i < count($count); $i ++)
                {

                    if($i < 9)
                        $output[$i] = $count[$i];
                    else
                    {
                        $output[8]['total'] += $count[$i]['total'];

                        $output[8]['key'] = "Other";                    

                        if(isset($output[8]['In process']) && isset($count[$i]['In process']))
                            $output[8]['In process'] += $count[$i]['In process'];
                        else if(!isset($output[8]['In process']) && isset($count[$i]['In process']))
                            $output[8]['In process'] = $count[$i]['In process'];
                        if(isset($output[8]['Complete']) && isset($count[$i]['Complete']))
                            $output[8]['Complete'] += $count[$i]['Complete'];
                        else if(!isset($output[8]['Complete']) && isset($count[$i]['Complete']))
                            $output[8]['Complete'] = $count[$i]['Complete'];
                        if(isset($output[8]['Lost vote']) && isset($count[$i]['Lost vote']))
                            $output[8]['Lost vote'] += $count[$i]['Lost vote'];
                        else if(!isset($output[8]['Lost vote']) && isset($count[$i]['Lost vote']))
                            $output[8]['Lost vote'] = $count[$i]['Lost vote'];
                        if(isset($output[8]['Project Status Needed']) && isset($count[$i]['Project Status Needed']))
                            $output[8]['Project Status Needed'] += $count[$i]['Project Status Needed'];
                        else if(!isset($output[8]['Project Status Needed'])  && isset($count[$i]['Project Status Needed']))
                            $output[8]['Project Status Needed'] = $count[$i]['Project Status Needed'];
                    }
                }

                return view('frontEnd.summary', compact('projects', 'districts', 'states', 'categories', 'cities', 'address_district', 'location_maps', 'category_reports', 'vote_reports', 'cost_reports', 'output'))->render();
                
            }

            $category_query = DB::table('projects')->select('category_type_topic_standardize', 'project_status_category', DB::raw('count(*) as count'))->groupBy('category_type_topic_standardize', 'project_status_category')->get();

            $category_reports;
            foreach ($category_query as $value) {
                if ($value->category_type_topic_standardize == null){ 
                    continue;
                }
                $category_reports[$value->category_type_topic_standardize][$value->project_status_category] = $value->count;
            }

            $sqlQuery = 'SELECT vote_range, project_status_category, count(*) as count FROM (select project_status_category, case  when votes = 0 then \'unknown\'when votes >= 1 and votes < 500 then \'1-499\'when votes >= 500 and votes < 1000 then \'500-999\'when votes >= 1000 and votes < 1500 then \'1000-1499\'when votes >= 1500 and votes < 2000 then \'1500-1999\'when votes >= 2000 and votes < 2500 then \'2000-2499\'when votes >= 2500 and votes < 3000 then \'2500-2999\'else \'3000+\' end as vote_range from mypb.projects) as temp group by temp.vote_range, temp.project_status_category';
            $vote_query = DB::select($sqlQuery); 
            $vote_reports;
            foreach ($vote_query as $value) {
                $vote_reports[$value->vote_range][$value->project_status_category] = $value->count;
            }

            $sql_cost = 'SELECT cost_range, project_status_category, count(*) as count FROM (select project_status_category, case  when cost_num >= 0 and cost_num < 100000 then \'0-$99,999\'when cost_num >= 100000 and cost_num < 200000 then \'100k-$199,999\'when cost_num >= 200000 and cost_num < 300000 then \'200k-$299,999\'when cost_num >= 300000 and cost_num < 400000 then \'300k-$399,999\'when cost_num >= 400000 and cost_num <
                500000 then \'400k-$499,999\'when cost_num >= 500000 and cost_num <
                600000 then \'500k-$599,999\'when cost_num >= 600000 and cost_num <
                700000 then \'600k-$699,999\'when cost_num >= 700000 and cost_num <
                800000 then \'700k-$799,999\'when cost_num >= 800000 and cost_num <
                900000 then \'800k-$899,999\'when cost_num >= 900000 and cost_num <
                1000000 then \'900k-$999,999\'else \'$1,000,000+\' end as cost_range from
                mypb.projects where cost_num != \'null\') as temp group by temp.cost_range, temp.project_status_category';
            $cost_query = DB::select($sql_cost); 
            $cost_reports;
            foreach ($cost_query as $value) {
                $cost_reports[$value->cost_range][$value->project_status_category] = $value->count;
            }

            // $project_agency = Project::with('agency')->where('project_title', '=', 'Laptops for Schools in District 8 - Renaissance Charter HS - Site 7 of 9')->first();

            $agency_reports = Agency::orderBy('agency_name')->get();
            // var_dump($project_agency);
            // exit();
            foreach ($agency_reports as $value) {

            }
            $projects = Project::all();

            $count = [];

            foreach ($projects as $array_key => $value) {
                if(isset($value->agency_code))
                {
                    $agency_codes = explode(',',$value->agency_code);
                    
                    $status = $value->project_status_category;
                    for($i = 0; $i < count($agency_codes); $i++)
                    {
                        $code_name;
                        foreach ($agency_reports as $key => $agency) {
                            if($agency->recordid == $agency_codes[$i])
                            {
                                $code_name = $agency->agency_code;
                            }
                        }
                        if(isset($count[$code_name]))
                        {

                            if(isset($count[$code_name][$status]))
                                $count[$code_name][$status] ++;
                            else
                                $count[$code_name][$status] = 1;
                            $count[$code_name]['total'] ++;

                        }
                        else
                        {
                            $count[$code_name] = [];
                            $count[$code_name]['key'] = $code_name;
                            $count[$code_name]['total'] = 0;
                        }
                    }
                }
            }

            
            usort($count,array($this,'compare'));

            $output = [];

            for($i = 0; $i < count($count); $i ++)
            {

                if($i < 9)
                    $output[$i] = $count[$i];
                else
                {
                    $output[8]['total'] += $count[$i]['total'];

                    $output[8]['key'] = "Other";                    

                    if(isset($output[8]['In process']) && isset($count[$i]['In process']))
                        $output[8]['In process'] += $count[$i]['In process'];
                    else if(!isset($output[8]['In process']) && isset($count[$i]['In process']))
                        $output[8]['In process'] = $count[$i]['In process'];
                    if(isset($output[8]['Complete']) && isset($count[$i]['Complete']))
                        $output[8]['Complete'] += $count[$i]['Complete'];
                    else if(!isset($output[8]['Complete']) && isset($count[$i]['Complete']))
                        $output[8]['Complete'] = $count[$i]['Complete'];
                    if(isset($output[8]['Lost vote']) && isset($count[$i]['Lost vote']))
                        $output[8]['Lost vote'] += $count[$i]['Lost vote'];
                    else if(!isset($output[8]['Lost vote']) && isset($count[$i]['Lost vote']))
                        $output[8]['Lost vote'] = $count[$i]['Lost vote'];
                    if(isset($output[8]['Project Status Needed']) && isset($count[$i]['Project Status Needed']))
                        $output[8]['Project Status Needed'] += $count[$i]['Project Status Needed'];
                    else if(!isset($output[8]['Project Status Needed'])  && isset($count[$i]['Project Status Needed']))
                        $output[8]['Project Status Needed'] = $count[$i]['Project Status Needed'];
                }
            }


        $location_maps = Project::all();
        
        return view('frontEnd.summary', compact('projects', 'districts', 'states', 'categories', 'cities', 'address_district', 'location_maps', 'category_reports', 'vote_reports', 'cost_reports', 'output'));
    }

  
    public function filtersummary(Request $request)
    {

        
        $price_min = (int)$request->input('price_min');
        $price_max = (int)$request->input('price_max');
        $year_min = $request->input('year_min');
        $year_max = $request->input('year_max');
        $vote_min = (int)$request->input('vote_min');
        $vote_max = (int)$request->input('vote_max');

        $search = $request->input('Search');


        $district = $request->input('District');
        $status = $request->input('Status');
        $category = $request->input('Category');        
        $city = $request->input('City');
        $sort = $request->input('selected_sort');
        $location = $request->input('address');
        $profile_name = $request->input('profile_name');

        if ($profile_name!=null) {

            $districts = District::orderBy('name')->get();
            $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
            $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
            $cities = Agency::whereNotNull('projects')->orderBy('agency_name')->get(['agency_name']);

            $project = Project::where('project_title', '=', $profile_name)->first();
            $district = $project->district_ward_name;
            $contact = Contact::where('district_ward_name', 'like', '%'.$district.'%')->first();

            return view('frontEnd.profile1', compact('districts', 'states', 'categories', 'cities', 'project', 'contact'));
        }


        $projects = Project::whereBetween('cost_num', [$price_min, $price_max])->whereBetween('votes', [$vote_min, $vote_max])->whereBetween('vote_year', [$year_min, $year_max]);
                   

        if($district!=NULL){

            $district = District::where('name', '=', $district)->first();
            $district = $district->recordid;
            $projects = $projects->where('district_ward_name', '=', $district);
            
        }
        
        if($status!=NULL){
            $projects = $projects->where('project_status_category', 'like', '%'.$status.'%');
        }
        else {
            $status = "";
        }

        if($category!=NULL){
            $projects = $projects->where('category_type_topic_standardize', '=', $category);
        }
        else {
            $category = "";
        }

        if($city!=NULL){
            $projects = $projects->where('name_dept_agency_cbo',  'like', '%'.$city.'%');
        }
        else {
            $city = "";
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
            
            $projects= $projects->with('district')->whereHas('district', function ($q)  use($cityCouncilDistrict){
                $q->where('cityCouncilDistrict', '=', $cityCouncilDistrict);
            });

            $address_district=District::where('cityCouncilDistrict', '=', $cityCouncilDistrict)->first();
        
        
            if($address_district == NULL){

                return redirect('/summary')->with('success', 'no project');
            }
            
            $address_district=$address_district->name;
        }
         if($search != NULL)
        {
            // $projects = $projects->with('district')->where('project_title', 'like', '%'.$search.'%')->orwhere('project_description', 'like', '%'.$search.'%')->orwhere('neighborhood', 'like', '%'.$search.'%')->orwhereHas('district', function ($q)  use($search){
            // $q->where('name', 'like', '%'.$search.'%');
            // });

            $projects = $projects->with('district')->where(function($q) use($search){
                $q->where('project_title', 'like', '%'.$search.'%')->orwhere('project_description', 'like', '%'.$search.'%')->orwhere('neighborhood', 'like', '%'.$search.'%')->orwhereHas('district',function($qq) use($search) {
                    $qq->where('name', 'like', '%'.$search.'%');
                });
            });
        }

        $projects_origin = $projects;

        $location_maps = $projects->get();

        $category_query = $projects->select('category_type_topic_standardize', 'project_status_category', DB::raw('count(*) as count'))->groupBy('category_type_topic_standardize', 'project_status_category')->get();

        $category_reports=[];

        foreach ($category_query as $value) {
            if ($value->category_type_topic_standardize == null){ 
                continue;
            }
            $category_reports[$value->category_type_topic_standardize][$value->project_status_category] = $value->count;
        }

        $ids = "";
        $id_array = $location_maps->pluck('id')->toArray();
        $ids = join(', ', $id_array);
        // var_dump($ids);
        // exit();
        if($ids == ""){

            $category_reports = [];
            $vote_reports =[];
            $cost_reports =[];
            $output =[];

            return view('frontEnd.summary1', compact('projects', 'districts', 'states', 'categories', 'cities', 'address_district', 'location_maps', 'category_reports', 'vote_reports', 'cost_reports', 'output', 'ids'))->render();
        }

        $sqlQuery = 'SELECT vote_range, project_status_category, count(*) as count FROM (select project_status_category, case  when votes = 0 then \'unknown\'when votes >= 1 and votes < 500 then \'1-499\'when votes >= 500 and votes < 1000 then \'500-999\'when votes >= 1000 and votes < 1500 then \'1000-1499\'when votes >= 1500 and votes < 2000 then \'1500-1999\'when votes >= 2000 and votes < 2500 then \'2000-2499\'when votes >= 2500 and votes < 3000 then \'2500-2999\'else \'3000+\' end as vote_range from projects where projects.id in (' . $ids . ')) as temp group by temp.vote_range, temp.project_status_category';
        $vote_query = DB::select($sqlQuery); 

        $vote_reports;
        foreach ($vote_query as $value) {
            $vote_reports[$value->vote_range][$value->project_status_category] = $value->count;
        }

        $sql_cost = 'SELECT cost_range, project_status_category, count(*) as count FROM (select project_status_category, case  when cost_num >= 0 and cost_num < 100000 then \'0-$99,999\'when cost_num >= 100000 and cost_num < 200000 then \'100k-$199,999\'when cost_num >= 200000 and cost_num < 300000 then \'200k-$299,999\'when cost_num >= 300000 and cost_num < 400000 then \'300k-$399,999\'when cost_num >= 400000 and cost_num <
            500000 then \'400k-$499,999\'when cost_num >= 500000 and cost_num <
            600000 then \'500k-$599,999\'when cost_num >= 600000 and cost_num <
            700000 then \'600k-$699,999\'when cost_num >= 700000 and cost_num <
            800000 then \'700k-$799,999\'when cost_num >= 800000 and cost_num <
            900000 then \'800k-$899,999\'when cost_num >= 900000 and cost_num <
            1000000 then \'900k-$999,999\'else \'$1,000,000+\' end as cost_range from
            mypb.projects where cost_num != \'null\' and projects.id in (' . $ids . ')) as temp group by temp.cost_range, temp.project_status_category';

        $cost_query = DB::select($sql_cost); 
        $cost_reports;
        foreach ($cost_query as $value) {
            $cost_reports[$value->cost_range][$value->project_status_category] = $value->count;
        }

        // $project_agency = Project::with('agency')->where('project_title', '=', 'Laptops for Schools in District 8 - Renaissance Charter HS - Site 7 of 9')->first();

        $agency_reports = Agency::orderBy('agency_code')->get();
        // var_dump($project_agency);
        // exit();

        $projects = $location_maps;
        $count = [];

        foreach ($projects as $array_key => $value) {
            if(isset($value->agency_code))
            {
                $agency_codes = explode(',',$value->agency_code);
                
                $status1 = $value->project_status_category;
                for($i = 0; $i < count($agency_codes); $i++)
                {
                    $code_name;
                    foreach ($agency_reports as $key => $agency) {
                        if($agency->recordid == $agency_codes[$i])
                        {
                            $code_name = $agency->agency_code;
                        }
                    }
                    if(isset($count[$code_name]))
                    {

                        if(isset($count[$code_name][$status1]))
                            $count[$code_name][$status1] ++;
                        else
                            $count[$code_name][$status1] = 1;
                        $count[$code_name]['total'] ++;

                    }
                    else
                    {
                        $count[$code_name] = [];
                        $count[$code_name]['key'] = $code_name;
                        $count[$code_name]['total'] = 0;
                    }
                }
            }
        }

        
        usort($count,array($this,'compare'));

        $output = [];

        for($i = 0; $i < count($count); $i ++)
        {

            if($i < 9)
                $output[$i] = $count[$i];
            else
            {
                $output[8]['total'] += $count[$i]['total'];

                $output[8]['key'] = "Other";                    

                if(isset($output[8]['In process']) && isset($count[$i]['In process']))
                    $output[8]['In process'] += $count[$i]['In process'];
                else if(!isset($output[8]['In process']) && isset($count[$i]['In process']))
                    $output[8]['In process'] = $count[$i]['In process'];
                if(isset($output[8]['Complete']) && isset($count[$i]['Complete']))
                    $output[8]['Complete'] += $count[$i]['Complete'];
                else if(!isset($output[8]['Complete']) && isset($count[$i]['Complete']))
                    $output[8]['Complete'] = $count[$i]['Complete'];
                if(isset($output[8]['Lost vote']) && isset($count[$i]['Lost vote']))
                    $output[8]['Lost vote'] += $count[$i]['Lost vote'];
                else if(!isset($output[8]['Lost vote']) && isset($count[$i]['Lost vote']))
                    $output[8]['Lost vote'] = $count[$i]['Lost vote'];
                if(isset($output[8]['Project Status Needed']) && isset($count[$i]['Project Status Needed']))
                    $output[8]['Project Status Needed'] += $count[$i]['Project Status Needed'];
                else if(!isset($output[8]['Project Status Needed'])  && isset($count[$i]['Project Status Needed']))
                    $output[8]['Project Status Needed'] = $count[$i]['Project Status Needed'];
            }
        }



        return view('frontEnd.summary1', compact('projects', 'districts', 'states', 'city', 'category', 'categories', 'cities', 'address_district', 'location_maps', 'category_reports', 'vote_reports', 'cost_reports', 'output', 'status'))->render();


    }

    public function exportpdf(Request $request)
    {
       
        $price_min = (int)$request->input('price_min');
        $price_max = (int)$request->input('price_max');
        $year_min = $request->input('year_min');
        $year_max = $request->input('year_max');
        $vote_min = (int)$request->input('vote_min');
        $vote_max = (int)$request->input('vote_max');

        $search = $request->input('Search');


        $district = $request->input('District');
        $status = $request->input('Status');

        $category = $request->input('Category');        
        $city = $request->input('City');
        $sort = $request->input('selected_sort');
        $location = $request->input('address');
        $profile_name = $request->input('profile_name');


        $projects = Project::whereBetween('cost_num', [$price_min, $price_max])->whereBetween('votes', [$vote_min, $vote_max])->whereBetween('vote_year', [$year_min, $year_max]);
                   
         // var_dump($price_min,$price_max,$year_min,$year_max,$vote_min,$vote_max,$district,$status,$category,$city,count($projects));
         // exit(); 
       

        if($district!=NULL){

            $district = District::where('name', '=', $district)->first();
            $district = $district->recordid;
            $projects = $projects->where('district_ward_name', '=', $district);
            
        }
        
        if($status!=NULL){

            $projects = $projects->where('project_status_category', 'like', '%'.$status.'%');
        }

        if($category!=NULL){
            $projects = $projects->where('category_type_topic_standardize', '=', $category);
        }

        if($city!=NULL){
            $projects = $projects->where('name_dept_agency_cbo',  'like', '%'.$city.'%');
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
            
            $projects= $projects->with('district')->whereHas('district', function ($q)  use($cityCouncilDistrict){
                $q->where('cityCouncilDistrict', '=', $cityCouncilDistrict);
            });

            $address_district=District::where('cityCouncilDistrict', '=', $cityCouncilDistrict)->first();
        
        
            if($address_district == NULL){

                return redirect('/summary')->with('success', 'no project');
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

        $filter_value = [$price_min, $price_max, $year_min, $year_max, $vote_min, $vote_max, $address_district, $status, $category, $city];

        return json_encode($projects);
        // return json($projects, $price_min, $price_max, $year_min, $year_max, $vote_min, $vote_max, $address_district, $status, $category, $city);

    }

    public function download_pdf(Request $request)
    {

        $projects = $request->input('projects');
        $projects = json_decode($projects);


        $price_min = (int)$request->input('price_min');
        $price_max = (int)$request->input('price_max');
        $year_min = $request->input('year_min');
        $year_max = $request->input('year_max');
        $vote_min = (int)$request->input('vote_min');
        $vote_max = (int)$request->input('vote_max');


  
        $status = $request->input('status');
        $category = $request->input('category');        
        $city = $request->input('city');
        $location = $request->input('address');
    

        $ids = [];

        for($i = 0; $i < count($projects); $i++){
            $ids[$i] = $projects[$i]->id;
        }        $projects = Project::whereIn('id',$ids);

        $projects_origin = $projects;

        $address_district="";

        $location_maps = $projects->get();
        $limit_maps = $projects_origin->take(50)->get();

        $category_query = $projects->select('category_type_topic_standardize', 'project_status_category', DB::raw('count(*) as count'))->groupBy('category_type_topic_standardize', 'project_status_category')->get();

        $category_reports=[];

        foreach ($category_query as $value) {
            if ($value->category_type_topic_standardize == null){ 
                continue;
            }
            $category_reports[$value->category_type_topic_standardize][$value->project_status_category] = $value->count;
        }

        $ids = "";
        $id_array = $location_maps->pluck('id')->toArray();
        $ids = join(', ', $id_array);
        // var_dump($ids);
        // exit();
        if($ids == ""){

            $category_reports = [];
            $vote_reports =[];
            $cost_reports =[];
            $output =[];

            return view('frontEnd.summary1', compact('projects', 'districts', 'states', 'categories', 'cities', 'address_district', 'location_maps', 'category_reports', 'vote_reports', 'cost_reports', 'output', 'ids'))->render();
        }

        $sqlQuery = 'SELECT vote_range, project_status_category, count(*) as count FROM (select project_status_category, case  when votes = 0 then \'unknown\'when votes >= 1 and votes < 500 then \'1-499\'when votes >= 500 and votes < 1000 then \'500-999\'when votes >= 1000 and votes < 1500 then \'1000-1499\'when votes >= 1500 and votes < 2000 then \'1500-1999\'when votes >= 2000 and votes < 2500 then \'2000-2499\'when votes >= 2500 and votes < 3000 then \'2500-2999\'else \'3000+\' end as vote_range from projects where projects.id in (' . $ids . ')) as temp group by temp.vote_range, temp.project_status_category';
        $vote_query = DB::select($sqlQuery); 

        $vote_reports;
        foreach ($vote_query as $value) {
            $vote_reports[$value->vote_range][$value->project_status_category] = $value->count;
        }

        $sql_cost = 'SELECT cost_range, project_status_category, count(*) as count FROM (select project_status_category, case  when cost_num >= 0 and cost_num < 100000 then \'0-$99,999\'when cost_num >= 100000 and cost_num < 200000 then \'100k-$199,999\'when cost_num >= 200000 and cost_num < 300000 then \'200k-$299,999\'when cost_num >= 300000 and cost_num < 400000 then \'300k-$399,999\'when cost_num >= 400000 and cost_num <
            500000 then \'400k-$499,999\'when cost_num >= 500000 and cost_num <
            600000 then \'500k-$599,999\'when cost_num >= 600000 and cost_num <
            700000 then \'600k-$699,999\'when cost_num >= 700000 and cost_num <
            800000 then \'700k-$799,999\'when cost_num >= 800000 and cost_num <
            900000 then \'800k-$899,999\'when cost_num >= 900000 and cost_num <
            1000000 then \'900k-$999,999\'else \'$1,000,000+\' end as cost_range from
            mypb.projects where cost_num != \'null\' and projects.id in (' . $ids . ')) as temp group by temp.cost_range, temp.project_status_category';

        $cost_query = DB::select($sql_cost); 
        $cost_reports;
        foreach ($cost_query as $value) {
            $cost_reports[$value->cost_range][$value->project_status_category] = $value->count;
        }

        // $project_agency = Project::with('agency')->where('project_title', '=', 'Laptops for Schools in District 8 - Renaissance Charter HS - Site 7 of 9')->first();

        $agency_reports = Agency::orderBy('agency_code')->get();
        // var_dump($project_agency);
        // exit();

        $projects = $location_maps;
        $count = [];

        foreach ($projects as $array_key => $value) {
            if(isset($value->agency_code))
            {
                $agency_codes = explode(',',$value->agency_code);
                
                $status1 = $value->project_status_category;
                for($i = 0; $i < count($agency_codes); $i++)
                {
                    $code_name;
                    foreach ($agency_reports as $key => $agency) {
                        if($agency->recordid == $agency_codes[$i])
                        {
                            $code_name = $agency->agency_code;
                        }
                    }
                    if(isset($count[$code_name]))
                    {

                        if(isset($count[$code_name][$status1]))
                            $count[$code_name][$status1] ++;
                        else
                            $count[$code_name][$status1] = 1;
                        $count[$code_name]['total'] ++;

                    }
                    else
                    {
                        $count[$code_name] = [];
                        $count[$code_name]['key'] = $code_name;
                        $count[$code_name]['total'] = 0;
                    }
                }
            }
        }

        
        usort($count,array($this,'compare'));

        $output = [];

        for($i = 0; $i < count($count); $i ++)
        {

            if($i < 9)
                $output[$i] = $count[$i];
            else
            {
                $output[8]['total'] += $count[$i]['total'];

                $output[8]['key'] = "Other";                    

                if(isset($output[8]['In process']) && isset($count[$i]['In process']))
                    $output[8]['In process'] += $count[$i]['In process'];
                else if(!isset($output[8]['In process']) && isset($count[$i]['In process']))
                    $output[8]['In process'] = $count[$i]['In process'];
                if(isset($output[8]['Complete']) && isset($count[$i]['Complete']))
                    $output[8]['Complete'] += $count[$i]['Complete'];
                else if(!isset($output[8]['Complete']) && isset($count[$i]['Complete']))
                    $output[8]['Complete'] = $count[$i]['Complete'];
                if(isset($output[8]['Lost vote']) && isset($count[$i]['Lost vote']))
                    $output[8]['Lost vote'] += $count[$i]['Lost vote'];
                else if(!isset($output[8]['Lost vote']) && isset($count[$i]['Lost vote']))
                    $output[8]['Lost vote'] = $count[$i]['Lost vote'];
                if(isset($output[8]['Project Status Needed']) && isset($count[$i]['Project Status Needed']))
                    $output[8]['Project Status Needed'] += $count[$i]['Project Status Needed'];
                else if(!isset($output[8]['Project Status Needed'])  && isset($count[$i]['Project Status Needed']))
                    $output[8]['Project Status Needed'] = $count[$i]['Project Status Needed'];
            }
        } 

        $pdf_footer = Layout::find(1)->pdf_footer;

        return PDF::loadView('frontEnd.pdf', compact('projects', 'address_district', 'limit_maps', 'location_maps', 'category_reports', 'vote_reports', 'cost_reports', 'output', 'pdf_footer', 'price_min', 'price_max', 'year_min', 'year_max', 'vote_min', 'vote_max', 'status', 'category', 'city', 'location'))->download();
        // $pdf = PDF::loadView('frontEnd.pdf', compact('address_district', 'location_maps', 'category_reports', 'vote_reports', 'cost_reports', 'output'))->download('summary.pdf');


       // return view('frontEnd.pdf', compact('projects', 'address_district', 'limit_maps', 'location_maps', 'category_reports', 'vote_reports', 'cost_reports', 'output', 'pdf_footer', 'price_min', 'price_max', 'year_min', 'year_max', 'vote_min', 'vote_max', 'status', 'category', 'city', 'location'));



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
