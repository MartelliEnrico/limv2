<?php namespace LimManager\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Event;
use Exception;

use LimManager\Entities\Lim;
use LimManager\Entities\Classes;
use LimManager\Entities\Hour;
use LimManager\Entities\Persistent;
use LimManager\Forms\Lim as LimForm;
use LimManager\Forms\Reserve as ReserveForm;
use LimManager\Forms\Remove as RemoveForm;
use LimManager\Forms\DayHour as DayHourForm;
use LimManager\Forms\Reset as ResetForm;

class LimsController extends Controller {

    protected $limForm;

    protected $reserveForm;

    protected $removeForm;

    protected $dayHourForm;

    protected $resetForm;

    public function __construct(
        LimForm $limForm, ReserveForm $reserveForm, RemoveForm $removeForm, 
        DayHourForm $dayHourForm, ResetForm $resetForm
    )
    {
        $this->limForm = $limForm;
        $this->reserveForm = $reserveForm;
        $this->removeForm = $removeForm;
        $this->dayHourForm = $dayHourForm;
        $this->resetForm = $resetForm;

        $this->beforeFilter('csrf', ['on' => 'post']);
        $this->beforeFilter('auth', ['except' => ['index', 'show']]);
        $this->beforeFilter('admin', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
        $this->beforeFilter('teacher', ['only' => 'reserve']);
    }

    public function index()
    {
        $lims = Lim::all();

        if(Auth::check() && Auth::user()->group == 'admin') {
            $lims = Lim::all();
        } else {
            $lims = Lim::where('working', true)->get();
        }

        return View::make('lims.index', compact('lims'));
    }

    public function create()
    {
        return View::make('lims.create');
    }

    public function store()
    {
        $this->limForm->validate($input = Input::only('name'));

        $lim = Lim::create($input);

        return Redirect::route('lims.edit', [$lim->id])->withFlashMessage('Lim creata con successo.');
    }

    public function show($id)
    {
        $lim = Lim::find($id);
        $week = $lim->currentWeekboard(Input::get('week'));
        $persistents = $lim->persistents;

        $limsHours = $week->hours()->with('classes', 'teacher')->get();

        if( ! is_null($persistents))
        {
            $persistents->each(function($persistent) use (&$limsHours)
            {
                $limsHours = $limsHours->merge($persistent->hours()->with('classes')->get());
            });
        }

        $table = [];

        $limsHours->each(function($hour) use (&$table)
        {
            $table[$hour->day][$hour->hour] = $hour->toArray();
        });

        return View::make('lims.show', compact('lim', 'table'));
    }

    public function reserve($id)
    {
        $this->reserveForm->validate($input = Input::only('hours', 'class_id'));

        $hours = json_decode($input['hours']);

        $week = Lim::find($id)->currentWeekboard(Input::get('week'));

        foreach($hours as $hour)
        {
            $this->dayHourForm->validate(['day' => $hour[0], 'hour' => $hour[1]]);

            $h = new Hour;
            $h->day = $hour[0];
            $h->hour = $hour[1];
            $h->teacher_id = Auth::user()->id;
            $h->class_id = $input['class_id'];

            $week->hours()->save($h);
        }

        return Redirect::back()->withFlashMessage('Lim prenotata con successo.');
    }

    public function persistent($id)
    {
        $this->reserveForm->validate($input = Input::only('hours', 'class_id'));

        $hours = json_decode($input['hours']);

        try
        {
            $persistent = Persistent::where('class_id', $input['class_id'])->firstOrFail();
        }
        catch(Exception $e)
        {
            $persistent = Persistent::create([
                'lim_id' => $id,
                'class_id' => $input['class_id']
            ]);
        }

        foreach($hours as $hour)
        {
            $this->dayHourForm->validate(['day' => $hour[0], 'hour' => $hour[1]]);

            $h = new Hour;
            $h->day = $hour[0];
            $h->hour = $hour[1];
            $h->class_id = $input['class_id'];

            $persistent->hours()->save($h);
        }

        return Redirect::back()->withFlashMessage('Lim modificata con successo.');
    }

    public function remove($id)
    {
        $this->removeForm->validate($input = Input::only('hour_id'));

        Hour::find($input['hour_id'])->delete();

        return Redirect::back()->withFlashMessage('Rimozione avvenuta con successo.');
    }

    public function reset($id)
    {
        $this->resetForm->validate($input = Input::only('class_id'));

        Persistent::where('class_id', $input['class_id'])->where('lim_id', $id)->delete();

        return Redirect::back()->withFlashMessage('Rimozione avvenuta con successo.');
    }

    public function edit($id)
    {
        $lim = Lim::find($id);
        $persistents = $lim->persistents;

        $limsHours = new Collection([]);

        if( ! is_null($persistents))
        {
            $persistents->each(function($persistent) use (&$limsHours)
            {
                $limsHours = $limsHours->merge($persistent->hours()->with('classes')->get());
            });
        }

        $table = [];

        $limsHours->each(function($hour) use (&$table)
        {
            $table[$hour->day][$hour->hour] = $hour->toArray();
        });

        return View::make('lims.edit', compact('lim', 'table'));
    }

    public function update($id)
    {
        $this->limForm->validate($input = Input::only('name'));

        $lim = Lim::find($id);
        $lim->name = $input['name'];
        $lim->save();

        return Redirect::back()->withFlashMessage('Lim modificata con successo.');
    }

    public function disable($id)
    {
        $lim = Lim::find($id);
        $lim->working = ! $lim->working;
        $lim->save();

        Event::fire('lim.changed_state', [$lim]);

        return Redirect::back()->withFlashMessage('Lim '.($lim->working ? 'abilitata' : 'disabilitata').' con successo.');
    }

    public function destroy($id)
    {
        Lim::find($id)->delete();

        return Redirect::back()->withFlashMessage('Lim eliminata con successo.');
    }

}