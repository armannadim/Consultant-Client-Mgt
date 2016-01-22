@extends('layout.base')


<!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
<!--header content included in base.blade.php-->

<!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
<!--Main sidebar menu included in base.blade.php-->


@section('content')
<!--main content start-->
@if(Route::currentRouteName()=="visit")

<section id="main-content">
    <section class="wrapper">   
        <div class="row mt">    
            <aside class="col-lg-12 mt">
                <section class="panel">
                    <div class="panel-body">
                        <div id="calendar" class="has-toolbar"></div>
                    </div>
                </section>
            </aside>
        </div>
    </section>
</section>
@elseif(Route::currentRouteName()=="addappointment")

<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-users"></i> New Appointment</h3>

        <!-- INLINE FORM ELELEMNTS -->
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <!--<h4 class="mb"><i class="fa fa-angle-right"></i> Inline Form</h4>-->
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Schedule an appointment</h4>
                    {{ Form::open(array('route' => 'addVisit', 'method'=>'post', 'role' =>'form', 'class' => 'form-horizontal', 'id'=>'appointment_reg_form')) }}
                    {{Form::hidden('staff_user_id', '1')}}
                    <div class="form-group">
                        {{Form::label('Client', 'Client', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">
                            {{Form::select('client', $clients, null,
                                        array('class'=>'client_dd', 'data-live-search'=>'true'))}}
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('problem', 'Problem', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">
                            {{Form::select('problem', $problems, null,
                                        array('class'=>'problem_dd', 'data-live-search'=>'true'))}}
                        </div>
                    </div>
                    <div class="form-group">                        
                        {{Form::label('comments', 'Comments', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">

                            {{ Form::textarea('comments', null, array('class'=>'form-control', 'rows'=>'5')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('visit_date_time', 'Date time', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">
                            <div class='input-group date' id='datetimepicker1'>
                                {{Form::text('visit_date_time', null, array('class'=>'form-control visit_date_time', 'id'=>'visit_date_time'))}}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="visit_list">

                    </div>

                    {{Form::submit('Send');}}
                    {{ Form::close() }}
                </div><!-- /form-panel -->
            </div><!-- /col-lg-12 -->
        </div><!-- /row -->
    </section>
</section>

@endif
<!--main content end-->
<!--Footer content used in base.blade.php -->

@stop
