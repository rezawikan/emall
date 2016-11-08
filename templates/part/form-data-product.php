<form role="form" id="form-data-add-product" method="POST">
  <div class="form-group">
    <label>Select Multiple Images</label>
     <input type="file" name="uploadedFiles" class="form-control" multiple>
  </div>
  <div class="form-group">
    <label>Categories</label>
    <select class="form-control m-b" name="categories">
    </select>
  </div>
  <div id="subcategories" class="form-group">
    <label>Sub Categories</label>
    <select class="form-control m-b" name="subcategories">
    </select>
  </div>
  <div class="form-group">
    <label>Product Name</label>
    <input type="text" placeholder="Product Name" name="productName" class="form-control">
  </div>
  <div class="form-group">
    <label>Description</label>
    <textarea rows="10" placeholder="Description" name="description" class="form-control"></textarea>
    <p class="help-block pull-right">Support with <a href="#">markdown</a></p>
  </div>
  <div class="form-group">
    <label>Price</label>
    <input type="text" placeholder="Price" name="price" class="form-control">
  </div>
  <div class="form-group">
    <label>Weight</label>
    <input type="number" placeholder="Weight" name="weight" class="form-control">
  </div>
  <div class="form-group">
    <label>Quantity</label>
    <input type="number" placeholder="Quantity" name="quantity" class="form-control">
  </div>
  <button class="btn btn-sm btn-primary ladda-button" data-style="expand-right" type="submit" name="btn-add-product">OK</button>
  <button id="cancel-btn-add-product" class="btn btn-sm btn-primary " type="submit">Cancel</button>
</form>
