<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered"><a href="profile.html"><img src="{{ asset('img/user/'.Auth::id().'.jpg') }}" class="img-circle" width="60"></a></p>
            <h5 class="centered">{{ Auth::user()->name }}</h5>
 {{--*/ $cur_path = Route::getCurrentRoute()->getPath() /*--}}
            <li class="mt">
                <a class="{{ $cur_path=='dashboard'?'active':'' }}" href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="{{ $cur_path=='visit' || $cur_path=='addappointment' ?'active':'' }}" >
                    <i class="fa fa-calendar"></i>
                    <span>Calendar</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{route('visit')}}" class="{{ $cur_path=='visit'?'active':'' }}">Appointments</a></li>
                    <li><a  href="{{route('addappointment')}}" class="{{ $cur_path=='addappointment'?'active':'' }}">Add appointment</a></li>                    
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="{{ $cur_path=='client' || $cur_path=='addclient' ?'active':'' }}">
                    <i class="fa fa-user"></i>
                    <span>Client</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{route('client')}}" class="{{ $cur_path=='client'?'active':'' }}">Clients</a></li>                    
                    <li><a  href="{{route('addclient')}}" class="{{ $cur_path=='addclient' ?'active':'' }}">Add client</a></li>
                </ul>
            </li>
            @if(Auth::user()->role==1)            
            <li class="sub-menu">
                <a href="javascript:;" class="{{ $cur_path=='staff' || $cur_path=='addstaff' ?'active':'' }}" >
                    <i class="fa fa-user-md"></i>
                    <span>Staff</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{route('staff')}}" class="{{ $cur_path=='staff'?'active':'' }}">Staffs</a></li>
                    <li><a  href="{{route('addstaff')}}" class="{{ $cur_path=='addstaff' ?'active':'' }}">Add staff</a></li>                    
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="{{ $cur_path=='userconfig' || $cur_path=='appconfig' ?'active':'' }}" >
                    <i class="fa fa-tasks"></i>
                    <span>Settings</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{route('userconfig')}}" class="{{ $cur_path=='userconfig' ?'active':'' }}">User Config</a></li>
                    <li><a  href="{{route('appconfig')}}" class="{{ $cur_path=='appconfig' ?'active':'' }}">Application Config</a></li>
                </ul>
            </li>
            @endif   
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->