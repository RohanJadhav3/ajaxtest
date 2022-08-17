<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        body {
            background: url(https://w.wallhaven.cc/full/49/wallhaven-49pyed.jpg);
        }
    </style>


</head>
<body>
<h1  align=center style="color: red;">Dashboard</h1>

<button href="javascript:void(0);" onclick="dologout();" class="btn btn-primary">Log out</button>


    
<?php echo $this->session->userdata('name');?> </h1>

<script>
    
    function dologout() {

        window.location.href='<?php echo base_url().'home/logout'?>';

            
        }
</script>
</body>
</html>
