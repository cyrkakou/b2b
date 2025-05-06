<style>
    .content {
        padding:0px;
    }
</style>
<!-- Cover area -->
<div class="profile-cover">
    <div class="profile-cover-img"
         style="background-image: url(<?php _url('assets/global/images/cover2.jpg')?>"></div>
    <div class="media align-items-center text-center text-md-left flex-column flex-md-row m-0">
        <div class="mr-md-3 mb-2 mb-md-0">
            <a href="#" class="profile-thumb">
                <img src="<?php _url('assets/global/images/face1.jpg')?>" class="border-white rounded-circle"
                     width="48" height="48" alt="">
            </a>
        </div>

        <div class="media-body text-white">
            <h1 class="mb-0">Hanna Dorman</h1>
            <span class="d-block">UX/UI designer</span>
        </div>

        <div class="ml-md-3 mt-2 mt-md-0">
            <ul class="list-inline list-inline-condensed mb-0">
                <li class="list-inline-item"><a href="#" class="btn btn-light border-transparent"><i
                                class="icon-file-picture mr-2"></i> Cover image</a></li>
                <li class="list-inline-item"><a href="#" class="btn btn-light border-transparent"><i
                                class="icon-file-stats mr-2"></i> Statistics</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- /cover area -->


<!-- Profile navigation -->
<div class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                data-target="#navbar-second">
            <i class="icon-menu7 mr-2"></i>
            Profile navigation
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-second">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="#activity" class="navbar-nav-link" data-toggle="tab">
                    <i class="icon-menu7 mr-2"></i>
                    Activity
                </a>
            </li>
            <li class="nav-item">
                <a href="#schedule" class="navbar-nav-link active show" data-toggle="tab">
                    <i class="icon-calendar3 mr-2"></i>
                    Schedule
                    <span class="badge badge-pill bg-success position-static ml-auto ml-lg-2">32</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#settings" class="navbar-nav-link" data-toggle="tab">
                    <i class="icon-cog3 mr-2"></i>
                    Settings
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link">
                    <i class="icon-images3 mr-2"></i>
                    Photos
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-gear"></i>
                    <span class="d-lg-none ml-2">Settings</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-image2"></i> Update cover</a>
                    <a href="#" class="dropdown-item"><i class="icon-clippy"></i> Update info</a>
                    <a href="#" class="dropdown-item"><i class="icon-make-group"></i> Manage sections</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-three-bars"></i> Activity log</a>
                    <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Profile settings</a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /profile navigation -->
<!-- Content area -->
<div class="content" style="padding:1.25rem 1.25rem;">
    <!-- Inner container -->
    <div class="d-md-flex align-items-md-start">
        <!-- Right sidebar component -->
        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">

            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- Navigation -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="card-title font-weight-semibold">Navigation</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <ul class="nav nav-sidebar my-2">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-user"></i>
                                    My profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-cash3"></i>
                                    Balance
                                    <span class="text-muted font-size-sm font-weight-normal ml-auto">$1,430</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-tree7"></i>
                                    Connections
                                    <span class="badge bg-danger badge-pill ml-auto">29</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-users"></i>
                                    Friends
                                </a>
                            </li>

                            <li class="nav-item-divider"></li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-calendar3"></i>
                                    Events
                                    <span class="badge bg-teal-400 badge-pill ml-auto">48</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-cog3"></i>
                                    Account settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /navigation -->


                <!-- Share your thoughts -->
                <div class="card">
                    <div class="card-header bg-transparent header-elements-inline">
                        <span class="card-title font-weight-semibold">Share your thoughts</span>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="#">
                            <textarea name="enter-message" class="form-control mb-3" rows="3" cols="1"
                                      placeholder="Enter your message..."></textarea>

                            <div class="d-flex align-items-center">
                                <div class="list-icons list-icons-extended">
                                    <a href="#" class="list-icons-item" data-popup="tooltip" title=""
                                       data-container="body" data-original-title="Add photo"><i
                                                class="icon-images2"></i></a>
                                    <a href="#" class="list-icons-item" data-popup="tooltip" title=""
                                       data-container="body" data-original-title="Add video"><i class="icon-film2"></i></a>
                                    <a href="#" class="list-icons-item" data-popup="tooltip" title=""
                                       data-container="body" data-original-title="Add event"><i
                                                class="icon-calendar2"></i></a>
                                </div>

                                <button type="button" class="btn bg-blue btn-labeled btn-labeled-right ml-auto"><b><i
                                                class="icon-paperplane"></i></b> Share
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /share your thoughts -->






            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /right sidebar component -->
        <!-- Left content -->
        <div class="tab-content w-100 ">
            <div class="tab-pane fade" id="activity">

                <!-- Sales stats -->
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">Weekly statistics</h6>
                        <div class="header-elements">
                            <span><i class="icon-history mr-2 text-success"></i> Updated 3 hours ago</span>

                            <div class="list-icons ml-3">
                                <a class="list-icons-item" data-action="reload"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="weekly_statistics"
                                 style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;"
                                 _echarts_instance_="ec_1534978326688">
                                <div style="position: relative; overflow: hidden; width: 100px; height: 400px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                                    <canvas data-zr-dom-id="zr_0" width="100" height="400"
                                            style="position: absolute; left: 0px; top: 0px; width: 100px; height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                                </div>
                                <div style="position: absolute; display: none; border-style: solid; white-space: nowrap; z-index: 9999999; transition: left 0.4s cubic-bezier(0.23, 1, 0.32, 1), top 0.4s cubic-bezier(0.23, 1, 0.32, 1); background-color: rgba(0, 0, 0, 0.75); border-width: 0px; border-color: rgb(51, 51, 51); border-radius: 4px; color: rgb(255, 255, 255); font: 13px/20px Roboto, sans-serif; padding: 10px 15px; left: 946px; top: 125px;">
                                    Saturday<br><span
                                            style="display:inline-block;margin-right:5px;border-radius:10px;width:10px;height:10px;background-color:#2ec7c9;"></span>Profit:
                                    220<br><span
                                            style="display:inline-block;margin-right:5px;border-radius:10px;width:10px;height:10px;background-color:#5ab1ef;"></span>Income:
                                    450<br><span
                                            style="display:inline-block;margin-right:5px;border-radius:10px;width:10px;height:10px;background-color:#b6a2de;"></span>Expenses:
                                    -230
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /sales stats -->


                <!-- Blog post -->
                <div class="card">
                    <div class="card-header header-elements-sm-inline">
                        <h6 class="card-title">Himalayan sunset</h6>
                        <div class="header-elements">
                            <span><i class="icon-checkmark-circle mr-2 text-success"></i> 49 minutes ago</span>
                            <div class="list-icons ml-3">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-arrow-down12"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Hide user posts</a>
                                        <a href="#" class="dropdown-item"><i class="icon-user-block"></i> Block user</a>
                                        <a href="#" class="dropdown-item"><i class="icon-user-minus"></i> Unfollow user</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item"><i class="icon-embed"></i> Embed post</a>
                                        <a href="#" class="dropdown-item"><i class="icon-blocked"></i> Report this post</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="card-img-actions mb-3">
                            <img class="card-img img-fluid" src="../../../../global_assets/images/demo/cover3.jpg"
                                 alt="">
                            <div class="card-img-actions-overlay card-img">
                                <a href="blog_single.html"
                                   class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div>

                        <h6 class="mb-3">
                            <i class="icon-comment-discussion mr-2"></i>
                            <a href="#">Jason Ansley</a> commented:
                        </h6>

                        <blockquote class="blockquote blockquote-bordered py-2 pl-3 mb-0">
                            <p class="mb-2 font-size-base">When suspiciously goodness labrador understood rethought
                                yawned grew piously endearingly inarticulate oh goodness jeez trout distinct hence cobra
                                despite taped laughed the much audacious less inside tiger groaned darn stuffily
                                metaphoric unihibitedly inside cobra.</p>
                            <footer class="blockquote-footer">Jason, <cite title="Source Title">10:39 am</cite></footer>
                        </blockquote>
                    </div>

                    <div class="card-footer bg-transparent d-sm-flex justify-content-sm-between align-items-sm-center border-top-0 pt-0 pb-3">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="#" class="text-default"><i class="icon-eye4 mr-2"></i>
                                    438</a></li>
                            <li class="list-inline-item"><a href="#" class="text-default"><i
                                            class="icon-comment-discussion mr-2"></i> 71</a></li>
                        </ul>

                        <a href="#" class="d-inline-block text-default mt-2 mt-sm-0">Read post <i
                                    class="icon-arrow-right14 ml-2"></i></a>
                    </div>
                </div>
                <!-- /blog post -->


                <!-- Invoices -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card border-left-3 border-left-danger rounded-left-0">
                            <div class="card-body">
                                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                    <div>
                                        <h6 class="font-weight-semibold">Leonardo Fellini</h6>
                                        <ul class="list list-unstyled mb-0">
                                            <li>Invoice #: &nbsp;0028</li>
                                            <li>Issued on: <span class="font-weight-semibold">2015/01/25</span></li>
                                        </ul>
                                    </div>

                                    <div class="text-sm-right mb-0 mt-3 mt-sm-0 ml-auto">
                                        <h6 class="font-weight-semibold">$8,750</h6>
                                        <ul class="list list-unstyled mb-0">
                                            <li>Method: <span class="font-weight-semibold">SWIFT</span></li>
                                            <li class="dropdown">
                                                Status: &nbsp;
                                                <a href="#" class="badge bg-danger-400 align-top dropdown-toggle"
                                                   data-toggle="dropdown">Overdue</a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item active"><i class="icon-alert"></i>
                                                        Overdue</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-alarm"></i> Pending</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-checkmark3"></i>
                                                        Paid</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i
                                                                class="icon-spinner2 spinner"></i> On hold</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-cross2"></i>
                                                        Canceled</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
											<span>
												<span class="badge badge-mark border-danger mr-2"></span>
												Due:
												<span class="font-weight-semibold">2015/02/25</span>
											</span>

                                <ul class="list-inline list-inline-condensed mb-0 mt-2 mt-sm-0">
                                    <li class="list-inline-item">
                                        <a href="#" class="text-default"><i class="icon-eye8"></i></a>
                                    </li>
                                    <li class="list-inline-item dropdown">
                                        <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i
                                                    class="icon-menu7"></i></a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item"><i class="icon-printer"></i> Print invoice</a>
                                            <a href="#" class="dropdown-item"><i class="icon-file-download"></i>
                                                Download invoice</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item"><i class="icon-file-plus"></i> Edit
                                                invoice</a>
                                            <a href="#" class="dropdown-item"><i class="icon-cross2"></i> Remove invoice</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card border-left-3 border-left-success rounded-left-0">
                            <div class="card-body">
                                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                                    <div>
                                        <h6 class="font-weight-semibold">Rebecca Manes</h6>
                                        <ul class="list list-unstyled mb-0">
                                            <li>Invoice #: &nbsp;0027</li>
                                            <li>Issued on: <span class="font-weight-semibold">2015/02/24</span></li>
                                        </ul>
                                    </div>

                                    <div class="text-sm-right mb-0 mt-3 mt-sm-0 ml-auto">
                                        <h6 class="font-weight-semibold">$5,100</h6>
                                        <ul class="list list-unstyled mb-0">
                                            <li>Method: <span class="font-weight-semibold">Paypal</span></li>
                                            <li class="dropdown">
                                                Status: &nbsp;
                                                <a href="#" class="badge bg-success-400 align-top dropdown-toggle"
                                                   data-toggle="dropdown">Paid</a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-alert"></i> Overdue</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-alarm"></i> Pending</a>
                                                    <a href="#" class="dropdown-item active"><i
                                                                class="icon-checkmark3"></i> Paid</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i
                                                                class="icon-spinner2 spinner"></i> On hold</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-cross2"></i>
                                                        Canceled</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
											<span>
												<span class="badge badge-mark border-success mr-2"></span>
												Due:
												<span class="font-weight-semibold">2015/03/24</span>
											</span>

                                <ul class="list-inline list-inline-condensed mb-0 mt-2 mt-sm-0">
                                    <li class="list-inline-item">
                                        <a href="#" class="text-default"><i class="icon-eye8"></i></a>
                                    </li>
                                    <li class="list-inline-item dropdown">
                                        <a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i
                                                    class="icon-menu7"></i></a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item"><i class="icon-printer"></i> Print invoice</a>
                                            <a href="#" class="dropdown-item"><i class="icon-file-download"></i>
                                                Download invoice</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item"><i class="icon-file-plus"></i> Edit
                                                invoice</a>
                                            <a href="#" class="dropdown-item"><i class="icon-cross2"></i> Remove invoice</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /invoices -->


                <!-- Video post -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header header-elements-sm-inline">
                                <h6 class="card-title">Peru mountains</h6>
                                <div class="header-elements">
                                    <span><i class="icon-checkmark-circle mr-2 text-success"></i> Today, 8:39 am</span>
                                    <div class="list-icons ml-3">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item caret-0 dropdown-toggle"
                                               data-toggle="dropdown">
                                                <i class="icon-arrow-down12"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Hide
                                                    user posts</a>
                                                <a href="#" class="dropdown-item"><i class="icon-user-block"></i> Block
                                                    user</a>
                                                <a href="#" class="dropdown-item"><i class="icon-user-minus"></i>
                                                    Unfollow user</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-embed"></i> Embed post</a>
                                                <a href="#" class="dropdown-item"><i class="icon-blocked"></i> Report
                                                    this post</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <p class="mb-3">Cutting much goodness more from sympathetic unwittingly under wow
                                    affluent luckily or distinctly demonstrable strewed lewd outside coaxingly and after
                                    and rational alas this fitted. Hippopotamus noticeably oh bridled more until
                                    dutiful.</p>

                                <div class="card-img embed-responsive embed-responsive-16by9">
                                    <iframe allowfullscreen="" frameborder="0" mozallowfullscreen=""
                                            src="https://player.vimeo.com/video/126945693?title=0&amp;byline=0&amp;portrait=0"
                                            webkitallowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header header-elements-sm-inline">
                                <h6 class="card-title">Woodturner master</h6>
                                <div class="header-elements">
                                    <span><i class="icon-checkmark-circle mr-2 text-success"></i> Yesterday, 7:52 am</span>
                                    <div class="list-icons ml-3">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item caret-0 dropdown-toggle"
                                               data-toggle="dropdown">
                                                <i class="icon-arrow-down12"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Hide
                                                    user posts</a>
                                                <a href="#" class="dropdown-item"><i class="icon-user-block"></i> Block
                                                    user</a>
                                                <a href="#" class="dropdown-item"><i class="icon-user-minus"></i>
                                                    Unfollow user</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"><i class="icon-embed"></i> Embed post</a>
                                                <a href="#" class="dropdown-item"><i class="icon-blocked"></i> Report
                                                    this post</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <p class="mb-3">Bewitchingly amid heard by llama glanced fussily quetzal more that
                                    overcame eerie goodness badger woolly where since gosh accurate irrespective that
                                    pounded much winked urgent and furtive house gosh one while this more.</p>

                                <div class="card-img embed-responsive embed-responsive-16by9">
                                    <iframe allowfullscreen="" frameborder="0" mozallowfullscreen=""
                                            src="https://player.vimeo.com/video/126545288?title=0&amp;byline=0&amp;portrait=0"
                                            webkitallowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /video post -->

            </div>

            <div class="tab-pane fade active show" id="schedule">

                <!-- Available hours -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h6 class="card-title">Available hours</h6>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="available_hours"
                                 style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;"
                                 _echarts_instance_="ec_1534978326690">
                                <div style="position: relative; overflow: hidden; width: 635px; height: 400px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                                    <canvas data-zr-dom-id="zr_0" width="635" height="400"
                                            style="position: absolute; left: 0px; top: 0px; width: 635px; height: 400px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                                </div>
                                <div style="position: absolute; display: none; border-style: solid; white-space: nowrap; z-index: 9999999; transition: left 0.4s cubic-bezier(0.23, 1, 0.32, 1), top 0.4s cubic-bezier(0.23, 1, 0.32, 1); background-color: rgba(0, 0, 0, 0.75); border-width: 0px; border-color: rgb(51, 51, 51); border-radius: 4px; color: rgb(255, 255, 255); font: 13px/20px Roboto, sans-serif; padding: 10px 15px; left: 426px; top: 156px;">
                                    Sunday<br><span
                                            style="display:inline-block;margin-right:5px;border-radius:10px;width:10px;height:10px;background-color:#B0BEC5;"></span>Booked
                                    hours: 9<br><span
                                            style="display:inline-block;margin-right:5px;border-radius:10px;width:10px;height:10px;background-color:#29B6F6;"></span>Available
                                    hours: 1
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /available hours -->


                <!-- Schedule -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">My schedule</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="my-schedule fc fc-unthemed fc-ltr">
                            <div class="fc-toolbar fc-header-toolbar">
                                <div class="fc-left">
                                    <div class="fc-button-group">
                                        <button type="button"
                                                class="fc-prev-button fc-button fc-state-default fc-corner-left"
                                                aria-label="prev"><span
                                                    class="fc-icon fc-icon-left-single-arrow"></span></button>
                                        <button type="button"
                                                class="fc-next-button fc-button fc-state-default fc-corner-right"
                                                aria-label="next"><span
                                                    class="fc-icon fc-icon-right-single-arrow"></span></button>
                                    </div>
                                    <button type="button"
                                            class="fc-today-button fc-button fc-state-default fc-corner-left fc-corner-right">
                                        today
                                    </button>
                                </div>
                                <div class="fc-right">
                                    <div class="fc-button-group">
                                        <button type="button"
                                                class="fc-month-button fc-button fc-state-default fc-corner-left">month
                                        </button>
                                        <button type="button"
                                                class="fc-agendaWeek-button fc-button fc-state-default fc-state-active">
                                            week
                                        </button>
                                        <button type="button"
                                                class="fc-agendaDay-button fc-button fc-state-default fc-corner-right">
                                            day
                                        </button>
                                    </div>
                                </div>
                                <div class="fc-center"><h2>Nov 9 – 15, 2014</h2></div>
                                <div class="fc-clear"></div>
                            </div>
                            <div class="fc-view-container" style="">
                                <div class="fc-view fc-agendaWeek-view fc-agenda-view" style="">
                                    <table class="">
                                        <thead class="fc-head">
                                        <tr>
                                            <td class="fc-head-container fc-widget-header">
                                                <div class="fc-row fc-widget-header"
                                                     style="border-right-width: 1px; margin-right: 14px;">
                                                    <table class="">
                                                        <thead>
                                                        <tr>
                                                            <th class="fc-axis fc-widget-header"
                                                                style="width: 38px;"></th>
                                                            <th class="fc-day-header fc-widget-header fc-sun fc-past"
                                                                data-date="2014-11-09"><span>Sun 11/9</span></th>
                                                            <th class="fc-day-header fc-widget-header fc-mon fc-past"
                                                                data-date="2014-11-10"><span>Mon 11/10</span></th>
                                                            <th class="fc-day-header fc-widget-header fc-tue fc-past"
                                                                data-date="2014-11-11"><span>Tue 11/11</span></th>
                                                            <th class="fc-day-header fc-widget-header fc-wed fc-past"
                                                                data-date="2014-11-12"><span>Wed 11/12</span></th>
                                                            <th class="fc-day-header fc-widget-header fc-thu fc-past"
                                                                data-date="2014-11-13"><span>Thu 11/13</span></th>
                                                            <th class="fc-day-header fc-widget-header fc-fri fc-past"
                                                                data-date="2014-11-14"><span>Fri 11/14</span></th>
                                                            <th class="fc-day-header fc-widget-header fc-sat fc-past"
                                                                data-date="2014-11-15"><span>Sat 11/15</span></th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody class="fc-body">
                                        <tr>
                                            <td class="fc-widget-content">
                                                <div class="fc-day-grid fc-unselectable">
                                                    <div class="fc-row fc-week fc-widget-content"
                                                         style="border-right-width: 1px; margin-right: 14px;">
                                                        <div class="fc-bg">
                                                            <table class="">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="fc-axis fc-widget-content"
                                                                        style="width: 38px;"><span>all-day</span></td>
                                                                    <td class="fc-day fc-widget-content fc-sun fc-past"
                                                                        data-date="2014-11-09"></td>
                                                                    <td class="fc-day fc-widget-content fc-mon fc-past"
                                                                        data-date="2014-11-10"></td>
                                                                    <td class="fc-day fc-widget-content fc-tue fc-past"
                                                                        data-date="2014-11-11"></td>
                                                                    <td class="fc-day fc-widget-content fc-wed fc-past"
                                                                        data-date="2014-11-12"></td>
                                                                    <td class="fc-day fc-widget-content fc-thu fc-past"
                                                                        data-date="2014-11-13"></td>
                                                                    <td class="fc-day fc-widget-content fc-fri fc-past"
                                                                        data-date="2014-11-14"></td>
                                                                    <td class="fc-day fc-widget-content fc-sat fc-past"
                                                                        data-date="2014-11-15"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="fc-content-skeleton">
                                                            <table>
                                                                <tbody>
                                                                <tr>
                                                                    <td class="fc-axis" style="width: 38px;"></td>
                                                                    <td class="fc-event-container"><a
                                                                                class="fc-day-grid-event fc-h-event fc-event fc-not-start fc-end fc-draggable fc-resizable"
                                                                                style="background-color:#42A5F5;border-color:#42A5F5">
                                                                            <div class="fc-content"><span
                                                                                        class="fc-title">University</span>
                                                                            </div>
                                                                            <div class="fc-resizer fc-end-resizer"></div>
                                                                        </a></td>
                                                                    <td></td>
                                                                    <td class="fc-event-container" colspan="2"><a
                                                                                class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable fc-resizable"
                                                                                style="background-color:#26A69A;border-color:#26A69A">
                                                                            <div class="fc-content"><span
                                                                                        class="fc-title">Conference</span>
                                                                            </div>
                                                                            <div class="fc-resizer fc-end-resizer"></div>
                                                                        </a></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="fc-divider fc-widget-header">
                                                <div class="fc-scroller fc-time-grid-container"
                                                     style="overflow-x: hidden; overflow-y: scroll; height: 613px;">
                                                    <div class="fc-time-grid fc-unselectable">
                                                        <div class="fc-bg">
                                                            <table class="">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="fc-axis fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-day fc-widget-content fc-sun fc-past"
                                                                        data-date="2014-11-09"></td>
                                                                    <td class="fc-day fc-widget-content fc-mon fc-past"
                                                                        data-date="2014-11-10"></td>
                                                                    <td class="fc-day fc-widget-content fc-tue fc-past"
                                                                        data-date="2014-11-11"></td>
                                                                    <td class="fc-day fc-widget-content fc-wed fc-past"
                                                                        data-date="2014-11-12"></td>
                                                                    <td class="fc-day fc-widget-content fc-thu fc-past"
                                                                        data-date="2014-11-13"></td>
                                                                    <td class="fc-day fc-widget-content fc-fri fc-past"
                                                                        data-date="2014-11-14"></td>
                                                                    <td class="fc-day fc-widget-content fc-sat fc-past"
                                                                        data-date="2014-11-15"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="fc-slats">
                                                            <table class="">
                                                                <tbody>
                                                                <tr data-time="00:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>12am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="00:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="01:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>1am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="01:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="02:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>2am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="02:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="03:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>3am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="03:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="04:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>4am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="04:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="05:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>5am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="05:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="06:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>6am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="06:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="07:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>7am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="07:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="08:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>8am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="08:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="09:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>9am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="09:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="10:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>10am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="10:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="11:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>11am</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="11:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="12:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>12pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="12:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="13:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>1pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="13:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="14:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>2pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="14:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="15:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>3pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="15:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="16:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>4pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="16:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="17:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>5pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="17:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="18:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>6pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="18:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="19:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>7pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="19:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="20:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>8pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="20:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="21:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>9pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="21:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="22:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>10pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="22:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="23:00:00" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"><span>11pm</span></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                <tr data-time="23:30:00" class="fc-minor" style="">
                                                                    <td class="fc-axis fc-time fc-widget-content"
                                                                        style="width: 38px;"></td>
                                                                    <td class="fc-widget-content"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <hr class="fc-divider fc-widget-header" style="display: none;">
                                                        <div class="fc-content-skeleton">
                                                            <table>
                                                                <tbody>
                                                                <tr>
                                                                    <td class="fc-axis" style="width: 38px;"></td>
                                                                    <td>
                                                                        <div class="fc-content-col">
                                                                            <div class="fc-event-container fc-helper-container"></div>
                                                                            <div class="fc-event-container"><a
                                                                                        class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable fc-short"
                                                                                        style="background-color: rgb(141, 110, 99); border-color: rgb(141, 110, 99); top: 961px; bottom: -1109px; z-index: 1; left: 0%; right: 0%;">
                                                                                    <div class="fc-content">
                                                                                        <div class="fc-time"
                                                                                             data-start="1:00"
                                                                                             data-full="1:00 PM"><span>1:00</span>
                                                                                        </div>
                                                                                        <div class="fc-title">Shopping
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="fc-bg"></div>
                                                                                    <div class="fc-resizer fc-end-resizer"></div>
                                                                                </a></div>
                                                                            <div class="fc-highlight-container"></div>
                                                                            <div class="fc-bgevent-container"></div>
                                                                            <div class="fc-business-container"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="fc-content-col">
                                                                            <div class="fc-event-container fc-helper-container"></div>
                                                                            <div class="fc-event-container"></div>
                                                                            <div class="fc-highlight-container"></div>
                                                                            <div class="fc-bgevent-container"></div>
                                                                            <div class="fc-business-container"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="fc-content-col">
                                                                            <div class="fc-event-container fc-helper-container"></div>
                                                                            <div class="fc-event-container"><a
                                                                                        class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable fc-short"
                                                                                        style="background-color: rgb(120, 144, 156); border-color: rgb(120, 144, 156); top: 702px; bottom: -850px; z-index: 1; left: 0%; right: 0%;">
                                                                                    <div class="fc-content">
                                                                                        <div class="fc-time"
                                                                                             data-start="9:30"
                                                                                             data-full="9:30 AM"><span>9:30</span>
                                                                                        </div>
                                                                                        <div class="fc-title">Meeting
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="fc-bg"></div>
                                                                                    <div class="fc-resizer fc-end-resizer"></div>
                                                                                </a></div>
                                                                            <div class="fc-highlight-container"></div>
                                                                            <div class="fc-bgevent-container"></div>
                                                                            <div class="fc-business-container"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="fc-content-col">
                                                                            <div class="fc-event-container fc-helper-container"></div>
                                                                            <div class="fc-event-container"><a
                                                                                        class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable fc-short"
                                                                                        style="background-color: rgb(38, 166, 154); border-color: rgb(38, 166, 154); top: 1072px; bottom: -1220px; z-index: 1; left: 0%; right: 0%;">
                                                                                    <div class="fc-content">
                                                                                        <div class="fc-time"
                                                                                             data-start="2:30"
                                                                                             data-full="2:30 PM"><span>2:30</span>
                                                                                        </div>
                                                                                        <div class="fc-title">Happy
                                                                                            Hour
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="fc-bg"></div>
                                                                                    <div class="fc-resizer fc-end-resizer"></div>
                                                                                </a></div>
                                                                            <div class="fc-highlight-container"></div>
                                                                            <div class="fc-bgevent-container"></div>
                                                                            <div class="fc-business-container"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="fc-content-col">
                                                                            <div class="fc-event-container fc-helper-container"></div>
                                                                            <div class="fc-event-container"><a
                                                                                        class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable fc-short"
                                                                                        style="background-color: rgb(76, 175, 80); border-color: rgb(76, 175, 80); top: 221px; bottom: -369px; z-index: 1; left: 0%; right: 0%;">
                                                                                    <div class="fc-content">
                                                                                        <div class="fc-time"
                                                                                             data-start="3:00"
                                                                                             data-full="3:00 AM"><span>3:00</span>
                                                                                        </div>
                                                                                        <div class="fc-title">Birthday
                                                                                            Party
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="fc-bg"></div>
                                                                                    <div class="fc-resizer fc-end-resizer"></div>
                                                                                </a><a class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable fc-short"
                                                                                       style="background-color: rgb(255, 112, 67); border-color: rgb(255, 112, 67); top: 1405px; bottom: -1553px; z-index: 1; left: 0%; right: 0%;">
                                                                                    <div class="fc-content">
                                                                                        <div class="fc-time"
                                                                                             data-start="7:00"
                                                                                             data-full="7:00 PM"><span>7:00</span>
                                                                                        </div>
                                                                                        <div class="fc-title">Dinner
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="fc-bg"></div>
                                                                                    <div class="fc-resizer fc-end-resizer"></div>
                                                                                </a></div>
                                                                            <div class="fc-highlight-container"></div>
                                                                            <div class="fc-bgevent-container"></div>
                                                                            <div class="fc-business-container"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="fc-content-col">
                                                                            <div class="fc-event-container fc-helper-container"></div>
                                                                            <div class="fc-event-container"><a
                                                                                        class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable fc-short"
                                                                                        style="background-color: rgb(121, 134, 203); border-color: rgb(121, 134, 203); top: 628px; bottom: -924px; z-index: 1; left: 0%; right: 0%;">
                                                                                    <div class="fc-content">
                                                                                        <div class="fc-time"
                                                                                             data-start="8:30"
                                                                                             data-full="8:30 AM - 12:30 PM">
                                                                                            <span>8:30 - 12:30</span>
                                                                                        </div>
                                                                                        <div class="fc-title">Meeting
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="fc-bg"></div>
                                                                                    <div class="fc-resizer fc-end-resizer"></div>
                                                                                </a></div>
                                                                            <div class="fc-highlight-container"></div>
                                                                            <div class="fc-bgevent-container"></div>
                                                                            <div class="fc-business-container"></div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="fc-content-col">
                                                                            <div class="fc-event-container fc-helper-container"></div>
                                                                            <div class="fc-event-container"><a
                                                                                        class="fc-time-grid-event fc-v-event fc-event fc-start fc-end fc-draggable fc-resizable fc-short"
                                                                                        style="background-color: rgb(0, 188, 212); border-color: rgb(0, 188, 212); top: 1183px; bottom: -1331px; z-index: 1; left: 0%; right: 0%;">
                                                                                    <div class="fc-content">
                                                                                        <div class="fc-time"
                                                                                             data-start="4:00"
                                                                                             data-full="4:00 PM"><span>4:00</span>
                                                                                        </div>
                                                                                        <div class="fc-title">Shopping
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="fc-bg"></div>
                                                                                    <div class="fc-resizer fc-end-resizer"></div>
                                                                                </a></div>
                                                                            <div class="fc-highlight-container"></div>
                                                                            <div class="fc-bgevent-container"></div>
                                                                            <div class="fc-business-container"></div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /schedule -->

            </div>

            <div class="tab-pane fade" id="settings">

                <!-- Profile info -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Profile information</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Username</label>
                                        <input type="text" value="Eugene" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Full name</label>
                                        <input type="text" value="Kopyov" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Address line 1</label>
                                        <input type="text" value="Ring street 12" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Address line 2</label>
                                        <input type="text" value="building D, flat #67" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>City</label>
                                        <input type="text" value="Munich" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label>State/Province</label>
                                        <input type="text" value="Bayern" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label>ZIP code</label>
                                        <input type="text" value="1031" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="text" readonly="readonly" value="eugene@kopyov.com"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Your country</label>
                                        <select class="form-control form-control-select2 select2-hidden-accessible"
                                                data-fouc="" tabindex="-1" aria-hidden="true">
                                            <option value="germany" selected="">Germany</option>
                                            <option value="france">France</option>
                                            <option value="spain">Spain</option>
                                            <option value="netherlands">Netherlands</option>
                                            <option value="other">...</option>
                                            <option value="uk">United Kingdom</option>
                                        </select><span class="select2 select2-container select2-container--default"
                                                       dir="ltr" style="width: 100%;"><span class="selection"><span
                                                        class="select2-selection select2-selection--single"
                                                        role="combobox" aria-haspopup="true" aria-expanded="false"
                                                        tabindex="0" aria-labelledby="select2-25da-container"><span
                                                            class="select2-selection__rendered"
                                                            id="select2-25da-container"
                                                            title="Germany">Germany</span><span
                                                            class="select2-selection__arrow" role="presentation"><b
                                                                role="presentation"></b></span></span></span><span
                                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone #</label>
                                        <input type="text" value="+99-99-9999-9999" class="form-control">
                                        <span class="form-text text-muted">+99-99-9999-9999</span>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Upload profile image</label>
                                        <div class="uniform-uploader"><input type="file" class="form-input-styled"
                                                                             data-fouc=""><span class="filename"
                                                                                                style="user-select: none;">No file selected</span><span
                                                    class="action btn bg-warning"
                                                    style="user-select: none;">Choose File</span></div>
                                        <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /profile info -->


                <!-- Account settings -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Account settings</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="#">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Username</label>
                                        <input type="text" value="Kopyov" readonly="readonly" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Current password</label>
                                        <input type="password" value="password" readonly="readonly"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>New password</label>
                                        <input type="password" placeholder="Enter new password" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Repeat password</label>
                                        <input type="password" placeholder="Repeat new password" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Profile visibility</label>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-choice"><span class="checked"><input type="radio"
                                                                                                         name="visibility"
                                                                                                         class="form-input-styled"
                                                                                                         checked=""
                                                                                                         data-fouc=""></span>
                                                </div>
                                                Visible to everyone
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-choice"><span><input type="radio" name="visibility"
                                                                                         class="form-input-styled"
                                                                                         data-fouc=""></span></div>
                                                Visible to friends only
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-choice"><span><input type="radio" name="visibility"
                                                                                         class="form-input-styled"
                                                                                         data-fouc=""></span></div>
                                                Visible to my connections only
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-choice"><span><input type="radio" name="visibility"
                                                                                         class="form-input-styled"
                                                                                         data-fouc=""></span></div>
                                                Visible to my colleagues only
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Notifications</label>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-checker"><span class="checked"><input
                                                                type="checkbox" class="form-input-styled" checked=""
                                                                data-fouc=""></span></div>
                                                Password expiration notification
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-checker"><span class="checked"><input
                                                                type="checkbox" class="form-input-styled" checked=""
                                                                data-fouc=""></span></div>
                                                New message notification
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-checker"><span class="checked"><input
                                                                type="checkbox" class="form-input-styled" checked=""
                                                                data-fouc=""></span></div>
                                                New task notification
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <div class="uniform-checker"><span><input type="checkbox"
                                                                                          class="form-input-styled"></span>
                                                </div>
                                                New contact request notification
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /account settings -->

            </div>
        </div>
        <!-- /left content -->

    </div>
    <!-- /inner container -->

</div>
<!-- /content area -->






