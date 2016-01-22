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
@if(Route::currentRouteName()=="client")

<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12 content-body">
                <table id="client-table" class="table table-condensed">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Full Name</th>
                            <th>Doc type</th>
                            <th>identity</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Email</th>                            
                            <th>Country</th>
                            <th>Attended By</th>
                            <th>Client since</th>            
                            <th>Last visited</th>            
                            <th>Current status</th>                  
                            <th>Operations</th>         
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</section>

@elseif(Route::currentRouteName()=="addclient")

<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-users"></i> Add Client</h3>

        <!-- INLINE FORM ELELEMNTS -->
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <!--<h4 class="mb"><i class="fa fa-angle-right"></i> Inline Form</h4>-->
                    {{ Form::open(array('route' => 'addClient', 'role' =>'form', 'method'=>'POST', 'class' => 'form-horizontal', 'id'=>'client_reg_form')) }}
                    {{Form::hidden('addedby_user_id', Auth::id())}}

                    <div class="form-group">                        
                        {{Form::label('name', 'Name', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">
                            {{Form::text('name', null, array('class'=>'form-control'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('full_name', 'Full name', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">
                            {{Form::text('full_name', null, array('class'=>'form-control'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('document', 'Document', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">
                            <div class="col-sm-6" style="padding-left: 0!important;">
                                <label class="sr-only" for="exampleInputEmail2">Document Type</label>                            
                                {{Form::select('doc_type', array('-' => 'Select Document Type', '1' => 'DNI', '2'=>'NIE', '3'=>'Pasaporte'), null, array('class'=>'form-control'))}}
                            </div>
                            <div class="col-sm-6" style="padding-right: 0!important;">
                                {{Form::text('identity', null, array('class'=>'form-control', 'placeholder'=>'Document number'))}}                                                   
                            </div>
                        </div>
                    </div>
                    <div class="form-group">                        
                        {{Form::label('address', 'Address', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">
                            {{ Form::textarea('address', null, array('class'=>'form-control', 'rows'=>'3')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('country', 'Nationality', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">
                            {{Form::text('country', null, array('class'=>'form-control'))}}
                        </div>
                    </div>   
                    <div class="form-group">
                        {{Form::label('contact_number', 'Phone', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-3">
                            {{Form::text('contact_number', null, array('class'=>'form-control'))}}                            
                        </div>
                        <label id="contact_hint" style="color: green;">ex. 0034620019615</label>
                        <label id="err_contact" style="color: red;"></label>
                    </div>
                    <div class="form-group">
                        {{Form::label('email', 'Email', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">
                            {{Form::email('email', null, array('class'=>'form-control'))}}                            
                        </div>
                    </div>               
                    {{Form::submit('Send');}}
                    {{ Form::close() }}
                </div><!-- /form-panel -->
            </div><!-- /col-lg-12 -->
        </div><!-- /row -->
    </section>
</section>
@elseif(Route::currentRouteName()=="show-client")
<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-users"></i> Visits of the client</h3>

        <!-- INLINE FORM ELELEMNTS -->
        <div class="row mt">
            <div class="col-lg-12 content-body">
                <table id="visit-table" class="table table-condensed">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>User</th>
                            <th>User Full Name</th>
                            <th>Client</th>
                            <th>Client full name</th>
                            <th>visits</th>
                            <th>Problems</th>
                            <th>Comments</th>            
                            <th>Operations</th>           
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</section>
@endif
<!--main content end-->
<!--Footer content used in base.blade.php -->

@stop
