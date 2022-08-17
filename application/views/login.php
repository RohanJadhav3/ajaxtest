<!-- THIS IS A VIEW FILE  -->

<!-- THIS IS THE FOR CREATED FOR INSERT DATA FORM  -->

<html>



<body>
    <form action="" method="post" id="login" name="login">
        <div class="modal-body">
            <div id="regs">
                <div class="form-group">
                    <label for="email">EMAIL :</label>
                    <input type="email" name="email" id="email" value="" class="form-control" placeholder="Enter Email">
                    <p class="emailerror"></p>

                </div>
                <br>
                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" value="" class="form-control" placeholder="Enter password">
                    <p class="passworderror"></p>

                </div>
                <br>

                <input type="button" name="submit" onclick="savelogin();" class="btn btn-primary" value="submit">

            </div>
            <div id='err_msg' style='display: none'>
                <div id='content_result'>
                    <div id='err_show' class="w3-text-red">
                        <div id='msg'> </div></label>
                    </div>
                </div>
            </div>

    </form>



</body>

</html>