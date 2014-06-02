<?php namespace LimManager\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

use LimManager\Entities\User;
use LimManager\Entities\Lim;
use LimManager\Entities\Classes;

class InstallationController extends Controller {

    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => 'postInstall']);
        $this->beforeFilter('not_installed', ['only' => ['getInstall', 'postInstall']]);
        $this->beforeFilter('installed', ['only' => ['getReset', 'postReset']]);
        $this->beforeFilter('auth', ['only' => ['getReset', 'postReset']]);
        $this->beforeFilter('admin', ['only' => ['getReset', 'postReset']]);
    }

    public function getInstall()
    {
        return View::make('installation.install');
    }

    public function postInstall()
    {
        $config = Input::all();

        $this->writeAllConfig($config);

        $this->migrate($config);

        return Redirect::to('/');
    }

    public function postReset()
    {
        $this->rollback();

        return Redirect::to('install');
    }

    private function writeAllConfig(array $c = [])
    {
        $keys = [
            'database.connections.mysql.host',
            'database.connections.mysql.database',
            'database.connections.mysql.username',
            'database.connections.mysql.password',
            'database.connections.mysql.charset',
            'database.connections.mysql.collation',
            'database.connections.mysql.prefix',
            'lim.max_hours_number',
            'lim.total_viewable_weeks',
            'lim.lims',
            'lim.classes'
        ];

        foreach($keys as $key)
        {
            $this->writeConfig($key, $c);
        }
    }

    private function writeConfig($key, array $config = [])
    {
        Config::write($key, array_get($config, $key));
    }

    private function migrate(array $c = [])
    {
        Artisan::call('migrate');

        $this->seedAdmins($c['lim']['admins']);
        $this->seedTeachers($c['lim']['teachers']);
        $this->seedLims();
        $this->seedClasses();
    }

    private function rollback()
    {
        Artisan::call('migrate:rollback');
    }

    private function seedAdmins(array $admins = [])
    {
        foreach($admins as $admin)
        {
            $admin['group'] = 'admin';

            User::create($admin);
        }
    }

    private function seedTeachers(array $teachers = [])
    {
        foreach($teachers as $teacher)
        {
            $teacher['group'] = 'teacher';

            User::create($teacher);
        }
    }

    private function seedLims()
    {
        $lims = preg_split("/[\s,]+/", Config::get('lim.lims'));

        foreach($lims as $lim)
        {
            Lim::create(['name' => $lim]);
        }
    }

    private function seedClasses()
    {
        $classes = preg_split("/[\s,]+/", Config::get('lim.classes'));

        foreach($classes as $class)
        {
            Classes::create(['name' => $class]);
        }
    }

}