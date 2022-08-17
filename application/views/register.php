<!-- THIS IS A VIEW FILE  -->

<!-- THIS IS THE FOR CREATED FOR INSERT DATA FORM  -->

<html>

<body>

    <form action="" method="post" id="insert" name="upload_form" enctype="multipart/form-data">
        <div class="modal-body">
            <div id="regs">
                <div class="form-group">
                    <label for="name">NAME :</label>
                    <input type="text" name="name" id="name" value="" class="form-control" placeholder="Enter Name">
                    <p class="nameerror"></p>
                </div>
                <br>
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
                <div class="form-group">
                    <label for="File">Upload :</label>
                    <p id="msg"></p>
                    <input type="file" id="file" name="file" />
                </div>
            </div>
            <br>

            <button type="submit" class="btn btn-primary" title="click to register">Register</button>
        </div>
    </form>
</body>

</html>