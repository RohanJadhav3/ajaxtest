<!-- THIS IS A VIEW FILE  -->
<?php include('header.php'); ?>

<!DOCTYPE html>
<html>
<!-- THIS IS A HEAD WHERRE  ALL CSS AND JS FILES ARE INCLUDED  -->

<head>

    <title>Register Form</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

    
    <style>
        .header {
            width: 100%;
            
            background-color: rgb(72, 0, 139);
        }

        .heading {
            color: rgb(0, 0, 0);
            padding: 10px 0;

        }

        .text {
            background-color: rebeccapurple;
            color: white;
            width: 600px;
            height: 80px;
            border: 3px solid #000;
        }


        body {

            background: url(https://w.wallhaven.cc/full/k9/wallhaven-k9vygm.png);
            background-position-x: center;
            background-size: 1350px;
            margin: auto;

        }
    </style>

</head>

<body>

    <div class="header">
        <div class="container">
            <h3 class="heading">HOME</h3>
        </div>
    </div>
    <div class="container">
        <div class="text">
            <p class="para"> In This Web Application Making We Learned About Insert, Edit , Update , Delete , Fetch-Data , Pagination , Search , Send-Email , Upload-Files
                Using Ajax Fnction Of JQuery In PHP Codeigniter 3</p>

        </div>

        <!--MODEL FOR CREATE  LIST FORM -->
        <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Register form</h5>
                        <button type="button" id="move" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="regs">

                    </div>
                </div>

            </div>
        </div>

        <!-- MODEL FOR LSIT DATA  FORM -->

        <div class="modal fade" id="listd" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModal">LIST</h3>
                        <br>
                        <div class="search-field">
                            <input type="text" class="form-control" name="search_key" id="search_key" placeholder="Search by product name">
                        </div>
                        <div class="search-button">
                            <button type="button" id="searchBtn" class="btn btn-info">Search</button>
                            <button type="button" id="resetBtn" class="btn btn-warning">Reset</button>
                        </div>
                        <button type="button" id="go" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="lists">

                    </div>
                </div>

            </div>
        </div>

        <!-- MODAL FOR SHOWING SUCCESS AND DANGER MESSAGES FOR INSERT AND UPDATE AND DELETE-->
        <div class="modal fade" id="ajaxresponce" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Label">Aleart</h5>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- MODAL FOR EDIT  CAR LIST FORM -->
        <div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" title="click to edit">Edit</h5>
                        <button type="button" id="hidebtn" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="edit">

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL FOR CONFIRM DELETE MESSAGE -->
    <div class="modal fade" id="deleterecord" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="dlt" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="deletenow();">yes</button>
                </div>

            </div>
        </div>
    </div>
    </div>

    <!-- MODAL FOR Login FORM -->
    <div class="modal fade" id="loginuser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" title="click to edit">Log in </h5>
                    <button type="button" id="hideit" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="login">

                </div>
            </div>

        </div>
    </div>
    </div>


    </div>
    <script type="text/javascript">
        function showform() {
            $('#register').modal("show");

            $.ajax({
                url: '<?php echo base_url('home/showregs') ?>',
                type: 'post',
                data: {},
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    $("#regs").html(response["html"]);

                }
            });
        }
        $("body").on("submit", "#insert", function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?php echo base_url('home/savedata') ?>',
                type: 'post',
                mimeType: "multipart/form-data",
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    // console.log(response);

                    if (response['status'] == 0) {
                        if (response["name"] !== "") {
                            $(".nameerror").html(response["name"]).addClass('invalid-feedback d-block');
                            $("#name").addClass('is-invalid');
                        } else {
                            $(".nameerror").html("").removeClass('invalid-feedback d-block');
                            $("#name").removeClass('is-invalid');
                        }
                        if (response["email"] !== "") {
                            $(".emailerror").html(response["email"]).addClass(
                                'invalid-feedback d-block');
                            $("#email").addClass('is-invalid');
                        } else {
                            $(".emailerror").html("").removeClass('invalid-feedback d-block');
                            $("#email").removeClass('is-invalid');
                        }
                        if (response["password"] !== "") {
                            $(".passworderror").html(response["password"]).addClass(
                                'invalid-feedback d-block');
                            $("#password").addClass('is-invalid');
                        } else {
                            $(".passworderror").html("").removeClass('invalid-feedback d-block');
                            $("#password").removeClass('is-invalid');
                        }
                    } else {
                        $("#register").modal("hide");
                        $("#ajaxresponce .modal-body").html(response['message'])
                        $("#ajaxresponce").modal("show");


                        $(".nameerror").html("").removeClass('invalid-feedback d-block');
                        $("#name").removeClass('is-invalid');

                        $(".emailerror").html("").removeClass('invalid-feedback d-block');
                        $("#email").removeClass('is-invalid');

                        $(".passworderror").html("").removeClass('invalid-feedback d-block');
                        $("#password").removeClass('is-invalid');

                        // $("#carlist").append(response['row']);

                    }

                }
            });

        });

        // for show edit form
        function showedit(id) {
            $("#listd").modal("hide");
            $("#edituser").modal("show");



            $.ajax({
                url: '<?php echo base_url() . 'home/getuserdata/' ?>' + id,
                dataType: 'json',
                success: function(data) {
                    $("#edit").html(data.html);
                },
            });
        }

        $("body").on("submit", "#showedit", function(e) {
            e.preventDefault();


            $.ajax({
                url: '<?php echo base_url('home/updatedata') ?>',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    // console.log(response);

                    if (response['status'] == 0) {
                        if (response["name"] !== "") {
                            $(".nameerror").html(response["name"]).addClass('invalid-feedback d-block');
                            $("#name").addClass('is-invalid');
                        } else {
                            $(".nameerror").html("").removeClass('invalid-feedback d-block');
                            $("#name").removeClass('is-invalid');
                        }
                        if (response["email"] !== "") {
                            $(".emailerror").html(response["email"]).addClass(
                                'invalid-feedback d-block');
                            $("#email").addClass('is-invalid');
                        } else {
                            $(".emailerror").html("").removeClass('invalid-feedback d-block');
                            $("#email").removeClass('is-invalid');
                        }
                        if (response["password"] !== "") {
                            $(".passworderror").html(response["password"]).addClass(
                                'invalid-feedback d-block');
                            $("#password").addClass('is-invalid');
                        } else {
                            $(".passworderror").html("").removeClass('invalid-feedback d-block');
                            $("#password").removeClass('is-invalid');
                        }
                    } else {
                        $("#edituser").modal("hide");
                        $("#ajaxresponce .modal-body").html(response['message'])
                        $("#ajaxresponce").modal("show");


                        $(".nameerror").html("").removeClass('invalid-feedback d-block');
                        $("#name").removeClass('is-invalid');

                        $(".emailerror").html("").removeClass('invalid-feedback d-block');
                        $("#email").removeClass('is-invalid');

                        $(".passworderror").html("").removeClass('invalid-feedback d-block');
                        $("#password").removeClass('is-invalid');

                    }

                }
            });
        });

        // THIS IS FOR SELECTING A RECORD TO DELETE WITH ID 
        function deletemodal(id) {
            $("#deleterecord").modal('show');
            $("#deleterecord .modal-body").html("Are You sure You Want To Delete #" + id + "?");
            $("#deleterecord").data("id", id);

            // $('.removerow').removeclass();

        }

        //  THIS IS FOR CALL DELELTE FUCNTION TO DELELTE THE DATA FROM DATABASE
        function deletenow() {
            var id = $("#deleterecord").data('id');

            $.ajax({
                url: '<?php echo base_url('home/deletedata/') ?>' + id,
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    if (response['status'] == 1) {
                        $("#deleterecord").modal('hide');
                        $("#ajaxresponce .modal-body").html(response['msg']);
                        $("#ajaxresponce").modal("show");

                    } else {
                        $("#deleterecord").modal('hide');
                        $("#ajaxresponce .modal-body").html(response['message']);
                        $("#ajaxresponce").modal("show");

                    }


                }


            });
            // setTimeout(() => {
            //     location.reload();
            // }, 2000);

        }

        function getdata() {

            $('#listd').modal("show");



            /*--first time load--*/
            ajaxlist(page_url = false);

            /*-- Search keyword--*/
            $(document).on('click', "#searchBtn", function(event) {
                ajaxlist(page_url = false);
                event.preventDefault();
            });

            /*-- Reset Search--*/
            $(document).on('click', "#resetBtn", function(event) {
                $("#search_key").val('');
                ajaxlist(page_url = false);
                event.preventDefault();
            });

            /*-- Page click --*/
            $(document).on('click', ".pagination li a", function(event) {
                var page_url = $(this).attr('href');
                ajaxlist(page_url);
                event.preventDefault();
            });

            /*-- create function ajaxlist --*/
            function ajaxlist(page_url = false) {
                var search_key = $("#search_key").val();

                var dataString = 'search_key=' + search_key;
                var base_url = '<?php echo site_url('home/showlist') ?>';

                if (page_url == false) {
                    var page_url = base_url;
                }

                $.ajax({
                    type: "POST",
                    url: page_url,
                    data: dataString,
                    success: function(response) {
                        //console.log(response);
                        $("#lists").html(response);
                    }
                });
            }
        }


        // THIS CODE IS USED FOR COPY TEXT TO CLIPBOARD
        function copytoclipboard(element) {

            var temp = $('<input>');
            $('body').append(temp);
            temp.val($(element).attr('name')).select();
            document.execCommand("copy");
            temp.remove();

        }

        function showloginform() {
            $('#loginuser').modal('show');

            $.ajax({
                url: '<?php echo base_url('home/showlogin') ?>',
                type: 'post',
                data: {},
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    $("#login").html(response["html"]);

                }
            })
        }

        function savelogin() {
            var email = $("#email").val();
            var password = $("#password").val();
            var url = '<?php echo base_url('home/check_login') ?>';
            var data = {
                email,
                password
            }

            $.ajax({
                url: url,
                type: 'post',
                data: data,

                success: function(data) {
                    var response = JSON.parse(data);
                    // console.log(response);
                    // console.log(response.status);
                    if (response.status == 0) {
                        if (response.email !== "") {
                            $(".emailerror").html(response.email).addClass(
                                'invalid-feedback d-block');
                            $("#email").addClass('is-invalid');
                        } else {
                            $(".emailerror").html("").removeClass('invalid-feedback d-block');
                            $("#email").removeClass('is-invalid');
                        }
                        if (response.password !== "") {
                            $(".passworderror").html(response.password).addClass(
                                'invalid-feedback d-block');
                            $("#password").addClass('is-invalid');
                        } else {
                            $(".passworderror").html("").removeClass('invalid-feedback d-block');
                            $("#password").removeClass('is-invalid');
                        }

                        $("#ajaxresponce .modal-body").html(response.message);


                    } else {


                        $("#ajaxresponce .modal-body").html(response.message);

                        $(".emailerror").html("").removeClass('invalid-feedback d-block');
                        $("#email").removeClass('is-invalid');

                        $(".passworderror").html("").removeClass('invalid-feedback d-block');
                        $("#password").removeClass('is-invalid');


                        window.location = 'home/welcome';

                    }

                }

            });

        }


        $("body").on("submit", "#insert", function(e) {

            var file_data = $('#file').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '<?php echo base_url('home/upload_file') ?>', // point to server-side controller method
                dataType: 'text', // what to expect back from the server
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(response) {
                    $('#msg').html(response); // display success response from the server
                },
                error: function(response) {
                    $('#msg').html(response); // display error response from the server
                }
            });
        })






        $("#close").click(function() {
            $(".modal-backdrop").remove();
            $("#ajaxresponce").modal("hide");

        });

        $("#go").click(function() {
            $(".modal-backdrop").remove();
            $("#listd").modal("hide");

        });

        $("#move").click(function() {
            $(".modal-backdrop").remove();
            $("#register").modal("hide");

        });

        $("#hideit").click(function() {
            $(".modal-backdrop").remove();
            $("#loginuser").modal("hide");

        });

        $("#hidebtn").click(function() {
            $(".modal-backdrop").remove();
            $("#edituser").modal("hide");

        });


        $("#dlt").click(function() {
            $(".modal-backdrop").remove();
            $("#deleterecord").modal("hide");

        });
    </script>

</body>

</html>