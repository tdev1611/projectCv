<script src="https://cdn.tiny.cloud/1/ycev3jqs96174pjltcois4npv3ucaz0uolrs5l7ra90v05qe/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#content',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount image code preview',
        toolbar: 'undo redo | blocks fontfamily fontsize | preview| bold italic underline strikethrough | link image media table | code | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function() {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        },
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'

    });
</script>
