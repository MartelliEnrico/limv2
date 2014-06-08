@extends('layouts.plain')

@section('body')

<div class="container" style="margin-bottom: 40px">

    {{ Form::open() }}
        
        <h1>Installa il Lim Manager</h1>

        <h2>Database</h2>

        {{ form_text('database[connections][mysql][host]', 'Host del Database MySql:', $errors, Config::get('database.connections.mysql.host')) }}
        {{ form_text('database[connections][mysql][database]', 'Nome del Database:', $errors, Config::get('database.connections.mysql.database')) }}
        {{ form_text('database[connections][mysql][username]', 'Username per accedere al Database:', $errors, Config::get('database.connections.mysql.username')) }}
        {{ form_text('database[connections][mysql][password]', 'Password per accedere al Database:', $errors, Config::get('database.connections.mysql.password')) }}
        {{ form_text('database[connections][mysql][charset]', 'Charset del Database:', $errors, Config::get('database.connections.mysql.charset')) }}
        {{ form_text('database[connections][mysql][collation]', 'Collation del Database:', $errors, Config::get('database.connections.mysql.collation')) }}
        {{ form_text('database[connections][mysql][prefix]', 'Prefisso delle tabelle:', $errors, Config::get('database.connections.mysql.prefix')) }}

        <h2>Lim</h2>

        {{ form_text('lim[max_hours_number]', 'Ore massime giornaliere:', $errors, Config::get('lim.max_hours_number')) }}
        {{ form_text('lim[total_viewable_weeks]', 'Settimane visibili per prenotazione:', $errors, Config::get('lim.total_viewable_weeks')) }}
        {{ form_textarea('lim[lims]', 'Lista delle lim: (Separa i nomi da una virgola)', $errors, Config::get('lim.lims')) }}
        {{ form_textarea('lim[classes]', 'Lista delle classi: (Separa i nomi da una virgola)', $errors, Config::get('lim.classes')) }}

        <h2>Amministratori e Professori</h2>

        <p>Amministratori:</p>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                </tr>
            </thead>
            <tbody>
                <tr class="row"><td class="form-group"><input name="lim[admins][0][username]" type="text" value="Administrator"></td><td class="form-group"><input name="lim[admins][0][password]" type="text" value="Pavgisikni52@"></td><td class="form-group"><input name="lim[admins][0][first_name]" type="text" value="Enrico"></td><td class="form-group"><input name="lim[admins][0][last_name]" type="text" value="Martelli"></td></tr>
                <tr>
                    <td colspan="4">
                        <button class="button js-add" data-type="admins">Aggiungi</button> <button class="button js-remove">Rimuovi</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <p>Professori:</p>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                </tr>
            </thead>
            <tbody>
                <tr class="row"><td class="form-group"><input name="lim[teachers][0][username]" type="text" value="professore"></td><td class="form-group"><input name="lim[teachers][0][password]" type="text" value="professore"></td><td class="form-group"><input name="lim[teachers][0][first_name]" type="text" value="Pinco"></td><td class="form-group"><input name="lim[teachers][0][last_name]" type="text" value="Pallo"></td></tr>
                <tr class="row"><td class="form-group"><input name="lim[teachers][1][username]" type="text" value="secondario"></td><td class="form-group"><input name="lim[teachers][1][password]" type="text" value="123456"></td><td class="form-group"><input name="lim[teachers][1][first_name]" type="text" value="Dario"></td><td class="form-group"><input name="lim[teachers][1][last_name]" type="text" value="Secondo"></td></tr>
                <tr>
                    <td colspan="4">
                        <button class="button js-add" data-type="teachers">Aggiungi</button> <button class="button js-remove">Rimuovi</button>
                    </td>
                </tr>
            </tbody>
        </table>

        {{ Form::submit('Inizia installazione', ['class' => 'button', 'style' => 'margin-top:40px']) }}

    {{ Form::close() }}

</div>

@stop