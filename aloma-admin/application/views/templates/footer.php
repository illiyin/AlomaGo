        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Aloma Go - develope by <a href="http://illiyin.co" target="_blank">illiyin.co</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?= resources_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= resources_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?= resources_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?= resources_url(); ?>vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?= resources_url(); ?>vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="<?= resources_url(); ?>vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="<?= resources_url(); ?>vendors/Flot/jquery.flot.js"></script>
    <script src="<?= resources_url(); ?>vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?= resources_url(); ?>vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?= resources_url(); ?>vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?= resources_url(); ?>vendors/Flot/jquery.flot.resize.js"></script>
     <!-- bootstrap-wysiwyg -->
    <script src="<?= resources_url(); ?>vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="<?= resources_url(); ?>vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="<?= resources_url(); ?>vendors/google-code-prettify/src/prettify.js"></script>
    <!-- Flot plugins -->
    <script src="<?= resources_url(); ?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?= resources_url(); ?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?= resources_url(); ?>vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?= resources_url(); ?>vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?= resources_url(); ?>vendors/moment/min/moment.min.js"></script>
    <script src="<?= resources_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?= resources_url(); ?>build/js/custom.min.js"></script>

    <!-- SweetAlert -->
    <script type="text/javascript" src="<?= resources_url(); ?>build/js/sweetalert.min.js"></script>

    <script type="text/javascript">
    $(function(){
        $('#saveBtn').click(function () {
            var mysave = $('#editor-one').html();
            $('#textarea').val(mysave);
        }); 
        $('#addImage').click(function(){
            var addControl = '<input type="file" name="imageUpload[]" size="20" multiple required/>';
            $('#display').before(addControl);
        });
         // $("#imagePreview").hide();
    });
    function deleteTransaksi(id) {
        swal({
            title: "Hapus transaksi?",
            text: "Transaksi ini akan dihapus. Jika setuju, klik Ok",
            type: "warning",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ok",
            closeOnConfirm: false,
            closeButtonText: "Batalkan",
            showLoaderOnConfirm: true
        },
        function(){
            $.ajax({
                url: '<?php echo admin_url();?>do_action?method=deleteHistory',
                data: { id: id },
                type: 'POST',
                dataType: 'json',
                beforeSend: function() { },
                success: function(response) {
                    if(response.is_ok) {
                        location.reload();
                    } else{
                        swal("Critical Error", "Error response from server", "error");
                    }
                },
                error: function(jqXhr, message, errorThrown){
                console.log('Request error!', message);
                console.log('Test', jqXhr);
                }
            })
            swal.close();
        });
    }

    function deleteKabarBurung(id) {
        swal({
            title: "Hapus kabar burung?",
            text: "Kabar burung ini akan dihapus. Jika setuju, klik Ok",
            type: "warning",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ok",
            closeOnConfirm: false,
            closeButtonText: "Batalkan",
            showLoaderOnConfirm: true
        },
        function(){
            $.ajax({
                url: '<?php echo admin_url();?>do_action?method=deleteKabarBurung',
                data: { id: id },
                type: 'POST',
                dataType: 'json',
                beforeSend: function() { },
                success: function(response) {
                    if(response.is_ok) {
                        location.reload();
                    } else{
                        swal("Critical Error", "Error response from server", "error");
                    }
                },
                error: function(jqXhr, message, errorThrown){
                console.log('Request error!', message);
                console.log('Test', jqXhr);
                }
            })
            swal.close();
        });
    }

    function numericOnly(e) {
        var charCode = (e.which) ? e.which : event.keyCode
        return charCode > 31 && (charCode < 48 || charCode > 57) ? false : true;
    }
    
    function readURL(input , tags) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#' + tags).attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // $("#gambarUtama").change(function(){
    //     readURL(this , 'imagePreview');
    //     $("#imagePreview").show();
    // });

    // $("#btnUpload").click(function(){
    //     $("#imgUpload").trigger('click');
    // });

    // $("#imgUpload").change(function(){
    //     readURL(this, 'imgPreview');
    //      $("#imgPreview").show();
    // });

    <?php if($this->uri->segment(2) == 'kabarburung' && $this->input->get('method') == 'edit'): ?>
        //setup before functions
        var typingTimer;                //timer identifier
        var doneTypingInterval = 1000;  //time in ms, 5 second for example
        var $judul = $('#judul');
        var $author = $("#author");
        var $id = $("#id");
        //on keyup, start the countdown
        $judul.on('keyup', function () {
          clearTimeout(typingTimer);
          typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

        //on keydown, clear the countdown 
        $judul.on('keydown', function () {
          clearTimeout(typingTimer);
        });

        //user is "finished typing," do something
        function doneTyping () {
            $.ajax({
                url: '<?php echo admin_url();?>do_action?method=updateBerita',
                data: { id: $id.val(), title: $judul.val(), author: $author.val() },
                type: 'POST',
                dataType: 'json',
                beforeSend: function() { },
                success: function(response) {
                    if(!response.is_ok) {
                        swal("Critical Error", "Error response from server", "error");
                    }
                },
                error: function(jqXhr, message, errorThrown){
                console.log('Request error!', message);
                console.log('Test', jqXhr);
                }
            })
        }

       function changeImage(input, elm) {
            var $id = $("#id");
            var $imageId = $("#imageId" + elm);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                console.log(input.files);
                reader.onload = function (e) {
                    // e.preventDefault();
                    $('#imagePreview' + elm).attr('src', e.target.result);
                    $.ajax({
                        url: '<?php echo admin_url();?>do_action?method=updateGambar',
                        data: { id: $id.val() , imageId: $imageId.val() , file: e.target.result },
                        type: 'POST',
                        beforeSend: function() { },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(jqXhr, message, errorThrown){
                            console.log('Request error!', message);
                            console.log('Test', jqXhr);
                        }
                    })
                }
                
                reader.readAsDataURL(input.files[0]);
            }
       }

       function addImage(e) {
        console.log(e);
       }

       function deleteImage(idGambar) {
            var $id = $("#id");
            swal({
                title: "Hapus gambar?",
                text: "Gambar ini akan dihapus. Jika setuju, klik Ok",
                type: "warning",
                html: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ok",
                closeOnConfirm: false,
                closeButtonText: "Batalkan",
                showLoaderOnConfirm: true
            },
            function(){
                $.ajax({
                    url: '<?php echo admin_url();?>do_action?method=deleteGambar',
                    data: { id: $id.val(), idGambar: idGambar },
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function() { },
                    success: function(response) {
                        if(!response.is_ok) swal("Critical Error", "Error response from server", "error");
                        else location.reload();
                    },
                    error: function(jqXhr, message, errorThrown){
                    console.log('Request error!', message);
                    console.log('Test', jqXhr);
                    }
                })
                swal.close();
            });
       }
    <?php endif; ?>
    </script>
  </body>
</html>