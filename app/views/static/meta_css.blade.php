

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Dashboard">
<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

<title>A3N - Client Management System</title>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">


{{-- Bootstrap core CSS --}}
{{ HTML::style('css/bootstrap.css'); }}
<!--external css-->
{{ HTML::style('css/font-awesome.css'); }}

@if (Route::getCurrentRoute()->getPath() === 'visit')
{{ HTML::style('js/fullcalendar/bootstrap-fullcalendar.css'); }}
@endif


{{ HTML::style('css/zabuto_calendar.css'); }}
{{ HTML::style('js/gritter/css/jquery.gritter.css'); }}
{{ HTML::style('css/lineicons-style.css'); }}
<!-- Custom styles for this template -->
{{ HTML::style('css/style.css'); }}
{{ HTML::style('css/style-responsive.css'); }}

{{ HTML::style('css/selectize.css'); }}
{{ HTML::style('css/selectize.bootstrap3.css'); }}
{{ HTML::style('css/to-do.css'); }}
{{ HTML::style('css/custom.css'); }}

{{ HTML::script('js/chart-master/Chart.js'); }}

{{ HTML::style('//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css'); }}


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    {{ HTML::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'); }}
    {{ HTML::script('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'); }}      
<![endif]-->

