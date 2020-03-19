@extends('install.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.title') !!}
@endsection

@section('container')
    <div class="tabs tabs-full">
        <input id="tab1" type="radio" name="tabs" class="tab-input" checked />
        <label for="tab1" class="tab-label">
            <i class="fa fa-cog fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('installer_messages.environment.tabs.environment') }}
        </label>

        <input id="tab2" type="radio" name="tabs" class="tab-input" />
        <label for="tab2" class="tab-label">
            <i class="fa fa-database fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('installer_messages.environment.tabs.database') }}
        </label>

        <input id="tab3" type="radio" name="tabs" class="tab-input" />
        <label for="tab3" class="tab-label">
            <i class="fa fa-user fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('installer_messages.environment.tabs.admin') }}
        </label>

        <form method="post" action="{{ route('install.save_environment') }}" class="tabs-wrap">
            @csrf
            <div class="tab" id="tab1content">
                <div class="form-group {{ $errors->has('app_name') ? ' has-error ' : '' }}">
                    <label for="app_name">
                        {{ trans('installer_messages.environment.form.app_name_label') }}
                    </label>
                    <input type="text" name="app_name" id="app_name" value="{{ old('app_name', 'Owl Vision') }}" placeholder="{{ trans('installer_messages.environment.form.app_name_placeholder') }}" />
                    @if ($errors->has('app_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
                    <label for="app_url">
                        {{ trans('installer_messages.environment.form.app_url_label') }}
                    </label>
                    <input type="url" name="app_url" id="app_url"
                           value="{{ old('app_url', request()->server('REQUEST_SCHEME') . '://' . request()->server('HTTP_HOST')) }}"
                           placeholder="{{ trans('installer_messages.environment.form.app_url_placeholder') }}" />
                    @if ($errors->has('app_url'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('app_url') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showDatabaseSettings();return false">
                        {{ trans('installer_messages.environment.form.buttons.setup_database') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="tab" id="tab2content">
                <div class="form-group {{ $errors->has('database_connection') ? ' has-error ' : '' }}">
                    <label for="database_connection">
                        {{ trans('installer_messages.environment.form.db_connection_label') }}
                    </label>
                    <select name="database_connection" id="database_connection">
                        <option value="mysql" {{ old('database_connection') === 'mysql' ? 'selected' : '' }}>
                            {{ trans('installer_messages.environment.form.db_connection_label_mysql') }}
                        </option>
                        <option value="sqlite" {{ old('database_connection') === 'sqlite' ? 'selected' : '' }}>
                            {{ trans('installer_messages.environment.form.db_connection_label_sqlite') }}
                        </option>
                        <option value="pgsql" {{ old('database_connection') === 'pgsql' ? 'selected' : '' }}>
                            {{ trans('installer_messages.environment.form.db_connection_label_pgsql') }}
                        </option>
                        <option value="sqlsrv" {{ old('database_connection') === 'sqlsrv' ? 'selected' : '' }}>
                            {{ trans('installer_messages.environment.form.db_connection_label_sqlsrv') }}
                        </option>
                    </select>
                    @if ($errors->has('database_connection'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_connection') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
                    <label for="database_hostname">
                        {{ trans('installer_messages.environment.form.db_host_label') }}
                    </label>
                    <input type="text" name="database_hostname" id="database_hostname" value="{{ old('database_hostname', '127.0.0.1') }}" placeholder="{{ trans('installer_messages.environment.form.db_host_placeholder') }}" />
                    @if ($errors->has('database_hostname'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_hostname') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
                    <label for="database_port">
                        {{ trans('installer_messages.environment.form.db_port_label') }}
                    </label>
                    <input type="number" name="database_port" id="database_port" value="{{ old('database_port', '3306') }}" placeholder="{{ trans('installer_messages.environment.form.db_port_placeholder') }}" />
                    @if ($errors->has('database_port'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_port') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                    <label for="database_name">
                        {{ trans('installer_messages.environment.form.db_name_label') }}
                    </label>
                    <input type="text" name="database_name" id="database_name" value="{{ old('database_name', '') }}" placeholder="{{ trans('installer_messages.environment.form.db_name_placeholder') }}" />
                    @if ($errors->has('database_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
                    <label for="database_username">
                        {{ trans('installer_messages.environment.form.db_username_label') }}
                    </label>
                    <input type="text" name="database_username" id="database_username" value="{{ old('database_username', 'root') }}" placeholder="{{ trans('installer_messages.environment.form.db_username_placeholder') }}" />
                    @if ($errors->has('database_username'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_username') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
                    <label for="database_password">
                        {{ trans('installer_messages.environment.form.db_password_label') }}
                    </label>
                    <input type="password" name="database_password" id="database_password" value="{{ old('database_password', '') }}" placeholder="{{ trans('installer_messages.environment.form.db_password_placeholder') }}" />
                    @if ($errors->has('database_password'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_password') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('sample_data') ? ' has-error ' : '' }}">
                    <label for="sample_data">
                        {{ trans('installer_messages.environment.form.db_sample_data_label') }}
                    </label>
                    <input type="checkbox" name="sample_data" id="sample_data" {{ old('sample_data') ? 'checked' : '' }} />
                    @if ($errors->has('sample_data'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('sample_data') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showAdminSettings();return false">
                        {{ trans('installer_messages.environment.form.buttons.setup_admin') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="tab" id="tab3content">
                <div class="form-group {{ $errors->has('admin_name') ? ' has-error ' : '' }}">
                    <label for="admin_name">{{ trans('installer_messages.environment.form.admin_name') }}</label>
                    <input type="text" name="admin_name" id="admin_name" value="{{ old('admin_name', '') }}" placeholder="{{ trans('installer_messages.environment.form.admin_name') }}" />
                    @if ($errors->has('admin_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('admin_name') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('admin_email') ? ' has-error ' : '' }}">
                    <label for="admin_email">{{ trans('installer_messages.environment.form.admin_email') }}</label>
                    <input type="text" name="admin_email" id="admin_email" value="{{ old('admin_email', '') }}" placeholder="{{ trans('installer_messages.environment.form.admin_email') }}" />
                    @if ($errors->has('admin_email'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('admin_email') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('admin_password') ? ' has-error ' : '' }}">
                    <label for="admin_password">{{ trans('installer_messages.environment.form.admin_password') }}</label>
                    <input type="password" name="admin_password" id="admin_password" placeholder="{{ trans('installer_messages.environment.form.admin_password') }}" />
                    @if ($errors->has('admin_password'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('admin_password') }}
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('admin_password_confirmation') ? ' has-error ' : '' }}">
                    <label for="admin_password_confirmation">{{ trans('installer_messages.environment.form.admin_password_confirmation') }}</label>
                    <input type="password" name="admin_password_confirmation" id="admin_password_confirmation" placeholder="{{ trans('installer_messages.environment.form.admin_password_confirmation') }}" />
                    @if ($errors->has('admin_password_confirmation'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('admin_password_confirmation') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" type="submit">
                        {{ trans('installer_messages.environment.form.buttons.install') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function showDatabaseSettings() {
            document.getElementById('tab2').checked = true;
        }
        function showAdminSettings() {
            document.getElementById('tab3').checked = true;
        }
    </script>
@endsection
