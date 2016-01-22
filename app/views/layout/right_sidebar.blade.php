<div class="col-lg-3 ds">
    <!--COMPLETED ACTIONS DONUTS CHART-->
    <h3>TODAYS VISIT (All users)</h3>
    {{--*/ $visits = BaseController::getCount_visitOfTheDay() /*--}}
    <!-- First Action -->
    @foreach($visits as $visit)
    <div class="desc">
        <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
        </div>
        <div class="details">
            <p><muted>{{ BaseController::getTimeDiff($visit->visit_date_time) }}</muted><br/>
            <a href="#">{{ User::find($visit->staff_user_id)['name'] }}<br/>
                </p>
        </div>
    </div>
    @endforeach

    <!-- USERS ONLINE SECTION -->
    <h3>TEAM MEMBERS</h3>
    <!-- First Member -->
    {{--*/ $users = User::all(); /*--}}
    @foreach($users as $user)
    <div class="desc">
        <div class="thumb">
            <img class="img-circle" src="{{ asset('img/user/'.$user->id.'.jpg') }}" width="35px" height="35px" align="">
        </div>
        <div class="details">
            <p><a href="#">{{ $user->full_name . '(' . $user->name . ')' }}</a><br/>
            <muted>Available</muted>
            </p>
        </div>
    </div>
    @endforeach
    

    <!-- CALENDAR-->
    <div id="calendar" class="mb">
        <div class="panel green-panel no-margin">
            <div class="panel-body">
                <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                    <div class="arrow"></div>
                    <h3 class="popover-title" style="disadding: none;"></h3>
                    <div id="date-popover-content" class="popover-content"></div>
                </div>
                <div id="my-calendar"></div>
            </div>
        </div>
    </div><!-- / calendar -->

</div><!-- /col-lg-3 -->