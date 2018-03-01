<nav id="sidebar">
    <div class="sidebar-header p-10">
        <div class="form-group" style="margin: 0;">
        <!--begin::Form-->
            <form method="post" action="{{action('ExploreController@search')}}" class="mb-5">
                {{ csrf_field() }}
                <div class="input-search">
                    <i class="input-search-icon md-search" aria-hidden="true"></i>
                    <input type="text" class="form-control search-form" name="search" placeholder="Search for Projects">
                </div>
            </form>
        </div>
    </div>
    <!-- Example Tabs In The Panel -->
    <div class="nav-tabs-horizontal" data-plugin="tabs">
        <ul class="nav nav-tabs nav-tabs-line" role="tablist" style="height: 45px;">
            <li class="nav-item tab-menu"><a class="nav-link active" data-toggle="tab" href="#exampleTopHome"
            aria-controls="exampleTopHome" role="tab" id="tab_filter">FILTER</a></li>
            <li class="nav-item tab-menu"><a class="nav-link" data-toggle="tab" href="#exampleTopComponents"
            aria-controls="exampleTopComponents" role="tab" id="tab_sort">SORT</a></li>
            <li class="nav-item tab-menu" style="width: 50px; ">
                 <button type="button" id="sidebarCollapse1" class="navbar-toggler  hamburger-close navbar-toggler-center hided" style="color: #757575; padding-top:0px; padding-right: 0px; padding-left: 40px;">
                  <i class="icon glyphicon glyphicon-chevron-left"></i>
                </button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="exampleTopHome" role="tabpanel">
                <ul class="list-unstyled components mb-0 pb-5">
                    <li class="option-side">
                        <a href="#district" class="text-side" data-toggle="collapse" aria-expanded="false">District</a>
                        <ul class="collapse list-unstyled" id="district">
                            @foreach($districts as $district)
                                @if($district->name!='')
                                <li>{{$district->name}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="option-side">
                        <a href="#projectstatus" class="text-side" data-toggle="collapse" aria-expanded="false">Project Status</a>
                        <ul class="collapse list-unstyled" id="projectstatus">
                            @foreach($states as $state)
                                @if($state->project_status=='Complete')
                                    <li><i class="icon fa-check" aria-hidden="true"></i></button><span style="position: absolute; line-height: 20px; padding: 5px;">Completed</span></li>
                                @elseif($state->project_status=='Rejected')
                                    <li><button type="button" class="btn btn-floating  btn-xs waves-effect waves-classic mr-10"></button><span style="position: absolute; line-height: 20px; padding: 5px;">Not Funded</span></li>
                                @elseif($state->project_status=='Project Status Needed')
                                    <li><button type="button" class="btn btn-floating btn-danger btn-xs waves-effect waves-classic mr-10"><i class="icon fa-remove" aria-hidden="true"></i></button><span style="position: absolute; line-height: 20px; padding: 5px;">Status Needed</span></li>
                                @endif
                            @endforeach
                                <li><button type="button" class="btn btn-floating btn-warning btn-xs waves-effect waves-classic mr-10"><i class="icon fa-minus" aria-hidden="true"></i></button><span style="position: absolute; line-height: 20px; padding: 5px;">In Process</span></li>
                        </ul>
                    </li>
                </ul>    
                <!-- Example Range -->
                <div class="row range-side">
                    <div class="col-xs-5 pl-5 pt-10"><a class="text-side">Cost</a></div>
                    <div class="col-xs-7 example mb-0 p-0">
                        
                         
                        <div id="slider-range" class="ml-10 mr-10"></div>
                        <p class="text-side text-center mt-15 mb-0">
                          <input type="text" id="amount" readonly style="border:0;    width: 100%;text-align: center;">
                        </p>
                    </div>
                </div>
                <!-- End Example Range -->
                <!-- Example Range -->
                <div class="row range-side">
                    <div class="col-xs-5 pl-5 pt-10"><a class="text-side">Year of Vote</a></div>
                    <div class="col-xs-7 example mb-0 p-0">
                        
                         
                        <div id="slider-range-year" class="ml-10 mr-10"></div>
                        <p class="text-side text-center mt-15 mb-0">
                          <input type="text" id="amount-year" readonly style="border:0;    width: 100%;text-align: center;">
                        </p>
                    </div>
                </div>
                <!-- End Example Range -->
                <!-- Example Range -->
                <!-- <div class="row range-side">
                    <div class="col-md-5 pl-5 pt-20"><a class="text-side">Vote</a></div>
                    <div class="col-md-7 example mt-30 mb-0 p-0">
                      <div class="asRange" data-plugin="asRange" data-namespace="rangeUi" data-step="1"
                      data-min="0" data-max="6000" data-range="true" data-tip=true data-value="[1000,5000]"></div>
                      <p class="text-side mt-15 mb-0">0 - 6000</p>
                    </div>
                </div> -->
                <!-- End Example Range -->
                <!-- Example Range -->
                <div class="row range-side">
                    <div class="col-xs-5 pl-5 pt-10"><a class="text-side">Vote</a></div>
                    <div class="col-xs-7 example mb-0 p-0">
                        
                         
                        <div id="slider-range-vote" class="ml-10 mr-10"></div>
                        <p class="text-side text-center mt-15 mb-0">
                          <input type="text" id="amount-vote" readonly style="border:0;    width: 100%;text-align: center;">
                        </p>
                    </div>
                </div>
                <!-- End Example Range -->
                
                <ul class="list-unstyled components pt-0">    
                    
                    <li class="option-side">
                        <a href="#projectcategory" class="text-side" data-toggle="collapse" aria-expanded="false">Project Category</a>
                        <ul class="collapse list-unstyled" id="projectcategory">
                            @foreach($categories as $category)
                                @if($category->category_type_topic_standardize!='')
                                <li>{{$category->category_type_topic_standardize}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="option-side">
                        <a href="#cityagency" class="text-side" data-toggle="collapse" aria-expanded="false">City Agency</a>
                        <ul class="collapse list-unstyled" id="cityagency">
                            @foreach($cities as $city)
                                @if($city->name_dept_agency_cbo!='')
                                <li>{{$city->name_dept_agency_cbo}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="exampleTopComponents" role="tabpanel">
                <ul class="list-unstyled components">
                    <li class="nav-tabs">
                        <a href="?sort=cost_text&order=asc">Price: Low to High</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="?sort=cost_text&order=desc">Price: High to Low</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="?sort=process.vote_year&order=asc">Year: Low to High</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="?sort=process.vote_year&order=desc">Year: High to Low</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="?sort=votes&order=asc">Votes: Low to High</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="?sort=votes&order=desc">Votes: High to Low</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="?sort=status_date_updated&order=asc">Update: Low to High</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="?sort=status_date_updated&order=desc">Update: High to Low</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
