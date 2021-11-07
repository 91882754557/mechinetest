
<?php
$connect = mysqli_connect("localhost" , "root" , "" , "organization");
$result = mysqli_query($connect,"SELECT * FROM employee");
if(isset($_POST["submit"]))
{
    if($_FILES['file']['name'])
    {
        $filename = explode(" . ", $_FILES['file']['name']); 
        //if file extension is CSV 
        if($filename[1] == 'csv')
        {
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            $error = false;
            while (!feof($handler))
            {
                fgets($handler,$linetocheck);
                $cols = explode (chr(5), $linetocheck); 
                if (count($cols)>$max_cols)
                {
                $error=true;
                break;
                }
                elseif (($fp = fopen("test.csv", "r")) !== FALSE) 
                    { 
                        while (($record = fgetcsv($fp)) !== FALSE) 
                        {
                            $row++;
                        }
                        echo "File contains invalid rows and columns";
                    }
            }
            if (!$error){
                while($data = fgetcsv($handle))
                {
                    $item = mysqli_real_escape_string($connect, $data[0]);
                    $item1 = mysqli_connect_escape_string($connect, $data[1]);
                    $item2 = mysqli_connect_escape_string($connect, $data[2]);
                    $item3 = mysqli_connect_escape_string($connect, $data[3]);
                    $item4 = mysqli_connect_escape_string($connect, $data[4]);
                    $sql =  "INSERT into employee(employee_code, employee_name, department, age, experience) values('$item', '$item1', '$item2', '$item3', '$item4')";
                    $mysqli_query($connect, $sql);
                } 
             }
            fclose($handle);
            print "File Uploaded successfully";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Employee Details | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <style>
    .form{
        margin-top: 10%;
        border: 1px solid #efefef;
        padding: 1%;
    }
    .inputype{
        border: 4px solid #eee;
        padding: 4%;
    }
    .background{
        background-color: #dfdfdf;
        padding: 1%;
        }
</style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                
                <div class="container-fluid px-4">
                    <div class="container">
                        <div class="col-md-12 form">
                            <form class="form-inline background" enctype='multipart/form-data'>
                                <div class="form-group mb-2">
                                    <p>Upload CSV :  <input  class="inputype"  type='file' name='file' /></p>
                                </div>
                                <input type='submit' name='submit' value='Submit' style="margin-left:5%;" />
                            </form>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                ?>
                                <table>
                                <tr>
                                    <td>First Name</td>
                                    <td>Last Name</td>
                                    <td>City</td>
                                    <td>Email id</td>
                                </tr>
                                <?php
                                $i=0;
                                while($row = mysqli_fetch_array($result)) {
                                    ?>
                                <tr>
                                    <td><?php echo $row["first_name"]; ?></td>
                                    <td><?php echo $row["last_name"]; ?></td>
                                    <td><?php echo $row["city_name"]; ?></td>
                                    <td><?php echo $row["email"]; ?></td></tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </table>
                                <?php
                                }
                                else{
                                    echo "No result found";
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>