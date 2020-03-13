<?php

require_once 'functions.php';

$checkParams = !empty($_POST['db_host'])
    && !empty($_POST['db_name'])
    && !empty($_POST['db_user'])
//    && !empty($_POST['db_password'])
    && !empty($_POST['admin_email'])
    && !empty($_POST['admin_password'])
    && !empty($_POST['admin_password_confirmation']);

if ($checkParams) {
    try {
        if (strlen($_POST['admin_password']) < 8) {
            throw new Exception("password must be greater than or equal to 8 characters");
        } elseif ($_POST['admin_password'] !== $_POST['admin_password_confirmation']) {
            throw new Exception("passwords do not match");
        }

        // Check database connection
        $db = new PDO("mysql:host={$_POST['db_host']};dbname={$_POST['db_name']}", $_POST['db_user'], ($_POST['db_password'] ?? ''));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        echo "Database connection successful.";

        // Create .env file
        if (file_exists(__DIR__.'/../.env.example')) {
            $envContent = file_get_contents(__DIR__.'/../.env.example');

            $envContent = str_replace([
                    'DB_HOST=',
                    'DB_DATABASE=',
                    'DB_USERNAME=',
                    'DB_PASSWORD=',
            ], [
                    "DB_HOST={$_POST['db_host']}",
                    "DB_DATABASE={$_POST['db_name']}",
                    "DB_USERNAME={$_POST['db_user']}",
                    "DB_PASSWORD={$_POST['db_password']}",
            ], $envContent);

            if (file_put_contents(__DIR__.'/../.env', $envContent)){
//                echo "Config file created successfully.";
            }
        } else {
            throw new Exception("config file not created");
        }

        // Install composer dependencies
        $withSeed = isset($_POST['sample_data']);
        if (($comp = composerInstall($withSeed)) !== null) {
//            echo "Composer dependencies installed successfully.";
        } else {
            throw new Exception("composer dependencies not installed");
        }

        // Insert admin to database
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$_POST['admin_email']]);

        if ($stmt->fetch() === false) {
            $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([
                    'Admin',
                    $_POST['admin_email'],
                    bcrypt($_POST['admin_password'])
            ])) {
//            echo "Admin inserted successfully.";
            } else {
                throw new Exception("admin not inserted to database.");
            }
        } else {
            throw new Exception("admin with the same email already exists");
        }

        // Redirect to main page
        header('Location: /');
    } catch (PDOException $exception) {
        $error = "Database connection failed: " . $exception->getMessage();
    } catch (Exception $exception) {
        shell_exec('cd '.__DIR__.'/.. && rm .env');

        $error = "Error: " . $exception->getMessage() . '.';
    }
} else {
    if (isset($_POST['submit'])) $error = "Fill in all the fields.";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Install</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
            <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
            <?php endif; ?>
            <form method="post" action="index.php">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Store information</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="admin_email">Admin user email:</label>
                            <input type="email" name="admin_email" value="<?= oldValue('admin_email') ?>" class="form-control" id="admin_email">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="admin_password">Admin user password:</label>
                                    <input type="password" name="admin_password" value="" class="form-control" id="admin_password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="admin_password_confirmation">Confirm the password:</label>
                                    <input type="password" name="admin_password_confirmation" value="" class="form-control" id="admin_password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" name="sample_data" type="checkbox" id="create_sample_data" <?= isset($_POST['sample_data']) ? 'checked' : '' ?>>
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
                            <input type="text" name="db_host" value="<?= oldValue('db_host', '127.0.0.1') ?>" class="form-control" id="db_host">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="db_name">Database name:</label>
                                    <input type="text" name="db_name" value="<?= oldValue('db_name') ?>" class="form-control" id="db_name">
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
                                    <input type="text" name="db_user" value="<?= oldValue('db_user', 'root') ?>" class="form-control" id="db_user">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="db_password">Server password:</label>
                                    <input type="text" name="db_password" value="<?= oldValue('db_password') ?>" class="form-control" id="db_password">
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
                        <button type="submit" name="submit" value="<?= oldValue('submit') ?>" class="btn btn-md btn-success">Install</button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-md btn-secondary">Restart installation</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>


