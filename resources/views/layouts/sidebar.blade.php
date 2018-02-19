<nav id="sidebar">
    <div class="sidebar-header" style="padding: 10px;">
        <div class="form-group" style="margin: 0;">
            <div class="input-search">
                <i class="input-search-icon md-search" aria-hidden="true"></i>
                <input type="text" class="form-control" name="" placeholder="Search..." style="border-radius:0;">
            </div>
        </div>
    </div>
    <!-- Example Tabs In The Panel -->
    <div class="nav-tabs-horizontal" data-plugin="tabs">
        <ul class="nav nav-tabs nav-tabs-line" role="tablist">
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#exampleTopHome"
            aria-controls="exampleTopHome" role="tab">FILTER</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#exampleTopComponents"
            aria-controls="exampleTopComponents" role="tab">SORT</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="exampleTopHome" role="tabpanel">
                <ul class="list-unstyled components mb-0 pb-5">
                    <li>
                        <a href="#district" data-toggle="collapse" aria-expanded="false">District</a>
                        <ul class="collapse list-unstyled" id="district">
                            <li><a href="#">Home 1</a></li>
                            <li><a href="#">Home 2</a></li>
                            <li><a href="#">Home 3</a></li>
                        </ul>
                    </li>
                </ul>    
                <!-- Example Range -->
                <div class="row m-5">
                    <div class="col-md-4 pl-5 pt-20"><a class="text-white">Range</a></div>
                    <div class="col-md-8 example mt-30 mb-0">
                      <div class="asRange" data-plugin="asRange" data-namespace="rangeUi" data-step="50"
                      data-min="0" data-max="175000" data-range="true" data-tip=true data-value="[10000,70000]"></div>
                      <p class="text-white mt-15 mb-0">$0 - $ 175,000</p>
                    </div>
                </div>
                <!-- End Example Range -->
                <!-- Example Range -->
                <div class="row m-5">
                    <div class="col-md-4 pl-5 pt-20"><a class="text-white">Year of Vote</a></div>
                    <div class="col-md-8 example mt-30 mb-0">
                      <div class="asRange" data-plugin="asRange" data-namespace="rangeUi" data-step="1"
                      data-min="2012" data-max="2017" data-range="true" data-tip=true data-value="[2012,2015]"></div>
                      <p class="text-white mt-15 mb-0">2012 - 2017</p>
                    </div>
                </div>
                <!-- End Example Range -->
                <!-- Example Range -->
                <div class="row m-5">
                    <div class="col-md-4 pl-5 pt-20"><a class="text-white">Vote</a></div>
                    <div class="col-md-8 example mt-30 mb-0">
                      <div class="asRange" data-plugin="asRange" data-namespace="rangeUi" data-step="1"
                      data-min="0" data-max="6000" data-range="true" data-tip=true data-value="[1000,5000]"></div>
                      <p class="text-white mt-15 mb-0">0 - 6000</p>
                    </div>
                </div>
                <!-- End Example Range -->
                <ul class="list-unstyled components pt-0">    
                    <li>
                        <a href="#projectstatus" data-toggle="collapse" aria-expanded="false">Project Status</a>
                        <ul class="collapse list-unstyled" id="projectstatus">
                            <li><a href="#">Page 1</a></li>
                            <li><a href="#">Page 2</a></li>
                            <li><a href="#">Page 3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#projectcategory" data-toggle="collapse" aria-expanded="false">Project Category</a>
                        <ul class="collapse list-unstyled" id="projectcategory">
                            <li><a href="#">Page 1</a></li>
                            <li><a href="#">Page 2</a></li>
                            <li><a href="#">Page 3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#cityagency" data-toggle="collapse" aria-expanded="false">City Agency</a>
                        <ul class="collapse list-unstyled" id="cityagency">
                            <li><a href="#">Page 1</a></li>
                            <li><a href="#">Page 2</a></li>
                            <li><a href="#">Page 3</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="exampleTopComponents" role="tabpanel">
                <ul class="list-unstyled components">
                    <li class="nav-tabs">
                        <a href="#">Price: Low to High</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="#">Price: High to Low</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="#">Year: Low to High</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="#">Year: High to Low</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="#">Votes: Low to High</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="#">Votes: High to Low</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="#">Update: Low to High</a>
                    </li>
                    <li class="nav-tabs">
                        <a href="#">Update: High to Low</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
