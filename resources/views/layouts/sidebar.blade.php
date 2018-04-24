<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<nav id="sidebar">
    <div class="sidebar-header p-10">
        <div class="form-group" style="margin: 0;">
        <!--begin::Form-->
            <div class="mb-5">
                <div class="input-search">
                    <i class="input-search-icon md-search" aria-hidden="true"></i>
                    <input type="text" class="form-control search-form" name="search" placeholder="Search for Projects" id="search_address">
                </div>
            </div>
        </div>
    </div>
    <!-- Example Tabs In The Panel -->
    <div class="nav-tabs-horizontal sidebar-tab" data-plugin="tabs">
        <ul class="nav nav-tabs nav-tabs-line" role="tablist" style="height: 45px;">
            <li class="nav-item tab-menu active"><a class="nav-link" data-toggle="tab" href="#exampleTopHome"
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
            <!-- <div class="form-group" style="margin: 0;">
                    <form method="get" action="/explore">
                        <div class="form-group">
                          
                            <div class="input-search sidebar-search">
                                <i class="input-search-icon md-search" aria-hidden="true"></i>
                                <input id="location" type="text" class="form-control text-black" name="address" placeholder="Search Street Address" style="border-radius:0;">
                            </div>
                          
                        </div>
                    </form>
                </div> -->
                <div class="form-group" style="padding: 7px 7px 0 7px; margin-bottom: 0px;">
                    <!--begin::Form-->
                    <form method="get" class="mb-5" id="search_location">
                        <div class="input-search">
                            <i class="input-search-icon md-search" aria-hidden="true"></i>
                            <input id="location" type="text" class="form-control search-form" name="address" placeholder="Search Street Address">
                        </div>
                    </form>
                </div>
                <ul class="list-unstyled components mb-0 pb-5">
<!--                <li class="option-side">
                        <a href="#district" class="text-side" data-toggle="collapse" aria-expanded="false">District</a>
                        <ul class="collapse list-unstyled option-ul" id="district">
                            @foreach($districts as $district)
                                @if($district->name!='')
                                <li class="option-li">{{$district->name}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </li> -->
                    <li class="option-side">
                        <a href="#projectstatus" class="text-side" data-toggle="collapse" aria-expanded="false">Project Status</a>
                        <ul class="collapse list-unstyled option-ul" id="projectstatus">
                    
                            <li class="option-li"><button type="button" class="btn btn-floating btn-success btn-xs waves-effect waves-classic mr-10"><i class="icon fa-check" aria-hidden="true"></i></button><span style="position: absolute; line-height: 20px; padding: 5px;">Complete</span></li>

                            <li class="option-li"><button type="button" class="btn btn-floating btn-warning btn-xs waves-effect waves-classic mr-10"><i class="icon fa-minus" aria-hidden="true"></i></button><span style="position: absolute; line-height: 20px; padding: 5px;">In process</span></li>
                        
                            <li class="option-li"><button type="button" class="btn btn-floating btn-danger btn-xs waves-effect waves-classic mr-10"><i class="icon fa-remove" aria-hidden="true"></i></button><span style="position: absolute; line-height: 20px; padding: 5px;">Not funded</span></li>
                      
                            <li class="option-li"><button type="button" class="btn btn-floating  btn-xs waves-effect waves-classic mr-10"></button><span style="position: absolute; line-height: 20px; padding: 5px;">Status Needed</span></li>
                    
                            
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
                        <ul class="collapse list-unstyled option-ul" id="projectcategory">
                            @foreach($categories as $category)
                                @if($category->category_type_topic_standardize!='')
                                <li class="option-li">{{$category->category_type_topic_standardize}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li class="option-side">
                        <a href="#cityagency" class="text-side" data-toggle="collapse" aria-expanded="false">City Agency</a>
                        <ul class="collapse list-unstyled option-ul" id="cityagency">
                            @foreach($cities as $city)
                                @if($city->name_dept_agency_cbo!='')
                                <li class="option-li">{{$city->name_dept_agency_cbo}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="exampleTopComponents" role="tabpanel">
                <ul class="list-unstyled components">
                    <li class="nav-tabs">
                        <a>Price: Low to High</a>
                    </li>
                    <li class="nav-tabs">
                        <a>Price: High to Low</a>
                    </li>
                    <li class="nav-tabs">
                        <a>Year: Low to High</a>
                    </li>
                    <li class="nav-tabs">
                        <a>Year: High to Low</a>
                    </li>
                    <li class="nav-tabs">
                        <a>Votes: Low to High</a>
                    </li>
                    <li class="nav-tabs">
                        <a>Votes: High to Low</a>
                    </li>
                    <li class="nav-tabs">
                        <a>Status: Complete to Needed</a>
                    </li>
                    <li class="nav-tabs">
                        <a>Status: Needed to Complete</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</nav>
@if(isset($location) == TRUE)
    <input type="hidden" name="location" id="location" value="{{$location}}">
@else
    <input type="hidden" name="location" id="location" value="">
@endif

<script>

$(function () {
    var getData = function (request, response) {
        $.getJSON(
            "https://geosearch.planninglabs.nyc/v1/autocomplete?text=" + request.term,
            function (data) {
                response(data.features);
                
                var label = new Object();
                for(i = 0; i < data.features.length; i++)
                    label[i] = data.features[i].properties.label;
                response(label);
            });
    };
 
    var selectItem = function (event, ui) {
        $("#location").val(ui.item.value);
        return false;
    }
 
    $("#location").autocomplete({
        source: getData,
        select: selectItem,
        minLength: 2,
        change: function() {
            console.log(selectItem);

        }
    });

    $('.ui-menu').click(function(){
        $('#search_location').submit();
    });

  
});
</script>
