<footer class="footer pt-5">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
            </div>
            <div class="col-lg-12">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                            target="_blank">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                            target="_blank">Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                            target="_blank">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                            target="_blank">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="assets/js/core/bootstrap.bundle.min.js"></script>
<script src="assets/js/perfect-scrollbar.min.js"></script>
<script src="assets/js/smooth-scrollbar.min.js"></script>
<script src="assets/js/chartjs.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
 <!-- <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script> -->

<script src="../node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script type="" src="ckfinder/ckfinder.js"></script>

<script>
     
    ClassicEditor.create(document.querySelector('#des'), {
                ckfinder: {
                    // Upload the images to the server using the CKFinder QuickUpload command.
                    uploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
         
                    // Define the CKFinder configuration (if necessary).
                    options: {
                        resourceType: 'Images'
                    }
                },
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'underline',
                        'strikethrough',
                        'subscript',
                        'superscript',
                        'alignment',
                        '|',
                        'fontFamily',
                        'fontSize',
                        'fontColor',
                        'fontBackgroundColor',
                        'highlight',
                        '|',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'link',
                        'imageInsert',
                        'imageUpload',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'code',
                        'specialCharacters',
                        '|',
                        'undo',
                        'redo',
                        '|',
                        'CKFinder'
                    ],
                    shouldNotGroupWhenFull: true,
                },
                language: 'en',
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:full',
                        'imageStyle:side',
                        'linkImage'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells',
                        'tableCellProperties',
                        'tableProperties'
                    ]
                },
                licenseKey: '',
         
         
            })
            .then(editor => {
                window.editor = editor;
         
                CKFinder.setupCKEditor(editor);
                console.log( Array.from( editor.ui.componentFactory.names() ) );
            })
            .catch(error => {
              
                console.error(error);
            });
 </script>


<script>
    <?php if (isset($_SESSION['alert'])) { ?>
        // Hiển thị thông báo khi thêm thành công
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?= $_SESSION['alert']; ?>');
        <?php
        unset($_SESSION['alert']);
    } ?>
</script>
<script>
$(document).ready(function(){
    getDateValue();
    function getDateValue() {
        var startDate = document.getElementById("start-date").value;
        var endDate = document.getElementById("end-date").value;
        console.log(startDate);
        // Gửi dữ liệu ngày bắt đầu và ngày kết thúc lên máy chủ bằng AJAX
        $.ajax({
            url: "../classes/thongke.php",
            method: "POST",
            data: { startDate: startDate, endDate: endDate },
            success: function(data) {
                $('.data_thongke').html(data);
            }
        });
    }

    $('.btn-primary').click(function() {
        getDateValue();
    });
});

</script>
</body>

</html>