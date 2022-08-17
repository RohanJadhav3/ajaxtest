
<table class=" table table-striped" border="1">
  <div class="col-md-4">
    <tbody id="carlist">
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>image</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>

        <?php if (!empty($rows)) { ?>
          <?php foreach ($rows as $row) { ?>
            <tr>
              <td id="<?php echo $row->id?>" name="<?php echo $row->name ?>"><?php echo $row->id ?></td>

              <td><?php echo $row->name  ?><i id="copybtn" href="javascript:void(0);" onclick="copytoclipboard('#mobile_<?php echo $row->id ?>')" class="btn btn solid-copy" title="click to copy"></i></td>

              <td><?php echo $row->email ?></td>

              <td><img src="<?php echo '/uploads/'.$row->image;?>" alt="" width="180" height="100"></td>

              <td><a href="javascript:void(0);" title="click to edit" onclick="showedit(<?php echo $row->id ?>)" class="btn btn-primary">Edit</a></td>

              <td><a href="javascript:void(0);" title="click to delete" onclick="deletemodal(<?php echo $row->id ?>)" class="btn btn-danger">Delet</a>
            </tr>
          <?php } ?>
        <?php } else { ?>
          <tr>
            <td colspan="8" class="no-records">No Data Found</td>
          </tr>
        <?php } ?>


    </tbody>

</table>
</div>

<div class="box-footer">
  <ul class="pagination">
    <?php echo $pagelinks ?>
  </ul>
</div>