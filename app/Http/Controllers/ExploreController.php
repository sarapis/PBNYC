<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\District;
use App\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
            $districts = District::orderBy('name')->get();
            $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
            $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
            $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
            $address_district= District::where('name', '=', 1)->get();
            


           

            if ($request->input('search')) {

                $search = $request->input('search');
                $projects= Project::with('district')->where('project_title', 'like', '%'.$search.'%')->orwhere('project_description', 'like', '%'.$search.'%')->orwhere('neighborhood', 'like', '%'.$search.'%')->orwhereHas('district', function ($q)  use($search){
                    $q->where('name', 'like', '%'.$search.'%');
                })->sortable()->paginate(20);

                return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities', 'address_district'));
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
                })->sortable()->paginate(20);

                $address_district=District::where('cityCouncilDistrict', '=', $cityCouncilDistrict)->first();
                
                
                if($address_district == NULL){
                    return redirect()->back();
                }
                
                $address_district=$address_district->name;
                
                return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities', 'address_district'));
            }

        $projects = Project::sortable()->paginate(20);
        
        return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities', 'count', 'address_district'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function status($id)
    // {
    //     $projects = Project::where('project_status', 'like', '%' . $id . '%')->sortable()->paginate(20);
    //     $districts = District::orderBy('name')->get();
    //     $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
    //     $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
    //     $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
    //     return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    // }

    // public function district($id)
    // {
    //     $projects = Project::where('district_ward_name', '=', $id)->sortable()->paginate(20);
    //     $districts = District::orderBy('name')->get();
    //     $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
    //     $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
    //     $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
    //     return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    // }

    // public function category($id)
    // {
    //     $projects = Project::where('category_type_topic_standardize', '=', $id)->sortable()->paginate(20);
    //     $districts = District::orderBy('name')->get();
    //     $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
    //     $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
    //     $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
    //     return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    // }

    // public function cityagency($id)
    // {
    //     $projects = Project::where('name_dept_agency_cbo', '=', $id)->sortable()->paginate(20);
    //     $districts = District::orderBy('name')->get();
    //     $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
    //     $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
    //     $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
    //     return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function search(Request $request)
    // {
    //     $search = $request->input('search');
    //     $projects= Project::with('district')->where('project_title', 'like', '%'.$search.'%')->orwhere('project_description', 'like', '%'.$search.'%')->orwhere('neighborhood', 'like', '%'.$search.'%')->orwhereHas('district', function ($q)  use($search){
    //            $q->where('name', 'like', '%'.$search.'%');
    //         })->sortable()->paginate(20);


    //     $districts = District::orderBy('name')->get();
    //     $states = Project::orderBy('project_status')->distinct()->get(['project_status']);
    //     $categories = Project::orderBy('category_type_topic_standardize')->distinct()->get(['category_type_topic_standardize']);
    //     $cities = Project::orderBy('name_dept_agency_cbo')->distinct()->get(['name_dept_agency_cbo']);
    //     return view('frontEnd.explore', compact('projects', 'districts', 'states', 'categories', 'cities'));
    // }

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
               $q->whereBetween('vote_year', [$year_min, $year_max]); })->sortable()->paginate(20);

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
       
                
                $price_min = (int)$request->input('price_min');
                $price_max = (int)$request->input('price_max');
                $year_min = $request->input('year_min');
                $year_max = $request->input('year_max');
                $vote_min = (int)$request->input('vote_min');
                $vote_max = (int)$request->input('vote_max');

                $district = $request->input('District');
                $status = $request->input('Status');
                $category = $request->input('Category');        
                $city = $request->input('City');
            
                // var_dump($price_min,$price_max,$year_min,$year_max,$vote_min,$vote_max,$district,$status,$category,$city);
                //  exit(); 

                $projects = Project::whereBetween('cost_num', [$price_min, $price_max])->whereBetween('votes', [$vote_min, $vote_max])->whereBetween('vote_year', [$year_min, $year_max]);
                           
                 // var_dump($price_min,$price_max,$year_min,$year_max,$vote_min,$vote_max,$district,$status,$category,$city,count($projects));
                 // exit(); 


                if($district!=NULL){

                    $district = District::where('name', '=', $district)->first();
                    $district = $district->recordid;
                    $projects = $projects->where('district_ward_name', '=', $district);
                    
                }
                
                if($status!=NULL){
                    if($status=='Not Funded'){
                        
                        $projects = $projects->whereIn('project_status',['Lost vote', 'On hold - Requires Additional Funds', 'Rejected']);
                      

                    }
                    else{
                        $projects = $projects->where('project_status', 'like', '%'.$status.'%');
                        
                    }
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
