<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call('RolesTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('LogsTableSeeder');
        $this->call('DocTypeTableSeeder');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}

class RolesTableSeeder extends Seeder {

    public function run() {
        DB::table('roles')->truncate();


        Role::create(array('name' => 'admin'));
        Role::create(array('name' => 'Senior Staff'));
    }

}

class UsersTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->truncate();

        $admin_role = DB::table('roles')
                        ->select('id')
                        ->where('name', 'admin')
                        ->first()
                ->id;
        $senior_staff_role = DB::table('roles')
                        ->select('id')
                        ->where('name', 'Senior Staff')
                        ->first()
                ->id;

        $now = date('Y-m-d H:i:s');


        User::create(array(
            'username' => 'Staff',
            'password' => Hash::make('test'),
            'name' => 'Senior Staff',
            'created_at' => $now,
            'updated_at' => $now,
            'role' => $senior_staff_role
        ));
        User::create(array(
            'username' => 'admin',
            'password' => Hash::make('test'),
            'name' => 'Admin',
            'created_at' => $now,
            'updated_at' => $now,
            'role' => $admin_role
        ));
    }

}

class LogsTableSeeder extends Seeder {

    public function run() {
        DB::table('logs')->truncate();
        $data = array();

        Logs::create(array(
            'user_id' => '1',
            'activity' => 'Data Seed',
            'module' => "DatabasSeeder"
        ));
    }

}

class ConfigTableSeeder extends Seeder {

    public function run() {
        DB::table('config')->truncate();

        Config::create(array('param' => 'lang', 'value'=>'es'));
        //Config::create(array('param' => 'lang', 'value'=>'es'));
        
    }

}

class DocTypeTableSeeder extends Seeder {

    public function run() {
        DB::table('doc_type')->truncate();


        DocType::create(array('type' => 'DNI'));
        DocType::create(array('type' => 'NIE'));
        DocType::create(array('type' => 'Passport'));
    }

}