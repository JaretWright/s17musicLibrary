<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">

</head>
<body>
    <main class="container">
        <h1>User Registration</h1>
        <div class="alert alert-info" id="message">Please create a new user</div>

        <form method="post" action="save-registration.php">
            <fieldset class="form-group">
                <label for="email" class="col-sm-2">Email: *</label>
                <input name="email" id="email" required type="email"
                       placeholder="email@email.com">
            </fieldset>
            <fieldset class="form-group">
                <label for="password" class="col-sm-2">Password:</label>
                <input name="password" id="password" required type="password" placeholder="Password"
                       pattern="(?=.*\d)(?=.*[A-Z].{8,}"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="confirm" class="col-sm-2">Confirm Password:</label>
                <input name="confirm" id="confirm" required type="password" placeholder="Password"
                       pattern="(?=.*\d)(?=.*[A-Z].{8,}"/>
            </fieldset>
            <button class="col-sm-offset-2 btn btn-success btnRegister">Save</button>
        </form>
    </main>
</body>

<!-- Latest jQuery -->
<script src="js/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script src="js/app.js"></script>
</html>
