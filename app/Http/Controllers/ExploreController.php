<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\District;
use App\Contact;

class ExploreController extends Controller
{
    public function index()
    {
        $projects = Project::sortable()->paginate(20);
        $districts = District::orderBy('name')->get();
        $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
        $categories = Project::orderBy('category_topic_committee_raw')->distinct()->get(['category_topic_committee_raw']);
        $cities = Project::orderBy('location_city')->distinct()->get(['location_city']);
        return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $projects = Project::where('project_status', '=', $id)->sortable()->paginate(20);
        $districts = District::orderBy('name')->get();
        $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
        $categories = Project::orderBy('category_topic_committee_raw')->distinct()->get(['category_topic_committee_raw']);
        $cities = Project::orderBy('location_city')->distinct()->get(['location_city']);
        return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $contact = Contact::where('district_ward_name', '=', $district)->first();
        return view('frontEnd.profile', compact('project', 'contact'));
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
