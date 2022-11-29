<?php  $data = session()->get();
// print_r($data);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/dist/mdb5/standard/core.min.css"> -->
    <!-- <link rel='stylesheet' id='roboto-subset.css-css' href='https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5' type='text/css' media='all' /> -->
    <link rel="shortcut icon" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/favicon.ico" />

    <!-- <link rel="canonical" href="https://mdbootstrap.com/docs/standard/extended/registration/" /> -->

    <!-- Custom styles for this template -->
    <!-- <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet"> -->
</head>

<body>

    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h6>Welcome <?php  echo $data['firstname'] . ' ' . $data['lastname']  ?>  | <a href="/logout">Logout</a></h6>
                </div>
            </div>
            <h2>User Data</h2> <a href="<?php echo base_url() ?>/exportuserdata">Excell Export</a>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usersdata as $key=>$val){ ?>
                    <tr>
                        
                        <th scope="row">1</th>
                        <td><?php echo $val['firstname']?></td>
                        <td><?php echo $val['lastname']?></td>
                        <td><?php echo $val['email']?></td>
                        <td><?php echo $val['phone']?></td>
                        <td><a href="/editUser/<?php echo $val['id']?>">Edit</a> | <a onclick="return confirm('Did you want to delete')" href="/deleteUser/<?php echo $val['id']?>">Delete</a>
                        | <a href="/upload/<?php echo $val['id']?>">Upload Image</a>
                    </td>
                    </tr>
                    <?php  } ?>
                   
                </tbody>
            </table>
        </div>

    </main>



</body>

</html>