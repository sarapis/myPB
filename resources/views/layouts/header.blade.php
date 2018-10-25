  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse bg-custom" role="navigation">
    <div class="navbar-header">
      <a class="navbar-brand p-25 pl-15" href="/">
        <img class="navbar-brand-logo navbar-brand-logo-normal" src="../../images/{{$layout->logo}}"
        title="{{$layout->site_name}}">
        <img class="navbar-brand-logo navbar-brand-logo-special" src="../../images/{{$layout->logo}}"
        title="{{$layout->site_name}}">
      </a>
      
      <!-- <a class="navbar-brand nav-item nav-link mr-0 pl-0 pr-5" href="/explore">Explore</a>
      <a class="navbar-brand nav-item nav-link mr-0 pl-0 pr-5" href="/about">About</a>
      <a class="navbar-brand nav-item nav-link mr-0 pl-0 pr-5" href="https://www.participatorybudgeting.org/donate/" target="_blank">Donate</a>
      <a class="navbar-brand nav-item mr-0 pl-0 pr-5" href="">Español</a> -->
        
        <ul class="nav navbar-toolbar nav-menubar pull-right">
          <li class="nav-item">
            <a class="nav-link text-white" href="/summary"><b>Summary</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/project"><b>Projects</b></a>
          </li>
          <li class="nav-item">
            <div id="google_translate_element" class="nav-link">
            </div>
          </li>
          <li class="nav-item">
            <div class="sharethis-inline-share-buttons pt-10"></div>
          </li>
        </ul>
        
    </div>
    <div class="navbar-container container-fluid p-0">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar show">
        <!-- Navbar Toolbar -->
        <div class="row">
          <div class="nav_mark pl-20" style="width: 20%">
            <button type="button" id="sidebarCollapse" class="navbar-toggler hamburger hamburger-close navbar-toggler-center hided" style="color: #757575;">
              <i class="icon glyphicon glyphicon-align-justify"></i>
              <span>Toggle Sidebar</span>
            </button>
          </div>
          <div class="filter_title filter-mobile" style="width: 80%;display: inline;">
            <div id = "filter_buttons">
              <button type="button" id="btn-search" class="btn btn-round btn-default example-default-hover btn-sm waves-effect waves-classic pull-left" style="display:none;"><b><span> Search:</span><i class="icon wb-close" aria-hidden="true"></i></b></button>
              <button type="button" id="btn-district" class="btn btn-round btn-default example-default-hover btn-sm waves-effect waves-classic pull-left" style="display:none;"><b><span> District:</span><i class="icon wb-close" aria-hidden="true"></i></b></button>
              <button type="button" id="btn-status" class="btn btn-round btn-default example-default-hover btn-sm waves-effect waves-classic pull-left" style="display:none;"><b><span> Status: </span><i class="icon wb-close" aria-hidden="true"></i></b></button>
              <button type="button" id="btn-cost" class="btn btn-round btn-default example-default-hover btn-sm waves-effect waves-classic pull-left" style="display:none;"><b><span> Cost: </span><i class="icon wb-close" aria-hidden="true"></i></b></button>
              <button type="button" id="btn-year" class="btn btn-round btn-default example-default-hover btn-sm waves-effect waves-classic pull-left" style="display:none;"><b><span> Year of Vote: </span><i class="icon wb-close" aria-hidden="true"></i></b></button>
              <button type="button" id="btn-vote" class="btn btn-round btn-default example-default-hover btn-sm waves-effect waves-classic pull-left" style="display:none;"><b><span> Vote: </span><i class="icon wb-close" aria-hidden="true"></i></b></button>
              <button type="button" id="btn-category" class="btn btn-round btn-default example-default-hover btn-sm waves-effect waves-classic pull-left" style="display:none;"><b><span> Category: </span><i class="icon wb-close" aria-hidden="true"></i></b></button>
              <button type="button" id="btn-city" class="btn btn-round btn-default example-default-hover btn-sm waves-effect waves-classic pull-left" style="display:none;"><b><span> City: </span><i class="icon wb-close" aria-hidden="true"></i></b></button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar Collapse -->
      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon md-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
              data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>

  </nav>