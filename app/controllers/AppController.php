<?php

/*
 * Initial version of this class has been created, modified and published by Aseq A Arman Nadim. 
 * For any sugestion, update, request, advice feel free to contact armannadim@msn.com
 * 
 * Developer: Aseq A Arman Nadim
 * Email: armannadim@msn.com
 * Web: www.armannadim.com
 */

/**
 * Description of AppController
 * This controller contains all the CRUD actions and backend functionality
 * 
 * @author NAseq
 * @date 27-May-2015
 */
class AppController extends BaseController {

    public function LoginAction() {
        return Redirect::to('deshboard');
    }

    public function LogoutAction() {
        return Redirect::to('/');
    }

    /* CRUD STAFF */

    public function CreateUserAction() {
        $data = Request::all();

        //var_dump($data);exit();
        $user = new User();
        $columns = Schema::getColumnListing('users');
        foreach ($data as $key => $value) {
            if (in_array($key, $columns)) {
                if ($key == "password") {
                    $value = Hash::make($value);
                }
                $user->$key = $value;
            }
        }
        $user->save();
        Input::file('upload')->move('img/user', $user->id . '.jpg');
        return Redirect::back();
    }

    public static function ReadUserAction($id = null) {
        $data = User::with("DocType")->with("Role")->with("Visit")->find($id);

        return $data;
    }

    public function UpdateUserAction($id) {
        $data = Request::all();
        $columns = Schema::getColumnListing('users');
        $modify_column_name = strtolower($data['column']);
        $value = $data['value'];
        if (in_array($modify_column_name, $columns)) {
            User::where('id', '=', $id)->update(array($modify_column_name => $value));
            return $modify_column_name;
        }
        return $data;
    }

    public function DeleteUserAction($id) {
        User::destroy($id);
    }

    /* CRUD CLIENT */

    public function CreateClientAction() {
        $data = Request::all();
        $client = new Clients();
        $columns = Schema::getColumnListing('clients');
        foreach ($data as $key => $value) {
            if (in_array($key, $columns)) {
                $client->$key = $value;
            }
        }
        $client->save();
        return Redirect::back();
    }

    public static function ReadClientAction($id) {
        $data = Clients::with("DocType", "StaffBelongs", "Visit")->find($id);

        return $data;
    }

    public function UpdateClientAction($id) {
        $data = Request::all();
        $columns = Schema::getColumnListing('clients');
        $modify_column_name = strtolower($data['column']);
        $value = $data['value'];
        if (in_array($modify_column_name, $columns)) {
            Clients::where('id', '=', $id)->update(array($modify_column_name => $value));
            return $modify_column_name;
        }
        return $data;
    }

    public function DeleteClientAction($id) {
        Clients::destroy($id);
    }

    /* CRUD APPOINTMENT */

    public function CreateAppointmentAction() {
        $data = Request::all();
        $visit = new Visits();
        $visit->staff_user_id = $data['staff_user_id'];
        $visit->client_id = $data['client'];
        $visit->visit_date_time = date('Y-m-d H:i:s', strtotime($data['visit_date_time']));
        $visit->VisitDetails->comments = $data['comments'];
        $visit->VisitDetails->problem = $data['problem'];
        if ($visit->save()) {
            $vd = new Visitdetails();
            $vd->comments = $data['comments'];
            $vd->problem = $data['problem'];
            $vd->visits_id = $visit->id;
            $vd->save();
        }
        return Redirect::back();
    }

    public function ReadAppointmentAction($id) {
        if ($id) {
            return Visits::with('Visitdetails')->find($id);
        }
        return Visits::all();
    }

    public function UpdateAppointmentAction($id) {
        $data = Request::all();
        $columns = Schema::getColumnListing('visitdetails');
        $modify_column_name = strtolower($data['column']);
        $value = $data['value'];
        if (in_array($modify_column_name, $columns)) {
            if (Visitdetails::where('visits_id', '=', $id)->exists()) {
                Visitdetails::where('visits_id', '=', $id)->update(array($modify_column_name => $value));
            } else {
                $vd = new Visitdetails();
                $vd->$modify_column_name = $value;
                $vd->visits_id = $id;
                $vd->save();
            }

            return $modify_column_name;
        }
        return $data;
    }

    public function DeleteAppointmentAction($id) {
        Visits::destroy($id);
        return Redirect::back()->with('message', 'Appointment removed !');
    }

    /* END CRUD */


    /* MAIL SYSTEM */

    public function SendMailAction() {
        $data = Request::all();        
        $mail = new Mails();
        $mail->sender = Auth::id();
        $mail->receiver = $data['receiver'];
        $mail->message = $data['message'];
        $mail->viewable_to = isset($data['viewable_to'])?$data['viewable_to']:'';
        $mail->save();
        return "mail";
    }

    /* END MAILING */


    /* DATATABLES */

    public function getAppointmentAction($client = null) {
        $visit = Visits::leftJoin('visitdetails', 'visits.id', '=', 'visitdetails.visits_id')
                ->rightJoin('users', 'visits.staff_user_id', '=', 'users.id')
                ->rightJoin('clients', 'visits.client_id', '=', 'clients.id')
                ->select(array('visits.id as id', 'users.name as user', 'users.full_name as user_full', 'clients.name as client', 'clients.full_name as client_full',
            'visits.visit_date_time as visits', 'visits.deleted_at as deleted', 'visitdetails.problem as problem', 'visitdetails.comments as comments'));
        if ($client != null) {
            $visit = $visit->where("visits.client_id", $client);
        }

        return Datatables::of($visit)
                        ->addColumn('operations', '<a class="delete_visit" href="{{ URL::route( \'removeVisit\', array( $id )) }}"><i class="fa fa-trash-o" style="color:red"></i></a>')
                        ->removeColumn('deleted')
                        ->make();
    }

    public function getUserAction($filter = null) {
        $user = User::leftJoin('roles', 'roles.id', '=', 'users.role')
                ->leftJoin('doc_type', 'doc_type.id', '=', 'users.doc_type')
                ->select(['users.id as id', 'users.name as user', 'users.full_name as full_name', 'users.username as username', 'doc_type.type as doc_type', 'users.identity as identity',
            'users.address as address', 'users.contact_number as contact_number', 'users.email as email', 'roles.name as role',
            'users.created_at as created_at', 'users.updated_at as updated_at', 'users.deleted_at as deleted_at']);


        return Datatables::of($user)
                        ->addColumn('Status', '@if ($deleted_at==null)<i class="fa fa-check-circle" style="color:green"></i>@else<i class="fa fa-times-circle" style="color:red"></i>@endif')
                        ->addColumn('operations', '<a href="{{ URL::route( \'remove-staff\', array( $id )) }}"><i class="fa fa-trash-o" style="color:red"></i></a> &nbsp;<a href="{{ URL::route( \'show-staff\', array( $id )) }}"><i class="fa fa-edit" style="color:green"></i></a>')
                        ->removeColumn('deleted_at')
                        ->make();
    }

    public function getClientAction($filter = null) {
        $clients = Clients::leftJoin('doc_type', 'doc_type.id', '=', 'clients.doc_type')
                ->leftJoin('users', 'users.id', '=', 'clients.addedby_user_id')
                ->select(['clients.id as id', 'clients.name as client', 'clients.full_name as full_name', 'doc_type.type as doc_type', 'clients.identity as identity',
            'clients.address as address', 'clients.contact_number as contact_number', 'clients.email as email',
            'clients.created_at as created_at', 'clients.addedby_user_id as addedby_user_id', 'users.name', 'clients.country',
            DB::raw("(select visit_date_time from tbl_visits where visit_date_time <  CAST(CURRENT_TIMESTAMP AS DATE) and tbl_visits.client_id = tbl_clients.id order by visit_date_time desc limit 1) as visit_time"),
            'clients.updated_at as updated_at', 'clients.deleted_at as deleted_at']);


        return Datatables::of($clients)
                        ->addColumn('Status', '@if ($deleted_at==null)<i class="fa fa-check-circle" style="color:green"></i>@else<i class="fa fa-times-circle" style="color:red"></i>@endif')
                        ->addColumn('operations', '<a href="{{ URL::route( \'remove-client\', array( $id )) }}"><i class="fa fa-trash-o" style="color:red"></i></a> &nbsp;<a href="{{ URL::route( \'show-client\', array( $id )) }}"><i class="fa fa-edit" style="color:green"></i></a>')
                        ->removeColumn('deleted_at')
                        ->removeColumn('updated_at')
                        ->make();
    }

    /* END DATATABLES */

    /* JSON responses */

    public function getAllRoles() {
        return Role::all()->toJson();
    }

}
