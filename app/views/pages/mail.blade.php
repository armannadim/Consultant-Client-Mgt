@extends('layout.base')

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
@section('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row mt">
            <div class="col-sm-3">
                <section class="panel">
                    <div class="panel-body">
                        <a href="#"  class="btn btn-compose">
                            <i class="fa fa-pencil"></i>  Compose Mail
                        </a>
                        <ul class="nav nav-pills nav-stacked mail-nav">
                            <li class="active"><a class="inbox" href="#"> <i class="fa fa-inbox"></i> Inbox  <span class="label label-theme pull-right inbox-notification">{{ count(BaseController::getUnreadMsg(Auth::id())) }}</span></a></li>
                            <li><a class="outbox" href="#"> <i class="fa fa-envelope-o"></i> Send Mail</a></li>
                        </ul>
                    </div>
                </section>

                <!--<section class="panel">
                    <a href="../../../../../../Users/naseq/Downloads/ImportFromExcel/connection.php"></a>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked labels-info ">
                            <li> <h4>Friends Online</h4> </li>
                            <li> <a href="#"> <img src="assets/img/friends/fr-10.jpg" class="img-circle" width="20">Laura <p><span class="label label-success">Available</span></p></a></li>
                            <li> <a href="#"> <img src="assets/img/friends/fr-05.jpg" class="img-circle" width="20">David <p><span class="label label-danger"> Busy</span></p></a></li>
                            <li> <a href="#"> <img src="assets/img/friends/fr-01.jpg" class="img-circle" width="20">Mark <p>Offline</p></a></li>
                            <li> <a href="#"> <img src="assets/img/friends/fr-03.jpg" class="img-circle" width="20">Phillip <p>Offline</p></a></li>
                            <li> <a href="#"> <img src="assets/img/friends/fr-02.jpg" class="img-circle" width="20">Joshua <p>Offline</p></a></li>
                        </ul>
                        <a href="#"> + Add More</a>

                        <div class="inbox-body text-center inbox-action">
                            <div class="btn-group">
                                <a class="btn mini btn-default" href="javascript:;">
                                    <i class="fa fa-power-off"></i>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a class="btn mini btn-default" href="javascript:;">
                                    <i class="fa fa-cog"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>-->
            </div>
            <div class="col-sm-9">
                <section class="panel inbox mail-main">
                    <header class="panel-heading wht-bg">
                        <h4 class="gen-case">Inbox (3)
                            <form action="#" class="pull-right mail-src-position">
                                <div class="input-append">
                                    <input type="text" class="form-control " placeholder="Search Mail">
                                </div>
                            </form>
                        </h4>
                    </header>
                    <div class="panel-body minimal">
                        <div class="mail-option">
                            <div class="chk-all col-md-2">
                                <div class="pull-left mail-checkbox">
                                    <input type="checkbox" class="">
                                </div>

                                <div class="btn-group">
                                    <a data-toggle="dropdown" href="#" class="btn mini all">
                                        All
                                        <i class="fa fa-angle-down "></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"> None</a></li>
                                        <li><a href="#"> Read</a></li>
                                        <li><a href="#"> Unread</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="btn-group col-md-1">
                                <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                                    <i class=" fa fa-refresh"></i>
                                </a>
                            </div>
                            <!--<div class="btn-group hidden-phone">
                                <a data-toggle="dropdown" href="#" class="btn mini blue">
                                    More
                                    <i class="fa fa-angle-down "></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                    <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                </ul>
                            </div>-->
                            <div class="btn-group col-md-6">
                                <a data-toggle="dropdown" href="#" class="btn mini blue">
                                    Move to
                                    <i class="fa fa-angle-down "></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-folder-open"></i> Mark as Read</a></li>
                                    <li><a href="#"><i class="fa fa-folder"></i> Mark as Unread</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                </ul>
                            </div>

                            <!--<ul class="list-unstyled inbox-pagination col-md-3">
                                <li><span>1-50 of 99</span></li>
                                <li>
                                    <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                </li>
                                <li>
                                    <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                </li>
                            </ul>-->
                        </div>
                        <div class="table-inbox-wrap ">
                            <table class="table table-inbox table-hover">
                                <tbody>
                                    @foreach($mails as $mail)
                                    <tr class="{{ $mail->read_status == 0?'unread':'' }}">
                                        <td class="inbox-small-cells">
                                            <input type="checkbox" class="mail-checkbox">
                                        </td>
                                        <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                        <td class="view-message  dont-show"><a href="#">{{ User::find($mail->sender)['name'] }}</a></td>
                                        <td class="view-message "><a class="messages" href="#" class="button">{{ $mail->message }}</a></td>
                                        <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                        <td class="view-message  text-right">{{ BaseController::getTimeDiff($mail->created_at) }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <section class="panel outbox mail-main">
                    <header class="panel-heading wht-bg">
                        <h4 class="gen-case">Send Mail (3)
                            <form action="#" class="pull-right mail-src-position">
                                <div class="input-append">
                                    <input type="text" class="form-control " placeholder="Search Mail">
                                </div>
                            </form>
                        </h4>
                    </header>
                    <div class="panel-body minimal">
                        <div class="mail-option">
                            <div class="chk-all">
                                <div class="pull-left mail-checkbox">
                                    <input type="checkbox" class="">
                                </div>

                                <div class="btn-group">
                                    <a data-toggle="dropdown" href="#" class="btn mini all">
                                        All
                                        <i class="fa fa-angle-down "></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"> None</a></li>
                                        <li><a href="#"> Read</a></li>
                                        <li><a href="#"> Unread</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="btn-group">
                                <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                                    <i class=" fa fa-refresh"></i>
                                </a>
                            </div>
                            <!--<div class="btn-group hidden-phone">
                                <a data-toggle="dropdown" href="#" class="btn mini blue">
                                    More
                                    <i class="fa fa-angle-down "></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                    <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                </ul>
                            </div>-->
                            <div class="btn-group">
                                <a data-toggle="dropdown" href="#" class="btn mini blue">
                                    Move to
                                    <i class="fa fa-angle-down "></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                    <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                </ul>
                            </div>

                            <ul class="unstyled inbox-pagination">
                                <li><span>1-50 of 99</span></li>
                                <li>
                                    <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                </li>
                                <li>
                                    <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="table-inbox-wrap ">
                            <table class="table table-inbox table-hover">
                                <tbody>
                                    @foreach($mailSend as $mail)
                                    <tr class="{{ $mail->read_status == 0?'unread':'' }}">
                                        <td class="inbox-small-cells">
                                            <input type="checkbox" class="mail-checkbox">
                                        </td>
                                        <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                        <td class="view-message  dont-show"><a href="mail_view.html">{{ User::find($mail->sender)['name'] }}</a></td>
                                        <td class="view-message "><a href="mail_view.html">{{ $mail->message }}</a></td>
                                        <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                        <td class="view-message  text-right">{{ BaseController::getTimeDiff($mail->created_at) }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- COMPOSE MAIL -->
                <section class="panel compose-mail">
                    <header class="panel-heading wht-bg">
                        <h4 class="gen-case"> Compose Mail
                            <form action="#" class="pull-right mail-src-position">
                                <div class="input-append">
                                    <input type="text" class="form-control " placeholder="Search Mail">
                                </div>
                            </form>
                        </h4>
                    </header>
                    <div class="panel-body">
                        <div class="compose-mail">
                            <form role="form-horizontal" method="post" action="{{ route('send-mail') }}">
                                <div class="form-group">
                                    <label for="to" class="">To:</label>
                                    <select name="receiver" class="form-control" tabindex="1" id="to">
                                         {{--*/ $users = BaseController::getCount_User() /*--}}
                                         @foreach($users as $user)
                                         @if($user['id'] !== Auth::id())
                                         <option value="{{ $user['id'] }}">{{$user['name'] }}</option>
                                         @endif
                                         @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="to" class="">Message for all? :</label>
                                    <input type="radio" name="viewable_to" value="all"> Yes
                                    <input type="radio" name="viewable_to" value=""> No
                                </div>
                                <div class="compose-editor">
                                    <textarea name="message" class="wysihtml5 form-control" rows="9"></textarea>
                                </div>
                                <div class="compose-btn">
                                    <button class="btn btn-theme btn-sm" type='submit'><i class="fa fa-check"></i> Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>


            </div>
        </div>




    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js'></script>


@stop
