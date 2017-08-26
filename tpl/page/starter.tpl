<section class="section">
    <div class="row sameheight-container">
        <div class="col col-xs-12 col-sm-12 col-md-6 col-xl-5 stats-col">
            <div class="card sameheight-item stats" data-exclude="xs">
                <div class="card-block">
                    <div class="title-block">
                        <h4 class="title"> Статистика </h4>
                    </div>
                    <div class="row row-sm stats-container">
                        <div class="col-xs-12 col-sm-6 stat-col">
                            <div class="stat-icon"> <i class="fa fa-rocket"></i> </div>
                            <div class="stat">
                                <div class="value"> 0 </div>
                                <div class="name"> Сообщений отправлено </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 stat-col">
                            <div class="stat-icon"> <i class="fa fa-shopping-cart"></i> </div>
                            <div class="stat">
                                <div class="value"> 0 </div>
                                <div class="name"> Кликов по рекламе </div>
                            </div> 
                        </div>
                        <div class="col-xs-12 col-sm-6  stat-col">
                            <div class="stat-icon"> <i class="fa fa-users"></i> </div>
                            <div class="stat">
                            <div class="value"> {count_admin} </div>
                                <div class="name"> Администраторов </div>
                            </div>  
                        </div>
                        <div class="col-xs-12 col-sm-6  stat-col">
                            <div class="stat-icon"> <i class="fa fa-list-alt"></i> </div>
                            <div class="stat">
                                <div class="value"> {count_groups} </div>
                                <div class="name"> Сообществ </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-xs-12 col-sm-12 col-md-6 col-xl-7 history-col" style="display: none;">
            <div class="card sameheight-item" data-exclude="xs">
                <div class="card-header card-header-sm bordered">
                    <div class="header-block">
                        <h3 class="title">History</h3>
                    </div>
                    <ul class="nav nav-tabs pull-right" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" href="#visits" role="tab" data-toggle="tab">Visits</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="#downloads" role="tab" data-toggle="tab">Downloads</a> </li>
                    </ul>
                </div>
                <div class="card-block">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active fade in" id="visits">
                            <p class="title-description"> Number of unique visits last 30 days </p>
                            <div id="dashboard-visits-chart"></div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="downloads">
                            <p class="title-description"> Number of downloads last 30 days </p>
                            <div id="dashboard-downloads-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section" style="display: none;">
    <div class="row sameheight-container">
        <div class="col-xl-8">
            <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                <div class="card-header bordered">
                    <div class="header-block">
                        <h3 class="title"> Items </h3> <a href="item-editor.html" class="btn btn-primary btn-sm rounded">
                        Add new
                    </a> </div>
                    <div class="header-block pull-right"> <label class="search">
                        <input class="search-input" placeholder="search...">
                        <i class="fa fa-search search-icon"></i>
                    </label>
                    <div class="pagination"> <a href="" class="btn btn-primary btn-sm rounded">
                     <i class="fa fa-angle-up"></i>
                 </a> <a href="" class="btn btn-primary btn-sm rounded">
                 <i class="fa fa-angle-down"></i>
             </a> </div>
         </div>
     </div>
     <ul class="item-list striped">
        <li class="item item-list-header hidden-sm-down">
            <div class="item-row">
                <div class="item-col item-col-header fixed item-col-img xs"></div>
                <div class="item-col item-col-header item-col-title">
                    <div> <span>Name</span> </div>
                </div>
                <div class="item-col item-col-header item-col-sales">
                    <div> <span>Sales</span> </div>
                </div>
                <div class="item-col item-col-header item-col-stats">
                    <div class="no-overflow"> <span>Stats</span> </div>
                </div>
                <div class="item-col item-col-header item-col-date">
                    <div> <span>Published</span> </div>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="item-row">
                <div class="item-col fixed item-col-img xs">
                    <a href="">
                        <div class="item-img xs rounded" style="background-image: url(https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg)"></div>
                    </a>
                </div>
                <div class="item-col item-col-title no-overflow">
                    <div>
                        <a href="" class="">
                            <h4 class="item-title no-wrap"> 12 Myths Uncovered About IT &amp; Software </h4>
                        </a>
                    </div>
                </div>
                <div class="item-col item-col-sales">
                    <div class="item-heading">Sales</div>
                    <div> 4958 </div>
                </div>
                <div class="item-col item-col-stats">
                    <div class="item-heading">Stats</div>
                    <div class="no-overflow">
                        <div class="item-stats sparkline" data-type="bar"></div>
                    </div>
                </div>
                <div class="item-col item-col-date">
                    <div class="item-heading">Published</div>
                    <div> 21 SEP 10:45 </div>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="item-row">
                <div class="item-col fixed item-col-img xs">
                    <a href="">
                        <div class="item-img xs rounded" style="background-image: url(https://s3.amazonaws.com/uifaces/faces/twitter/_everaldo/128.jpg)"></div>
                    </a>
                </div>
                <div class="item-col item-col-title no-overflow">
                    <div>
                        <a href="" class="">
                            <h4 class="item-title no-wrap"> 50% of things doesn&#x27;t really belongs to you </h4>
                        </a>
                    </div>
                </div>
                <div class="item-col item-col-sales">
                    <div class="item-heading">Sales</div>
                    <div> 192 </div>
                </div>
                <div class="item-col item-col-stats">
                    <div class="item-heading">Stats</div>
                    <div class="no-overflow">
                        <div class="item-stats sparkline" data-type="bar"></div>
                    </div>
                </div>
                <div class="item-col item-col-date">
                    <div class="item-heading">Published</div>
                    <div> 21 SEP 10:45 </div>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="item-row">
                <div class="item-col fixed item-col-img xs">
                    <a href="">
                        <div class="item-img xs rounded" style="background-image: url(https://s3.amazonaws.com/uifaces/faces/twitter/eduardo_olv/128.jpg)"></div>
                    </a>
                </div>
                <div class="item-col item-col-title no-overflow">
                    <div>
                        <a href="" class="">
                            <h4 class="item-title no-wrap"> Vestibulum tincidunt amet laoreet mauris sit sem aliquam cras maecenas vel aliquam. </h4>
                        </a>
                    </div>
                </div>
                <div class="item-col item-col-sales">
                    <div class="item-heading">Sales</div>
                    <div> 2143 </div>
                </div>
                <div class="item-col item-col-stats">
                    <div class="item-heading">Stats</div>
                    <div class="no-overflow">
                        <div class="item-stats sparkline" data-type="bar"></div>
                    </div>
                </div>
                <div class="item-col item-col-date">
                    <div class="item-heading">Published</div>
                    <div> 21 SEP 10:45 </div>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="item-row">
                <div class="item-col fixed item-col-img xs">
                    <a href="">
                        <div class="item-img xs rounded" style="background-image: url(https://s3.amazonaws.com/uifaces/faces/twitter/why_this/128.jpg)"></div>
                    </a>
                </div>
                <div class="item-col item-col-title no-overflow">
                    <div>
                        <a href="" class="">
                            <h4 class="item-title no-wrap"> 10 tips of Object Oriented Design </h4>
                        </a>
                    </div>
                </div>
                <div class="item-col item-col-sales">
                    <div class="item-heading">Sales</div>
                    <div> 124 </div>
                </div>
                <div class="item-col item-col-stats">
                    <div class="item-heading">Stats</div>
                    <div class="no-overflow">
                        <div class="item-stats sparkline" data-type="bar"></div>
                    </div>
                </div>
                <div class="item-col item-col-date">
                    <div class="item-heading">Published</div>
                    <div> 21 SEP 10:45 </div>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="item-row">
                <div class="item-col fixed item-col-img xs">
                    <a href="">
                        <div class="item-img xs rounded" style="background-image: url(https://s3.amazonaws.com/uifaces/faces/twitter/w7download/128.jpg)"></div>
                    </a>
                </div>
                <div class="item-col item-col-title no-overflow">
                    <div>
                        <a href="" class="">
                            <h4 class="item-title no-wrap"> Sometimes friend tells it is cold </h4>
                        </a>
                    </div>
                </div>
                <div class="item-col item-col-sales">
                    <div class="item-heading">Sales</div>
                    <div> 10214 </div>
                </div>
                <div class="item-col item-col-stats">
                    <div class="item-heading">Stats</div>
                    <div class="no-overflow">
                        <div class="item-stats sparkline" data-type="bar"></div>
                    </div>
                </div>
                <div class="item-col item-col-date">
                    <div class="item-heading">Published</div>
                    <div> 21 SEP 10:45 </div>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="item-row">
                <div class="item-col fixed item-col-img xs">
                    <a href="">
                        <div class="item-img xs rounded" style="background-image: url(https://s3.amazonaws.com/uifaces/faces/twitter/pankogut/128.jpg)"></div>
                    </a>
                </div>
                <div class="item-col item-col-title no-overflow">
                    <div>
                        <a href="" class="">
                            <h4 class="item-title no-wrap"> New ways of conceptual thinking </h4>
                        </a>
                    </div>
                </div>
                <div class="item-col item-col-sales">
                    <div class="item-heading">Sales</div>
                    <div> 3217 </div>
                </div>
                <div class="item-col item-col-stats">
                    <div class="item-heading">Stats</div>
                    <div class="no-overflow">
                        <div class="item-stats sparkline" data-type="bar"></div>
                    </div>
                </div>
                <div class="item-col item-col-date">
                    <div class="item-heading">Published</div>
                    <div> 21 SEP 10:45 </div>
                </div>
            </div>
        </li>
    </ul>
</div>
</div>
<div class="col-md-4">
    <div class="card tasks sameheight-item" data-exclude="xs,sm">
        <div class="card-header bordered">
            <div class="header-block">
                <h3 class="title"> Tasks </h3>
            </div>
            <div class="header-block pull-right"> <a href="" class="btn btn-primary btn-sm rounded pull-right">
                Add new
            </a> </div>
        </div>
        <div class="card-block">
            <div class="tasks-block">
                <ul class="item-list">
                    <li class="item">
                        <div class="item-row">
                            <div class="item-col item-col-title"> <label>
                                <input class="checkbox" type="checkbox"
                                checked="checked"> 
                                <span>Meeting with embassador</span>
                            </label> </div>
                            <div class="item-col fixed item-col-actions-dropdown">
                                <div class="item-actions-dropdown"> <a class="item-actions-toggle-btn">
                                    <span class="inactive">
                                        <i class="fa fa-cog"></i>
                                    </span>
                                    <span class="active">
                                        <i class="fa fa-chevron-circle-right"></i>
                                    </span>
                                </a>
                                <div class="item-actions-block">
                                    <ul class="item-actions-list">
                                        <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                                            <i class="fa fa-trash-o "></i>
                                        </a> </li>
                                        <li> <a class="check" href="#">
                                            <i class="fa fa-check"></i>
                                        </a> </li>
                                        <li> <a class="edit" href="item-editor.html">
                                            <i class="fa fa-pencil"></i>
                                        </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item">
                    <div class="item-row">
                        <div class="item-col item-col-title"> <label>
                            <input class="checkbox" type="checkbox"
                            checked="checked"> 
                            <span>Confession</span>
                        </label> </div>
                        <div class="item-col fixed item-col-actions-dropdown">
                            <div class="item-actions-dropdown"> <a class="item-actions-toggle-btn">
                                <span class="inactive">
                                    <i class="fa fa-cog"></i>
                                </span>
                                <span class="active">
                                    <i class="fa fa-chevron-circle-right"></i>
                                </span>
                            </a>
                            <div class="item-actions-block">
                                <ul class="item-actions-list">
                                    <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                                        <i class="fa fa-trash-o "></i>
                                    </a> </li>
                                    <li> <a class="check" href="#">
                                        <i class="fa fa-check"></i>
                                    </a> </li>
                                    <li> <a class="edit" href="item-editor.html">
                                        <i class="fa fa-pencil"></i>
                                    </a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="item">
                <div class="item-row">
                    <div class="item-col item-col-title"> <label>
                        <input class="checkbox" type="checkbox"
                        > 
                        <span>Time to start building an ark</span>
                    </label> </div>
                    <div class="item-col fixed item-col-actions-dropdown">
                        <div class="item-actions-dropdown"> <a class="item-actions-toggle-btn">
                            <span class="inactive">
                                <i class="fa fa-cog"></i>
                            </span>
                            <span class="active">
                                <i class="fa fa-chevron-circle-right"></i>
                            </span>
                        </a>
                        <div class="item-actions-block">
                            <ul class="item-actions-list">
                                <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                                    <i class="fa fa-trash-o "></i>
                                </a> </li>
                                <li> <a class="check" href="#">
                                    <i class="fa fa-check"></i>
                                </a> </li>
                                <li> <a class="edit" href="item-editor.html">
                                    <i class="fa fa-pencil"></i>
                                </a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="item-row">
                <div class="item-col item-col-title"> <label>
                    <input class="checkbox" type="checkbox"
                    > 
                    <span>Beer time with dudes</span>
                </label> </div>
                <div class="item-col fixed item-col-actions-dropdown">
                    <div class="item-actions-dropdown"> <a class="item-actions-toggle-btn">
                        <span class="inactive">
                            <i class="fa fa-cog"></i>
                        </span>
                        <span class="active">
                            <i class="fa fa-chevron-circle-right"></i>
                        </span>
                    </a>
                    <div class="item-actions-block">
                        <ul class="item-actions-list">
                            <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                                <i class="fa fa-trash-o "></i>
                            </a> </li>
                            <li> <a class="check" href="#">
                                <i class="fa fa-check"></i>
                            </a> </li>
                            <li> <a class="edit" href="item-editor.html">
                                <i class="fa fa-pencil"></i>
                            </a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="item">
        <div class="item-row">
            <div class="item-col item-col-title"> <label>
                <input class="checkbox" type="checkbox"
                checked="checked"> 
                <span>Meeting new girls</span>
            </label> </div>
            <div class="item-col fixed item-col-actions-dropdown">
                <div class="item-actions-dropdown"> <a class="item-actions-toggle-btn">
                    <span class="inactive">
                        <i class="fa fa-cog"></i>
                    </span>
                    <span class="active">
                        <i class="fa fa-chevron-circle-right"></i>
                    </span>
                </a>
                <div class="item-actions-block">
                    <ul class="item-actions-list">
                        <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                            <i class="fa fa-trash-o "></i>
                        </a> </li>
                        <li> <a class="check" href="#">
                            <i class="fa fa-check"></i>
                        </a> </li>
                        <li> <a class="edit" href="item-editor.html">
                            <i class="fa fa-pencil"></i>
                        </a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>
<li class="item">
    <div class="item-row">
        <div class="item-col item-col-title"> <label>
            <input class="checkbox" type="checkbox"
            > 
            <span>Remember damned home address</span>
        </label> </div>
        <div class="item-col fixed item-col-actions-dropdown">
            <div class="item-actions-dropdown"> <a class="item-actions-toggle-btn">
                <span class="inactive">
                    <i class="fa fa-cog"></i>
                </span>
                <span class="active">
                    <i class="fa fa-chevron-circle-right"></i>
                </span>
            </a>
            <div class="item-actions-block">
                <ul class="item-actions-list">
                    <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                        <i class="fa fa-trash-o "></i>
                    </a> </li>
                    <li> <a class="check" href="#">
                        <i class="fa fa-check"></i>
                    </a> </li>
                    <li> <a class="edit" href="item-editor.html">
                        <i class="fa fa-pencil"></i>
                    </a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</li>

<li class="item">
    <div class="item-row">
        <div class="item-col item-col-title"> <label>
            <input class="checkbox" type="checkbox"
            checked="checked"> 
            <span>Confession</span>
        </label> </div>
        <div class="item-col fixed item-col-actions-dropdown">
            <div class="item-actions-dropdown"> <a class="item-actions-toggle-btn">
                <span class="inactive">
                    <i class="fa fa-cog"></i>
                </span>
                <span class="active">
                    <i class="fa fa-chevron-circle-right"></i>
                </span>
            </a>
            <div class="item-actions-block">
                <ul class="item-actions-list">
                    <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                        <i class="fa fa-trash-o "></i>
                    </a> </li>
                    <li> <a class="check" href="#">
                        <i class="fa fa-check"></i>
                    </a> </li>
                    <li> <a class="edit" href="item-editor.html">
                        <i class="fa fa-pencil"></i>
                    </a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</li>
<li class="item">
    <div class="item-row">
        <div class="item-col item-col-title"> <label>
            <input class="checkbox" type="checkbox"
            > 
            <span>Time to start building an ark</span>
        </label> </div>
        <div class="item-col fixed item-col-actions-dropdown">
            <div class="item-actions-dropdown"> <a class="item-actions-toggle-btn">
                <span class="inactive">
                    <i class="fa fa-cog"></i>
                </span>
                <span class="active">
                    <i class="fa fa-chevron-circle-right"></i>
                </span>
            </a>
            <div class="item-actions-block">
                <ul class="item-actions-list">
                    <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                        <i class="fa fa-trash-o "></i>
                    </a> </li>
                    <li> <a class="check" href="#">
                        <i class="fa fa-check"></i>
                    </a> </li>
                    <li> <a class="edit" href="item-editor.html">
                        <i class="fa fa-pencil"></i>
                    </a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</li>
<li class="item">
    <div class="item-row">
        <div class="item-col item-col-title"> <label>
            <input class="checkbox" type="checkbox"
            > 
            <span>Beer time with dudes</span>
        </label> </div>
        <div class="item-col fixed item-col-actions-dropdown">
            <div class="item-actions-dropdown"> <a class="item-actions-toggle-btn">
                <span class="inactive">
                    <i class="fa fa-cog"></i>
                </span>
                <span class="active">
                    <i class="fa fa-chevron-circle-right"></i>
                </span>
            </a>
            <div class="item-actions-block">
                <ul class="item-actions-list">
                    <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                        <i class="fa fa-trash-o "></i>
                    </a> </li>
                    <li> <a class="check" href="#">
                        <i class="fa fa-check"></i>
                    </a> </li>
                    <li> <a class="edit" href="item-editor.html">
                        <i class="fa fa-pencil"></i>
                    </a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</li>
<li class="item">
    <div class="item-row">
        <div class="item-col item-col-title"> <label>
            <input class="checkbox" type="checkbox"
            checked="checked"> 
            <span>Meeting new girls</span>
        </label> </div>
        <div class="item-col fixed item-col-actions-dropdown">
            <div class="item-actions-dropdown"> <a class="item-actions-toggle-btn">
                <span class="inactive">
                    <i class="fa fa-cog"></i>
                </span>
                <span class="active">
                    <i class="fa fa-chevron-circle-right"></i>
                </span>
            </a>
            <div class="item-actions-block">
                <ul class="item-actions-list">
                    <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                        <i class="fa fa-trash-o "></i>
                    </a> </li>
                    <li> <a class="check" href="#">
                        <i class="fa fa-check"></i>
                    </a> </li>
                    <li> <a class="edit" href="item-editor.html">
                        <i class="fa fa-pencil"></i>
                    </a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</li>
<li class="item">
    <div class="item-row">
        <div class="item-col item-col-title"> <label>
            <input class="checkbox" type="checkbox"
            > 
            <span>Remember damned home address</span>
        </label> </div>
        <div class="item-col fixed item-col-actions-dropdown">
            <div class="item-actions-dropdown"> <a class="item-actions-toggle-btn">
                <span class="inactive">
                    <i class="fa fa-cog"></i>
                </span>
                <span class="active">
                    <i class="fa fa-chevron-circle-right"></i>
                </span>
            </a>
            <div class="item-actions-block">
                <ul class="item-actions-list">
                    <li> <a class="remove" href="#" data-toggle="modal" data-target="#confirm-modal">
                        <i class="fa fa-trash-o "></i>
                    </a> </li>
                    <li> <a class="check" href="#">
                        <i class="fa fa-check"></i>
                    </a> </li>
                    <li> <a class="edit" href="item-editor.html">
                        <i class="fa fa-pencil"></i>
                    </a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</section>