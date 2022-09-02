<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.css" />
<link rel="stylesheet" href="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.dataTables.min.css') ?>" />
<script src="<?php echo base_url(); ?>themes/adminopeo/plugins/datepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/dataTables.buttons.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/jszip.min.js') ?>"></script>
<script src="<?php echo base_url('themes/adminopeo/plugins/datatables/extensions/more/buttons.html5.min.js') ?>"></script>
<style>

  div#table_user_length {
    width: 30%;
    position: absolute;
    left: 8%;
  }

  .autocomplete {
    position: relative;
  }

  .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;
  }

  .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff;
    border-bottom: 1px solid #d4d4d4;
  }

  /*when hovering an item:*/
  .autocomplete-items div:hover {
    background-color: #e9e9e9;
  }

  /*when navigating through the items using the arrow keys:*/
  .autocomplete-active {
    background-color: DodgerBlue !important;
    color: #ffffff;
  }
</style>

<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" id="title_top">
              <h3 class="box-title">Master Nama Merk</h3>
            </div>

            <div class="box-body">
              <div class="col-sm-12" id="div_form_input" hidden>
                <div class="row">
                  <form id="form_merk">

                    <div class="form-group col-md-12" style="padding:0">
                      <div class="col-md-5 mb-3">
                        <label>Nama Produk</label>
                        <div class="autocomplete">
                          <input class="form-control" id="myInput" type="text" name="myCountry" placeholder="Nama Produk">
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <label>Nama Merk : </label>
                        <input type="text" class="form-control" id="nama_merk" name="nama_merk" autocomplete="on" required>
                        <input type="hidden" id="id_merk" name="id_merk">
                      </div>
                      <div class="col-md-4 mb-3">
                        <label>Status : </label>
                        <table>
                          <td class="text-center">
                            <label class="switch" style="margin-right:10px;">
                              <input type="checkbox" onclick="set_on_off(this)" id="toggle_status" checked>
                              <span class="slider round"></span>
                            </label>
                          </td>
                          <td class="text-left" style="text-align: left;vertical-align: center;">
                            <label id="label_status" class="label label-success">
                              <span>Aktif<span>
                              </label>
                            </td>
                            <input type="text" name="status" id="status" value="1" hidden required>
                          </table>
                        </div>
                      </div>

                      <div class="col-sm-12" style="margin-top:10px;">
                        <button type="button" id="tambah_merk" class="btn btn-success" name="button">Tambah</button>
                        <button type="button" class="btn btn-primary" onclick="kembali_input()">Kembali</button>
                      </div>
                  </form>
                </div>
              </div>

              <div id="div_table_output">
                <div class="text-left" style="margin-bottom:10px;">
                  <button type="button" id="tambah_show" class="btn btn-success">Tambah Data</button>
                </div>

                <div class="pull-right" style="margin-bottom:5px;">
                  <div class="input-group input-group-sm" style="width: 300px;">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" value="<?php echo date('d/m/Y')?>" readonly>
                    </div>
                  </div>
                </div>

                <table id="table_master_merk" class="table table-bordered table-striped ">
                  <thead>
                    <tr>
                      <th style="width:5%">No</th>
                      <th>Nama Merk</th>
                      <th>Status</th>
                      <!-- <th>Dibuat Oleh</th> -->
                      <th>Tanggal</th>
                      <th>#</th>
                    </tr>
                  </thead>
                </table>

              </div>

            </div>

          </div>
        </div>
      </div>
    <div>
</div>
</section>

<script type="text/javascript">

  function topFunction() {
    $('html, body').animate({
      scrollTop: $("#title_top").offset().top
    });
  }

  function hide_show_div(key) {
    if (key == 1) {
      $('#div_table_output').hide(250);
      $('#div_form_input').show(250);
      topFunction();
    }else {
      $('#div_form_input').hide(250);
      $('#div_table_output').show(250);
    }
  }

  $('#tambah_show').click(function() {
    hide_show_div(1);
  });

  function kembali_input() {
    bersihkan();
    hide_show_div(2);
  }

  function bersihkan() {
    $('#form_merk').find('input').each(function() {
      $(this).val($(this).data('default'));
      $('#tambah_merk').html('Tambah');
      $("#toggle_status").prop("checked", true);
      fungsi_set_status(1);
    });
  }
  var arrayAutoComplete = [];
  $(document).ready(function() {
    get_data_merk('');

    $.ajax({
      url   : '<?php echo base_url('master_merk/get_produk');?>',
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        for (var i = 0; i < r.length; i++) {
          arrayAutoComplete.push(r[i].master_nama_produk);
        }
      }
    });

  });

 function set_on_off(v) {
   var value = (v.checked == true) ? '1' : '0';
   fungsi_set_status(value);
 }

 function fungsi_set_status(value) {
   $('[name=status]').val(value);
   if (value == 0) {
     $('#label_status').removeClass('label label-success').addClass('label label-default').html('Tidak Aktif');
   }else {
     $('#label_status').removeClass('label label-default').addClass('label label-success').html('Aktif');
   }
 }

  function get_data_merk(tgl){
    if(tgl == ''){
      tgl = '00/00/0000 - 31/12/9999';
    }

    var table_master_merk = $('#table_master_merk').DataTable({
      dom: 'Blfrtip',
      buttons: [
          'excel', 'csv'
      ],
      "lengthMenu": [10, 20, 50, 100, 200, 500, 1000, 5000, 10000],
      "pageLength": 20,
      "processing": true,
      "serverSide": true,
      ajax : {
        url  : '<?php echo base_url('master_merk/get_data_merk');?>',
        type : 'POST',
        data : {
          tgl : tgl
        },
        beforeSend:function() {
          $('#table_master_merk').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_master_merk").LoadingOverlay("hide", true);
        },
      },
      columns: [
        { data: 'no' },
        { data: 'master_nama_merk' },
        { data: 'status' },
        // { data: 'created_by' },
        { data: 'created_on' },
        { data: 'aksi' },
      ],
    });
  }

  $('#datepicker').daterangepicker({
    autoclose: true,
    locale: {
      format: 'DD/MM/YYYY'
    },
    startDate: '<?php echo date('d/m/Y')?>',
    endDate: '<?php echo date('d/m/Y')?>'
  });

  $('#datepicker').change(function () {
    $('#table_master_merk').DataTable().destroy();
    get_data_merk($(this).val());
  });

  $('#tambah_merk').click(function() {
    if ($('#nama_merk').val() == '') {

    }else {
      simpan_merk();
    }
  });

  function simpan_merk() {
    $.ajax({
      url   : '<?php echo base_url('master_merk/simpan');?>',
      data  : {
        'id_merk'   : $('#id_merk').val(),
        'nama_merk' : $('#nama_merk').val(),
        'status'    : $('#status').val(),
      },
      type  : 'POST',
      dataType : 'jSON',
      beforeSend:function() {
        hide_show_div(2);
        $('#table_master_merk').LoadingOverlay("show");
      },
      complete:function() {
        $("#table_master_merk").LoadingOverlay("hide", true);
      },
      success : function (r) {
        if (r.success) {
          $('#table_master_merk').DataTable().ajax.reload( null, false );
          bersihkan();
        }
      }
    });
  }

  function edit_data(id) {
    $.ajax({
      url   : '<?php echo base_url('master_merk/get_data_by');?>',
      data  : {
        'id' : id,
      },
      type  : 'POST',
      dataType : 'jSON',
      success : function (r) {
        hide_show_div(1);
        $('[name=id_merk]').val(r.master_nama_merk_id);
        $('[name=nama_merk]').val(r.master_nama_merk);
        $('#tambah_merk').html('Ubah');
        if (r.status == 1) {
          $("#toggle_status").prop("checked", true);
        }else {
          $("#toggle_status").prop("checked", false);
        };
        fungsi_set_status(r.status);
      }
    });
  }

  function delete_merk(id) {
    var msg = confirm('Apakah anda yakin ? ');
    if (msg) {
      $.ajax({
        url   : '<?php echo base_url('master_merk/delete');?>',
        data  : {
          'id' : id,
        },
        type  : 'POST',
        dataType : 'jSON',
        beforeSend:function() {
          $('#table_master_merk').LoadingOverlay("show");
        },
        complete:function() {
          $("#table_master_merk").LoadingOverlay("hide", true);
        },
        success : function (r) {
          if (r.success) {
            $('#table_master_merk').DataTable().ajax.reload( null, false );
          }
        }
      });
    }
  }
</script>

<script>
function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);
      for (i = 0; i < arr.length; i++) {
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          b = document.createElement("DIV");
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          b.addEventListener("click", function(e) {
              inp.value = this.getElementsByTagName("input")[0].value;
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });

  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) {
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });

  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }

  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

autocomplete(document.getElementById("myInput"), arrayAutoComplete);
</script>
