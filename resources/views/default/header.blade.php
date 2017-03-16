<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="" alt="">{{ Auth::user()->name }}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        {{--<li><a href="javascript:;"> Profile</a></li>--}}
                        {{--<li>--}}
                        {{--<a href="javascript:;">--}}
                        {{--<span class="badge bg-red pull-right">50%</span>--}}
                        {{--<span>Settings</span>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li><a href="javascript:;">Help</a></li>--}}

                        <li>
                            <a  href="#">
                                <i class="fa fa-sign-out pull-right"></i>
                                Logout
                            </a>


                        </li>


                    </ul>
                </li>
                <notification :id="{{ Auth::User()->id }}"></notification>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->