<?php


class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /* CONFIGURATION ACTIONS */

    public function getConfigVariablesAction() {
        
    }

    public function CreateConfigVarAction() {
        
    }

    public function UpdateConfigAction($id) {
        
    }

    public function DeleteConfigAction($id) {
        
    }

    /* GET DATA FOR THE DROPDOWNLIST */

    public function getAllClientsArray() {
        $clientsQuery = Clients::all()->toArray();
        $clients = array();
        $clients[0] = 'Select Client';
        foreach ($clientsQuery as $row) {
            $clients[$row['id']] = $row['name'] . ', ' . $row['full_name'] . ' | ID: ' . $row['identity'];
        }
        return $clients;
    }

    public function getProblemsArray() {
        $problemQuery = DB::table('visitdetails')
                        ->orderBy('problem', 'asc')
                        ->groupBy('problem')->get();
        $problems = array();
        $problems[0] = 'Select Problem';
        $count = 1;
        foreach ($problemQuery as $row) {
            $problems[$count] = $row->problem;
            $count++;
        }
        return $problems;
    }

    public function getVisitsOfDay($date) {
        $date = substr($date, 0, -3);
        $date = date("Y-m-d", $date);

        $visits = Visits::leftJoin('Clients', 'clients.id', '=', 'visits.client_id')
                ->select(['clients.name as client', 'visits.visit_date_time as visits'])
                ->where('visits.staff_user_id', '=', '1')
                ->where('visits.visit_date_time', 'like', $date . "%")
                ->orderby('visits.visit_date_time')
                ->get();
        $html = "";
        $html .= "<span>Visits of this day</span><table class='table table-striped'><thead><td>#</td><td>Client Name</td><td>Appointment</td></thead><tbody>";
        $count = 0;
        foreach ($visits as $row) {
            $count ++;
            $html .= "<tr><td>" . $count . "</td><td>" . $row['client'] . '</td><td>' . $row['visits'] . '</td></tr>';
        }
        if ($count == 0) {
            $html .= "<tr><td colspan='3'> You're totally free on this day. </td></tr>";
        }
        $html .= "</tbody></table>";

        return $html;
    }

    /* END GET DATA FOR THE DROPDOWNLIST */

    public function getAllVisit($id = null) {
        $response = [];
        $visits = Visits::all();
        foreach ($visits as $d) {
            $response[] = [
                'id' => $d->id,
                'staff' => $d->Staff['name'] . ", " . $d->Staff['full_name'],
                'client' => $d->Client['name'] . " (" . $d->Client['identity'] . ")",
                'client_id' => $d->client_id,
                'appointment' => date(DATE_ISO8601, strtotime($d->visit_date_time)),
                'country' => $d->VisitDetails,
            ];
        }

        return json_encode($response);
    }

    public static function getAllDocType() {
        $doc = DocType::all();
        $ret = "{";
        foreach ($doc as $d) {
            $ret = $ret . "'" . $d['id'] . "' : '" . $d['type'] . "', ";
        }
        $ret = rtrim($ret, ", ") . "}";

        return $ret;
    }

    public static function getAllRole() {
        $role = Role::all();
        $ret = "{";
        foreach ($role as $d) {
            $ret = $ret . "'" . $d['id'] . "' : '" . $d['name'] . "', ";
        }

        $ret = rtrim($ret, ", ") . "}";

        return $ret;
    }

    public static function getCount_visitOfTheDay() {
        return DB::select(DB::raw("select * from `tbl_visits` where DATE(visit_date_time) = CURDATE()"));
    }

    public static function getCount_visitOfTheWeek() {
        return count(DB::select(DB::raw("select * from `tbl_visits` where YEARWEEK(visit_date_time, 1) = YEARWEEK(CURDATE(), 1)")));
    }

    public static function getCount_visitOfTheMonth() {
        return count(DB::select(DB::raw("select * from `tbl_visits` where date_format(visit_date_time, '%Y-%m') = date_format(now(), '%Y-%m')")));
    }

    public static function getCount_visitOfTheYear() {
        return count(DB::select(DB::raw("select * from `tbl_visits` where year(visit_date_time) =YEAR(CURDATE())")));
    }

    public static function getCount_visitOfLastYear() {
        return count(DB::select(DB::raw("select * from `tbl_visits` where year(visit_date_time) = YEAR(CURDATE())-1")));
    }

    public static function getCount_Clients() {
        return Clients::all()->count();
    }
    
    public static function getCount_User() {
        return User::all();
    }
    
   
    /*
     * Returns all the mail for the inbox
     */
    public static function getMails($user_id){
        return DB::table('mail')->where('receiver', $user_id)->orWhere('viewable_to','all')->orderBy('created_at', 'DESC')->get();
    }

    public static function getMailSend($user_id){
        return DB::table('mail')->where('sender', $user_id)->orderBy('created_at')->get();
    }
    
    /* 
     * To get all unread message to show in the header
     */
    public static function getUnreadMsg($user_id){
        return DB::table('mail')->where('receiver', $user_id)->where('read_status', '0')->orderBy('created_at', 'DESC')->get();
    }
    /*Get time difference 
     * Example: 5 minutes ago, 2 days ago
     */
    
    public static function getTimeDiff($time){
        return \Carbon\Carbon::createFromTimeStamp(strtotime($time))->diffForHumans();
    }
}
