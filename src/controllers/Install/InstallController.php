<?php namespace Barrel\Controllers\Install;

use Barrel\Controllers\BaseController;
use Barrel\Entities\User;
use Barrel\Entities\Install;
use View;
use Response;
use Artisan;
use Input;
use Hash;
use Schema;

class InstallController extends BaseController {

    private $dbSetup = false;

    public function actions()
    {
        $database = app_path().'/database/production.sqlite';

        if (file_exists($database)) {
            unlink($database);
        }

        if (is_readable(app_path().'/database/')) {
            file_put_contents($database, null);
            sleep(rand(1, 3));
        } else {
            return Response::make(['status' => 'error'], 500);
        }

        if (Artisan::call('migrate') === 0) {
            $this->dbSetup = true;
            sleep(rand(1, 3));
        } else {
            return Response::make(['status' => 'error'], 500);
        }

        $user = new User;
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));

        if (!$user->save()) {
            return Response::make(['status' => 'error'], 500);
        }

        if (Artisan::call('asset:publish', ['barrelcms/application']) === 0 || Artisan::call('asset:publish', ['--bench', 'barrelcms/application']) === 0) {
            sleep(rand(1, 3));
            return Response::make(['status' => 'success'], 200);
        } else {
            return Response::make(['status' => 'error'], 500);
        }
    }

    public function completeInstall()
    {
        $install = new Install;
        $install->success = 'success';
        $install->save();

        echo 'installed';
    }

}