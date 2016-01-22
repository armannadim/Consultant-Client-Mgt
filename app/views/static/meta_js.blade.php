<!-- js placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js'); }}
{{ HTML::script('js/jquery-1.8.3.min.js'); }}
{{ HTML::script('js/jquery.dataTables.min.js'); }}
{{ HTML::script('js/jquery.jeditable.js'); }}
{{ HTML::script('js/jquery-ui.js'); }}

{{ HTML::script('js/jquery.validate.js'); }}
{{ HTML::script('js/jquery.dataTables.editable.js'); }}
<!--{{ HTML::script('js/jquery.dataTables.yadcf.js'); }}-->

{{ HTML::script('js/bootstrap.min.js'); }}
<!--{{-- HTML::script('js/query.dcjqaccordion.2.7.js'); --}}-->

{{ HTML::script('js/jquery.dcjqaccordion.2.7.js'); }}
{{ HTML::script('js/jquery.scrollTo.min.js'); }}
{{ HTML::script('js/jquery.nicescroll.js'); }}
{{ HTML::script('js/jquery.sparkline.js'); }}

@if (Route::getCurrentRoute()->getPath() === 'visit')
{{ HTML::script('js/fullcalendar/fullcalendar.min.js'); }}
{{ HTML::script('js/calendar-conf-events.js'); }}
@endif

<!--common script for all pages-->
{{ HTML::script('js/common-scripts.js'); }}

{{ HTML::script('js/gritter/js/jquery.gritter.js'); }}
{{ HTML::script('js/gritter-conf.js'); }}


<!--script for this page-->
{{ HTML::script('js/sparkline-chart.js'); }}
{{ HTML::script('js/zabuto_calendar.js'); }}


{{ HTML::script('js/MooTools-Core-1.5.1.js'); }}
{{ HTML::script('js/selectize.js'); }}
{{ HTML::script('js/moment.js'); }}
{{ HTML::script('js/bootstrap-datetimepicker.js'); }}
{{ HTML::script('//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js'); }}
{{ HTML::script('js/app.js'); }}
{{ HTML::script('js/jquery.expander.js'); }}
<style type="text/css">
    .leftAlign{text-align: left;}
    .centerAlign{text-align: center;}
    .rightAlign{text-align: right;}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        /*var unique_id = $.gritter.add({
         // (string | mandatory) the heading of the notification
         title: 'Welcome to Dashgum!',
         // (string | mandatory) the text inside the notification
         text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Free version for <a href="http://blacktie.co" target="_blank" style="color:#ffd777">BlackTie.co</a>.',
         // (string | optional) the image to display on the left
         image: "{{ asset('img/ui-sam.jpg') }}",
         // (bool | optional) if you want it to fade out on its own or just sit there
         sticky: true,
         // (int | optional) the time you want it to be alive for before fading out
         time: '',
         // (string | optional) the class name you want to apply to that specific message
         class_name: 'my-sticky-class'
         });
         return false;*/
    });
    $(document).ready(function() {
        $("#date-popover").popover({html: true, trigger: "manual"});
        $("#date-popover").hide();
        $("#date-popover").click(function(e) {
            $(this).hide();
        });
        $("#my-calendar").zabuto_calendar({
            action: function() {
                return myDateFunction(this.id, false);
            },
            action_nav: function() {
                return myNavFunction(this.id);
            },
            ajax: {
                url: "show_data.php?action=1",
                modal: true
            },
            legend: [
                {type: "text", label: "Special event", badge: "00"},
                {type: "block", label: "Regular event", }
            ]
        });
        /* DATA TABLE */

        var oTableVisit = $('#visit-table').dataTable({
            bProcessing: true,
            bServerSide: true,
            sAjaxSource: '{{ url("visits"."/".Request::segment(2)) }}',
            sPaginationType: "full_numbers",
            aoColumns: [
                {sData: '0', sName: 'id'},
                {sData: '1', sName: 'User'},
                {sData: '2', sName: 'User Full Name'},
                {sData: '3', sName: 'Client'},
                {sData: '4', sName: 'Client full name'},
                {sData: '5', sName: 'visits', sClass: "input-group date", sId: "datetimepicker",
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).attr('id', 'datetimepicker1');
                    }
                },
                {sData: '6', sName: 'Problem'},
                {sData: '7', sName: 'Comments',
                    render: function(sData, type, full, meta) {
                        if (sData !== null) {
                            return type === 'display' && sData.length > 40 ?
                                    '<span title="' + sData + '">' + sData.substr(0, 38) + '...</span>' :
                                    sData;
                        }
                        return "";
                    }
                },
                {sData: '8', sName: 'Actions', sClass: "centerAlign"},
            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                $(nRow).attr("id", aData["id"]);
                var CurrentDate = new Date();
                var visit = new Date(aData[5].replace(/-/g, '/'));
                if (CurrentDate > visit)
                {
                    $(nRow).addClass(" pastVisit");
                }
                return nRow;
            }
        }).makeEditable({
            sUpdateURL: function(value, settings)
            {
                var columnId = oTableVisit.fnGetPosition(this)[2];
                var sColumnTitle = oTableVisit.fnSettings().aoColumns[columnId].sName;
                var rowId = $(this).closest('tr[id]').attr('id');
                $.ajax({
                    type: "POST",
                    url: '../modifyVisit/' + rowId,
                    data: "column=" + sColumnTitle + "&id=" + rowId + "&value=" + value,
                    success: function() {
                        oTableVisit.fnDraw();
                    }
                })
                return value;
            },
            "aoColumns": [
                null,
                null,
                null,
                null,
                null,
                {/*tooltip: 'Click to change date and time',
                 loadtext: 'loading...',
                 type: 'datetimepicker',
                 datetimepicker: {
                 format: 'Y-m-d H:i:00',
                 changeMonth: true,
                 changeYear: true,
                 showHour: true,
                 showMinute: true,
                 step: 15
                 }*/
                },
                {},
                {},
                null
            ]
        });
        var oTable = $('#user-table').dataTable({
            bProcessing: true,
            bServerSide: true,
            sAjaxSource: 'users',
            bScrollInfinite: true,
            aoColumns: [
                {mData: '0', sName: 'id'},
                {mData: '3', sName: 'username'},
                {mData: '1', sName: 'name'},
                {mData: '2', sName: 'full_name'},
                {mData: '4', sName: 'doc_type'},
                {mData: '5', sName: 'identity'},
                {mData: '6', sName: 'address'},
                {mData: '7', sName: 'contact_number'},
                {mData: '8', sName: 'email'},
                {mData: '9', sName: 'role'},
                {mData: '10', sName: 'User since'},
                {mData: '11', sName: 'Updated'},
                {mData: '12', sName: 'Status', sClass: "centerAlign"},
                {mData: '13', name: 'Operation', searchable: false, sClass: "centerAlign"}
            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                $(nRow).attr("id", aData["id"]); // Change row ID attribute to match database row id
                return nRow;
            }
        }).makeEditable({
            sUpdateURL: function(value, settings)
            {
                var columnId = oTable.fnGetPosition(this)[2];
                var sColumnTitle = oTable.fnSettings().aoColumns[columnId].sName;
                var rowId = $(this).closest('tr[id]').attr('id');
                $.ajax({
                    type: "POST",
                    url: 'modifyStaff/' + rowId,
                    data: "column=" + sColumnTitle + "&id=" + rowId + "&value=" + value,
                    success: function() {
                        oTable.fnDraw();
                    }
                })
                return value;
            },
            "aoColumns": [
                null,
                {},
                {},
                {},
                {
                    indicator: 'Saving CSS Grade...',
                    tooltip: 'Click to select role',
                    loadtext: 'loading...',
                    type: 'select',
                    onblur: 'submit',
                    data: "{{ BaseController::getAllDocType() }}",
                    sUpdateURL: function(value, settings) {
                        var columnId = oTable.fnGetPosition(this)[2];
                        var sColumnTitle = oTable.fnSettings().aoColumns[columnId].sName;
                        var rowId = $(this).closest('tr[id]').attr('id');
                        $.ajax({
                            type: "POST",
                            url: 'modifyStaff/' + rowId,
                            data: "column=" + sColumnTitle + "&id=" + rowId + "&value=" + value,
                            success: function() {
                                oTable.fnDraw();
                            }
                        })
                        return value;
                    }
                },
                {},
                {},
                {},
                {},
                {
                    indicator: 'Saving CSS Grade...',
                    tooltip: 'Click to select role',
                    loadtext: 'loading...',
                    type: 'select',
                    onblur: 'submit',
                    data: "{{ BaseController::getAllRole() }}",
                    sUpdateURL: function(value, settings) {
                        var columnId = oTable.fnGetPosition(this)[2];
                        var sColumnTitle = oTable.fnSettings().aoColumns[columnId].sName;
                        var rowId = $(this).closest('tr[id]').attr('id');
                        $.ajax({
                            type: "POST",
                            url: 'modifyStaff/' + rowId,
                            data: "column=" + sColumnTitle + "&id=" + rowId + "&value=" + value,
                            success: function() {
                                oTable.fnDraw();
                            }
                        })
                        return value;
                    }
                },
                null,
                null,
                null,
                null
            ]
        });
        var oTableClient = $('#client-table').dataTable({
            bProcessing: true,
            bServerSide: true,
            sAjaxSource: 'clients',
            sPaginationType: "full_numbers",
            columns: [
                {mData: '0', sName: 'id'},
                {mData: '1', sName: 'name'},
                {mData: '2', sName: 'full_name'},
                {mData: '3', sName: 'doc_type'},
                {mData: '4', sName: 'identity'},
                {mData: '5', sName: 'address'},
                {mData: '6', sName: 'contact_number'},
                {mData: '7', sName: 'email'},
                {mData: '11', sName: 'country'},
                {mData: '10', sName: 'name'},
                {mData: '8', sName: 'Client since'},
                {mData: '12', sName: 'Last visited'},
                {mData: '13', sName: 'Current status', sClass: "centerAlign"},
                {mData: '14', sName: 'Operation', searchable: false, sClass: "centerAlign"}
            ]
        }).makeEditable({
            sUpdateURL: function(value, settings)
            {
                var columnId = oTableClient.fnGetPosition(this)[2];
                var sColumnTitle = oTableClient.fnSettings().aoColumns[columnId].sName;
                var rowId = $(this).closest('tr[id]').attr('id');
                $.ajax({
                    type: "POST",
                    url: 'modifyClient/' + rowId,
                    data: "column=" + sColumnTitle + "&id=" + rowId + "&value=" + value,
                    success: function() {
                        oTableClient.fnDraw();
                    }
                })
                return value;
            },
            "aoColumns": [
                null,
                {},
                {},
                {
                    indicator: 'Saving CSS Grade...',
                    tooltip: 'Click to select role',
                    loadtext: 'loading...',
                    type: 'select',
                    onblur: 'submit',
                    data: "{{ BaseController::getAllDocType() }}",
                    sUpdateURL: function(value, settings) {
                        var columnId = oTableClient.fnGetPosition(this)[2];
                        var sColumnTitle = oTableClient.fnSettings().aoColumns[columnId].sName;
                        var rowId = $(this).closest('tr[id]').attr('id');
                        $.ajax({
                            type: "POST",
                            url: 'modifyClient/' + rowId,
                            data: "column=" + sColumnTitle + "&id=" + rowId + "&value=" + value,
                            success: function() {
                                oTableClient.fnDraw();
                            }
                        })
                        return value;
                    }
                },
                {},
                {},
                {},
                {},
                null,
                null,
                null
            ]
        });

        $('#datetimepicker1').datetimepicker({
            locale: 'es',
            daysOfWeekDisabled: [0, 6],
            sideBySide: true,
            stepping: 15,
            minDate: moment(),
            format: "DD-MM-YYYY H:mm"
        });
        /* FORM Submit Guest */
        $("form").submit(function(e) {
            e.preventDefault();
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            //console.log(postData);
            $.ajax({
                url: formURL,
                type: $(this).attr("method"),
                data: postData,
                success: function(data)
                {

                    if (data === "mail") {
                        alert("Your message has been sent successfully.");
                    } else {
                        alert("Data inserted successfully.");
                    }
                    //location.reload(true);

                },
                error: function()
                {
                    alert("Something wrong. Contact with admin.");
                }
            });
            e.preventDefault(); //STOP default action
            $(this).unbind(e); //unbind. to stop multiple form submit.           
            $(this)[0].reset();
        });
        /* END FESTIVAL DATA FORM*/

        /*MAIL PAGE
         *  change the the view to send mail and inbox
         */
        $('section.outbox').hide();
        $('section.compose-mail').hide();
        $('ul.mail-nav li a').click(function() {
            $('ul.mail-nav li').removeClass("active");
            $(this).parent().addClass("active");
            $('section.mail-main').hide();
            $('section.compose-mail').hide();
            $('section.' + $(this).attr('class')).show();
        });

        $('.btn-compose').click(function() {
            $('ul.mail-nav li').removeClass("active");
            $('section.mail-main').hide();
            $('section.compose-mail').show();
        });

        /* END MAIL */




        $('a.messages').expander({
            slicePoint: 80, //It is the number of characters at which the contents will be sliced into two parts.
            widow: 2,
            expandSpeed: 20, // It is the time in second to show and hide the content.
            userCollapseText: 'Read Less (-)' // Specify your desired word default is Less.
        });
        $("span.message").text(function(index, currentText) {
            return currentText.substr(0, 60) + '...';
        });
    });
    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        //console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
</script>

