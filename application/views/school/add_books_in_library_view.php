<form action="<?php echo base_url('School/add_books_in_library_process'); ?>" class="form-horizontal" method="post">
  <input type="hidden" name="school_id" value="<?php echo $school_id; ?>">


<div class="row" style="margin-top: 25px;">
  <!-- col-md-offset-1 -->
    <div class="col-md-12">
      <div class="form-group" >
      <label class="control-label col-sm-4" for="book_type_id">BookS Type:</label>
      <div class="col-sm-6">
         <select class="form-control select2" id="book_type_id" name="book_type_id" style="width: 100%;">
            <option>Select Book Type</option>
            <?php foreach ($book_types as $book_type) : ?>
              <option value="<?php echo $book_type->bookTypeId; ?>"><?php echo $book_type->bookType; ?></option>
            <?php endforeach; ?>
         </select>
      </div>
    </div>
    <div class="form-group">
       <label class="control-label col-sm-4" for="numberOfBooks">Number of Books</label>
       <div class="col-sm-6">
        <input type="text" name="numberOfBooks" class="form-control" id="numberOfBooks">
       </div>
        </div>
        <br>
        <div class="clearfix"></div>
       <div class="form-group">
          <label class="col-sm-2 pull-right">
          <button type="submit" class="btn btn-sm add-row btn-primary btn-flat" >Add Book</button>
          </label>
       </div>
    </div>
</div>
</form>