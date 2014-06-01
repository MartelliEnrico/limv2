<?php namespace LimManager\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

use LimManager\Entities\User;
use LimManager\Entities\Lim;
use LimManager\Entities\Classes;

class InstallationController extends Controller {

    protected $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;

        $this->beforeFilter('installed');
    }

    public function getInstall()
    {
        return View::make('installation.index');
    }

    public function getStart()
    {
        Artisan::call('migrate');

        $this->seedAdmins();
        $this->seedTeachers();
        $this->seedLims();
        $this->seedClasses();

        return Redirect::to('/');
    }

    private function seedAdmins()
    {
        $admins = $this->config->get('lim.admins');

        foreach($admins as $admin)
        {
            $admin['group'] = 'admin';

            User::create($admin);
        }
    }

    private function seedTeachers()
    {
        $teachers = $this->config->get('lim.teachers');

        foreach($teachers as $teacher)
        {
            $teacher['group'] = 'teacher';

            User::create($teacher);
        }
    }

    private function seedLims()
    {
        $lims = $this->config->get('lim.lims');

        foreach($lims as $lim)
        {
            Lim::create(['name' => $lim]);
        }
    }

    private function seedClasses()
    {
        $classes = $this->config->get('lim.classes');

        foreach($classes as $class)
        {
            Classes::create(['name' => $class]);
        }
    }

}