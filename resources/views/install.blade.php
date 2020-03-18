<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Install</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row mt-5 align-items-center justify-content-end">
        <div class="col-sm-6">
            <div class="row">
                <div style="border-bottom: 1px solid rgba(0,0,0,.125);" class="col text-right pr-0">
                    <h4>INSTALLATION</h4>
                </div>
                <div class="col-auto pl-4">
                    <select class="form-control">
                        <option selected>English</option>
                        <option>Русский</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-12">
            @if($errors->any() || session('exception'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                        @if(session('exception'))
                            <li>{{ session('exception') }}</li>
                        @endif
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('install') }}">
                @csrf
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Store information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="admin_name">Admin name:</label>
                                    <input type="text" name="admin_name" value="{{ old('admin_name') }}" class="form-control" id="admin_name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="admin_email">Admin user email:</label>
                                    <input type="email" name="admin_email" value="{{ old('admin_email') }}" class="form-control" id="admin_email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="admin_password">Admin user password:</label>
                                    <input type="password" name="admin_password" class="form-control" id="admin_password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="admin_password_confirmation">Confirm the password:</label>
                                    <input type="password" name="admin_password_confirmation" class="form-control" id="admin_password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" name="sample_data" type="checkbox"
                               id="create_sample_data" {{ old('sample_data') ? 'checked' : '' }}>
                        <label class="form-check-label" for="create_sample_data">Create sample data</label>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Database information</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="db_host">Server name:</label>
                            <input type="text" name="db_host" value="{{ old('db_host', '127.0.0.1') }}" class="form-control" id="db_host">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="db_name">Database name:</label>
                                    <input type="text" name="db_name" value="{{ old('db_name') }}" class="form-control" id="db_name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="database_collation">Collation:</label>
                                    <select id="database_collation" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>#1</option>
                                        <option>#2</option>
                                        <option>#3</option>
                                        <option>...</option>
                                        <option>#N</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="db_user">Server username:</label>
                                    <input type="text" name="db_user" value="{{ old('db_user', 'root') }}" class="form-control" id="db_user">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="db_password">Server password:</label>
                                    <input type="text" name="db_password" value="{{ old('db_password') }}" class="form-control" id="db_password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="connection_string">
                        <label class="form-check-label" for="connection_string">Connection string</label>
                    </div>
                </div>
                <div class="row mt-5 justify-content-between">
                    <div class="col-auto">
                        <button type="submit" name="submit" class="btn btn-md btn-success">Install</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>