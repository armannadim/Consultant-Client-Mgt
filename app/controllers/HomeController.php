<?php

/**
 * Description of HomeController
 * This controller contains all the view calling functionalities.
 * 
 * @author Nadim Aseq A Arman
 * @date 27-May-2015
 */
class HomeController extends BaseController {

    public function viewLogin() {
        return View::make('pages.login');
    }

    public function viewDashboard() {
        $data = [];
        $data['totalClients'] = $this->getCount_Clients();
        $data['todaysVisit'] = $this->getCount_visitOfTheDay();
        $data['attendedVisitWeek'] = $this->getCount_visitOfTheWeek();
        $data['attendedVisitMonth'] = $this->getCount_visitOfTheMonth();
        $data['attendedVisitYear'] = $this->getCount_visitOfTheYear();
        $data['attendedVisitLastYear'] = $this->getCount_visitOfLastYear();
        $data['user'] = $this->getCount_User();
        $data['unreadMsg'] = $this->getUnreadMsg(Auth::id());
        $data['mail'] = $this->getMails(Auth::id());
//$data['']="";

        return View::make('pages.dashboard', $data);
    }

    public function viewAppManagement() {
        return View::make('pages.appmanagement');
    }

    public function viewClient() {
        return View::make('pages.client');
    }

    public function viewClientSingle($id = null) {
        $data = [];

        $data['data'] = AppController::ReadClientAction($id);
        $data['clients'] = $this->getAllClientsArray();
        $data['problems'] = $this->getProblemsArray();
        return View::make('pages.client', $data);
    }

    public function viewAddClient() {
        return View::make('pages.client');
    }

    public function viewStaff() {
        if (Auth::user()->role == 1)
            return View::make('pages.staff');
        else {
            return View::make('pages.dashboard');
        }
    }

    public function viewStaffSingle($id = null) {
        if (Auth::user()->role == 1) {
            $data = [];

            $data['data'] = AppController::ReadUserAction($id);

            return View::make('pages.client', $data);
        } else {
            return View::make('pages.dashboard');
        }
    }

    public function viewAddStaff() {
        if (Auth::user()->role == 1) {
            return View::make('pages.staff');
        } else {
            return View::make('pages.dashboard');
        }
    }

    public function viewUserConfig() {
        if (Auth::user()->role == 1) {
            return View::make('pages.userconfig');
        } else {
            return View::make('pages.dashboard');
        }
    }

    public function viewVisit() {
        return View::make('pages.visit');
    }

    public function ViewAddAppointment() {
        $clients = $this->getAllClientsArray();
        $problem = $this->getProblemsArray();
        return View::make('pages.visit')->with('clients', $clients)->with('problems', $problem);
    }

    public function viewMail() {
        $data = [];
        $data['unreadMsg'] = $this->getUnreadMsg(Auth::id());
        $data['mails'] = $this->getMails(Auth::id());
        $data['mailSend'] = $this->getMailSend(Auth::id());
        return View::make('pages.mail', $data);
    }

    /* ACTIONS */

    public function loginAction() {

        $data = Request::all();
// validate the info, create rules for the inputs
        $rules = array(
            'username' => 'required', // make sure the email is an actual email
            'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
        );

// run the validation rules on the inputs from the form
        $validator = Validator::make($data, $rules);

// if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('/')
                            ->withErrors($validator) // send back all errors to the login form
                            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {
            $userdata = array(
                'username' => $data['username'],
                'password' => $data['password']
            );

            if (Auth::attempt($userdata, Input::get('remember', 0))) {
                return Redirect::to('dashboard');
            }
        }


        return Redirect::to('/')->withErrors([
                    'credentials' => 'Username or password is not correct.',
        ]);
    }

    public function logoutAction() {
        Auth::logout();
        return Redirect::to('/');
    }

    public function addVisitAction() {
        return Request::all();
    }

    public function removeVisitAction() {
        
    }

}
