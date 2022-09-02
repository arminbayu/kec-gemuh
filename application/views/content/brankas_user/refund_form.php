<div>
  <div class="modal-header">
    <h5 class="modal-title">Form Refund</h5>
  </div>
  <div class="modal-body">
    <form class="form-refund">
      <div class="form-group">
        <label class="control-label">Refund Ke *</label>
        <select class="form-control" name="jenis_refund" required>
          <option value="">- Pilih Refund Ke -</option>
          <option value="T02">OpeoPay</option>
          <option value="T01">Saldo Penghasilan</option>
        </select>
      </div>
      <div class="form-group">
        <label class="control-label">Nominal Refund *</label>
        <input type="text" name="nominal" class="form-control" onkeypress="return isNumber(event)" required>
      </div>
      <div class="form-group">
        <label class="control-label">Referensi Kode Transaksi</label>
        <input type="text" name="kode_transaksi" class="form-control">
      </div>
      <div class="form-group">
        <label class="control-label">Password *</label>
        <input type="text" name="password" class="form-control" required>
      </div>
      <input type="hidden" name="user_id" value="<?php echo $user->created_by ?>">
    </form>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary btn-submit" onclick="_submit()">Submit</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  </div>
</div>

<script type="text/javascript">
function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
  }
  return true;
}

function _submit() {
  var form = $('.form-refund');
  if (form[0].checkValidity() === false) {
    event.preventDefault()
    event.stopPropagation()
    alert('Bidang bertanda bintang belum lengkap');
  }else {
    var _confirm = confirm("Anda yakin akan melakukan Topup?");
    if (_confirm == true) {
      $('.btn-submit').attr('disabled', true);
      $.ajax({
        url : '<?php echo base_url('brankas_user/proses_refund') ?>',
        type : 'POST',
        dataType : 'jSON',
        data : form.serialize(),
        success : function (r) {
          if (r.success) {
            alert('Topup berhasil dilakukan');
            location.reload();
          }else {
            $('.btn-submit').attr('disabled', false);
            alert((r.why) ? r.why : 'Topup gagal dilakukan, mohon ulangi kembali');
          }
        }
      });
    }
  }
}
</script>
