 <!-- THIS IS A VIEW FILE  -->

 <!-- THIS IS THE FOR CREATED FOR EDIT  DATA FORM  -->
 <HTML>
 <form action="" method="post" id="showedit" name="showcedit">
     <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
     <div class="modal-body" id="edit">
         <div id="edit">
             <div class="form-group">
                 <label for="name">name</label>
                 <input type="text" name="name" id="name" value="<?php echo $row['name'] ?>" class="form-control" placeholder="Enter Name">
                 <p class="nameerror"></p>
             </div>
             <br>
             <div class="form-group">
                 <label for="email">Email</label>
                 <input type="email" name="email" id="email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter email">
                 <p class="emailrerror"></p>
             </div>
             <br>
             <div class="form-group">
                 <label for="password">Password :</label>
                 <input type="password" name="password" id="password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Enter password">
                 <p class="passworderror"></p>
             </div>

         </div>
     </div>
     <div class="modal-footer">
         <button type="submit" class="btn btn-primary">Save</button>
     </div>
 </form>

 </HTML>