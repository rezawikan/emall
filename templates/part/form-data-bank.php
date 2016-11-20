<div id="sellerID" class="form-group">
  <label for="">Seller ID</label>
  <input type="text" class="form-control" value="<?php echo $id;?>" name="sellerID" >
</div>
<div class="form-group"><label>Bank Name</label>
    <select id="bankID" class="form-control m-b" name="bankID" id="bankID">
        <option value="">Select</option>
    <?php

        $seller->setTable('bank');
        $banks = $seller->select()->all();
        foreach ($banks as $bank) {
    ?>
        <option value="<?php echo $bank->bankID; ?>"><?php echo $bank->bankName; ?></option>
    <?php
        }
    ?>
    </select>
</div>
<div class="form-group">
  <label>Account Number</label>
  <input type="text" placeholder="Account Number" name="accountNumber" class="form-control">
</div>
<div class="form-group">
  <label>Owner Name</label>
  <input type="text" placeholder="Owner Name" name="ownerName" class="form-control">
</div>
<div class="form-group">
  <label>Branch</label>
  <input type="text" placeholder="Branch" name="branch" class="form-control">
</div>
