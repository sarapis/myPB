<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\District;
use App\Contact;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
            $districts = District::orderBy('name')->get();
            $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
            $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
            $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);

            if ($request->get('is_ajax')) {

                $price_min = (int)$request->input('price_min');
                $price_max = (int)$request->input('price_max');
                $year_min = $request->input('year_min');
                $year_max = $request->input('year_max');
                $vote_min = (int)$request->input('vote_min');
                $vote_max = (int)$request->input('vote_max');
            

                $projects = Project::with('process')->whereBetween('cost_num', [$price_min, $price_max])->whereBetween('votes', [$vote_min, $vote_max])->whereHas('process', function ($q)  use($year_min, $year_max){
                   $q->whereBetween('vote_year', [$year_min, $year_max]); })->sortable()->get();

                // var_dump($projects);
                // exit();
                return view('frontEnd.explore1', compact('projects', 'districts', 'states', 'categories', 'cities'))->render();
            }

            if ($request->input('search')) {

                $search = $request->input('search');
                $projects= Project::with('district')->where('project_title', 'like', '%'.$search.'%')->orwhere('project_description', 'like', '%'.$search.'%')->orwhere('neighborhood', 'like', '%'.$search.'%')->orwhereHas('district', function ($q)  use($search){
                    $q->where('name', 'like', '%'.$search.'%');
                })->sortable()->paginate(20);

                return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
            }

        $projects = Project::sortable()->paginate(20);
        
        return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $projects = Project::where('project_status', 'like', '%' . $id . '%')->sortable()->paginate(20);
        $districts = District::orderBy('name')->get();
        $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
        $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
        $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
        return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    }

    public function district($id)
    {
        $projects = Project::where('district_ward_name', '=', $id)->sortable()->paginate(20);
        $districts = District::orderBy('name')->get();
        $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
        $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
        $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
        return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    }

    public function category($id)
    {
        $projects = Project::where('category_type_topic_standardize', '=', $id)->sortable()->paginate(20);
        $districts = District::orderBy('name')->get();
        $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
        $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
        $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
        return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    }

    public function cityagency($id)
    {
        $projects = Project::where('name_dept_agency_cbo', '=', $id)->sortable()->paginate(20);
        $districts = District::orderBy('name')->get();
        $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
        $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
        $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
        return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $projects= Project::with('district')->where('project_title', 'like', '%'.$search.'%')->orwhere('project_description', 'like', '%'.$search.'%')->orwhere('neighborhood', 'like', '%'.$search.'%')->orwhereHas('district', function ($q)  use($search){
               $q->where('name', 'like', '%'.$search.'%');
            })->sortable()->paginate(20);


        $districts = District::orderBy('name')->get();
        $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
        $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
        $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
        return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $project = Project::find($id);
        $district = $project->district_ward_name;
        $contact = Contact::where('district_ward_name', 'like', '%'.$district.'%')->first();
        return view('frontEnd.profile', compact('project', 'contact'));
    }


    public function filterValues(Request $request)
    {
        $price_min = (int)$request->input('price_min');
        $price_max = (int)$request->input('price_max');
        $year_min = $request->input('year_min');
        $year_max = $request->input('year_max');
        $vote_min = (int)$request->input('vote_min');
        $vote_max = (int)$request->input('vote_max');
        

        $projects = Project::with('process')->whereBetween('cost_num', [$price_min, $price_max])->whereBetween('votes', [$vote_min, $vote_max])->whereHas('process', function ($q)  use($year_min, $year_max){
               $q->whereBetween('vote_year', [$year_min, $year_max]); })->sortable()->paginate(20);;

        $districts = District::orderBy('name')->get();
        $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
        $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
        $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
      
        // var_dump($projects);
        // exit();
      return view('frontEnd.explore1', compact('projects'))->render();
            //return response()->json($projects);

    }
    public function filterValues1(Request $request)
    {
        $district = $request->input('District');
        $status = $request->input('Status');
        $category = $request->input('Category');
        
        $city = $request->input('City');
        if($status == 'Not Funded'){
            $status = 'Rejected';
        }

        $projects = Project::with('district');

        if($district!=NULL){
            $projects = $projects->orwhereHas('district', function ($q)  use($district){
               $q->where('name', '=', $district);
            });
        }

        if($status!=NULL){
            $projects = $projects->where('project_status', 'like', '%'.$status.'%');
        }

        if($category!=NULL){
            $projects = $projects->where('category_type_topic_standardize', '=', $category);
        }

        if($city!=NULL){
            $projects = $projects->where('name_dept_agency_cbo', '=', $city);
        }
        $projects = $projects->get();

        return view('frontEnd.explore1', compact('projects'))->render();

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
