<script>
    <?php
    //function for signup
    function signup($data)
    {
        $errors = array();

        // validate
        if (!preg_match('/^[a-zA-Z ]+$/', $data['first_name'])) {
            $errors[] = "<div class='error text-center'>Please enter a valid first_name.</div>";
        }

        if (!preg_match('/^[a-zA-Z ]+$/', $data['last_name'])) {
            $errors[] = "<div class='error text-center'>Please enter a valid last_name.</div>";
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $data['username'])) {
            $errors[] = "<div class='error text-center'>Please enter a valid username.</div>";
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "<div class='error text-center'>Please enter a valid email.</div>";
        }

        if (strlen(trim($data['password'])) < 8) {
            $errors[] = "<div class='error text-center'>Password must be at least 8 characters.</div>";
        }

        if ($data['password'] != $data['password2']) {
            $errors[] = "<div class='error text-center'>Password must match.</div>";
        }

        $check = database_run("SELECT COUNT(*) FROM users WHERE email = :email", ['email' => $data['email']]);

        if ($check && $check[0]['count'] > 0) {
            $errors[] = "<div class='error text-center'>Email already exist.</div>";
            echo $data['email'];
            die();
        }

        // Retrieve account type
        $accountTypeQuery = "SELECT * FROM account_type WHERE type_name = 'viewer'";
        $accountTypeResult = database_run($accountTypeQuery);

        if ($accountTypeResult) {
            $user = $accountTypeResult[0];
            $account_type_id = $user['account_type_id'];

            // Save user data
            if (count($errors) == 0) {
                $arr['first_name'] = $data['first_name'];
                $arr['last_name'] = $data['last_name'];
                $arr['gender'] = $data['gender'];
                $arr['username'] = $data['username'];
                $arr['email'] = $data['email'];
                $arr['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $arr['affiliation'] = $data['affiliation'];
                $arr['account_type_id'] = $account_type_id;

                $query = "INSERT INTO users (first_name, last_name, gender, username, email, password, affiliation, account_type_id) 
                    VALUES (:first_name, :last_name, :gender, :username, :email, :password, :affiliation, :account_type_id)";
                database_run($query, $arr);
            }
        } else {
            $errors[] = "Error retrieving account type";
        }

        return $errors;
    }

    //function for login
    function login($data)
    {
        $errors = array();

        // validate
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email";
        }

        if (strlen(trim($data['password'])) < 3) {
            $errors[] = "Password must be at least 3 characters";
        }

        // check
        if (count($errors) == 0) {
            $email = $data['email'];
            $providedPassword = $data['password'];

            $query = "SELECT users.user_id, users.password, users.first_name, users.email, users.email_verified, account_type.type_name  FROM users LEFT JOIN account_type ON users.account_type_id = account_type.account_type_id WHERE email = :email LIMIT 1";

            $row = database_run($query, array(':email' => $email));

            if (!empty($row) && password_verify($providedPassword, $row[0]['password'])) {
                // Check if the user's email is verified
                if ($row[0]['email_verified'] == $email) {
                    // Only store essential information in the session
                    $_SESSION['USER']['user_id'] = $row[0]['user_id'];
                    $_SESSION['USER']['first_name'] = $row[0]['first_name'];
                    $_SESSION['USER']['email'] = $row[0]['email'];
                    $_SESSION['rank'] = $row[0]['type_name'];
                    $_SESSION['LOGGED_IN'] = true;
                } else {
                    // Email is not verified
                    $errors[] = "<div class='error text-center'>Email is not verified. Please verify your email first.</div>";
                }
            } else {
                // Email or Password did not match
                $errors[] = "<div class='error text-center'>Email or Password did not match.</div>";
            }
        }

        return $errors;
    }

    //function to connect to db
    function database_run($query, $vars = array())
    {
        $dsn = "pgsql:host=localhost dbname=farm_crops user=postgres password=123";

        try {
            $pdo = new PDO($dsn);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stm = $pdo->prepare($query);
            $check = $stm->execute($vars);

            if ($check) {
                // Check if it's a SELECT query before attempting to fetch data
                if ($stm->columnCount() > 0) {
                    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                } else {
                    // If it's not a SELECT query, return true for success
                    return true;
                }
            }

            return false;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Function to generate pagination links
    function generatePaginationLinks($total_pages, $current_page, $pageQueryParam)
    {
        echo '<ul class="pagination justify-content-center">';
        for ($page = 1; $page <= $total_pages; $page++) {
            $activeClass = ($current_page == $page) ? 'active' : '';
            echo '<li class="page-item ' . $activeClass . '">';
            echo '<a class="page-link" href="?' . $pageQueryParam . '=' . $page . '">' . $page . '</a>';
            echo '</li>';
        }
        echo '</ul>';
    }

    // Kani pababa wala ata ni silay use wala nako ni gi gamit kay dapat man gud ma access basking dili logged in
    // lahi na akong gi gamit gi js nalang nako. kay kung need ni sya gamitun kailangan ni sya ibutang sa side.php
    // kay maguba ang page kay duwa ang gina call na header unya kung ibutang sa side.php kay dili na ma access ku walay acc.
    // Function for comprehensive user check
    function check_user($redirect = true)
    {
        if (isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])) {
            // User is logged in

            // Check if the user's email is verified
            if (check_verified()) {
                return true;
            } else {
                // Redirect if email is not verified
                if ($redirect) {
                    $_SESSION['message'] = "<div class='error'>Your email is not verified</div>";
                    header("location: ../../login/index.php");
                    die();
                } else {
                    return false;
                }
            }
        }

        // Redirect if not logged in
        if ($redirect) {
            $_SESSION['message'] = "<div class='error'>You are not logged in</div>";
            header("location: ../../login/index.php");
            die();
        } else {
            return false;
        }
    }

    // Function for verifying if the user's email is verified
    function check_verified()
    {
        $user_id = $_SESSION['USER']['user_id'];
        $query = "SELECT email_verified FROM users WHERE user_id = :user_id";
        $result = database_run($query, array(':user_id' => $user_id));

        if ($result && count($result) > 0) {
            $email_verified = $result[0]['email_verified'];

            // Check if the email is verified
            if (!empty($email_verified) && $email_verified == $_SESSION['USER']['email']) {
                return true;
            }
        }

        // Redirect to verification page if not verified
        $_SESSION['message'] = "<div class='error'>Your email is not verified</div>";
        header("location: ../crop/list.php");
        exit();
    }

    function access($rank)
    {
        if (isset($_SESSION['ACCESS']) && !$_SESSION["ACCESS"][$rank]) {
            $_SESSION['message'] = "<div class='text-center'>Access denied</div>";
            header("location: ../crop/list.php");
            die();
        }
    }

    $_SESSION["ACCESS"]["VIEWER"] = isset($_SESSION['rank']) && $_SESSION['rank'] == "viewer";
    $_SESSION["ACCESS"]["ADMIN"] = isset($_SESSION['rank']) && $_SESSION['rank'] == "admin";
    $_SESSION["ACCESS"]["CURATOR"] = isset($_SESSION['rank']) && $_SESSION['rank'] == "curator";
    ?>

    function filterTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            var found = false;
            if (i === 0) {
                tr[i].style.display = "";
                continue; // Skip the header row
            }
            for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
                td = tr[i].getElementsByTagName("td")[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            tr[i].style.display = found ? "" : "none";
        }
    }

    function filterTableBox() {
        var input, filter, rows, i, txtValue;
        input = document.getElementById("searchInputBox");
        filter = input.value.toUpperCase();
        rows = document.getElementsByClassName("filterable-row");

        for (i = 0; i < rows.length; i++) {
            var found = false;
            var cells = rows[i].getElementsByTagName("h4"); // Assuming the text to filter is inside an h4 element

            for (var j = 0; j < cells.length; j++) {
                txtValue = cells[j].textContent || cells[j].innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }

            rows[i].style.display = found ? "" : "none";
        }
    }
</script>