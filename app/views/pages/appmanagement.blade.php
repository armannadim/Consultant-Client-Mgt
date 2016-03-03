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
<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-6 col-md-6 col-sm-12 content-body">
                <div class="showback">

                    <table id="config-table" class="table table-condensed">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Param</th>
                            <th>Value</th>
                            <th>Operations</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 content-body">
                <div class="showback">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Add config parameter</h4>
                    {{ Form::open(array('route' => 'addConfig', 'role' =>'form', 'method'=>'POST', 'class' => 'form-horizontal', 'id'=>'config_form')) }}

                    <div class="form-group">
                        {{Form::label('param', 'Param', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">
                            {{Form::text('param', null, array('class'=>'form-control'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('value', 'Value', array('class' => 'col-sm-2 col-sm-2 control-label'))}}
                        <div class="col-sm-5">
                            {{Form::text('value', null, array('class'=>'form-control'))}}
                        </div>
                    </div>
                    {{Form::submit('Send');}}
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </section>
</section>
<!--main content end-->
<!--Footer content used in base.blade.php -->

@stop
