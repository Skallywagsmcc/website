

<?php $__env->startSection("title"); ?>
    Charters
<?php $__env->stopSection(); ?>


<?php $__env->startSection("content"); ?>

    <div class="container">
        <div class="row box">
            <div class="col-sm-12 head">List a new Charter</div>
        </div>
    </div>
    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12">
                <form action="<?php echo e($url->make("auth.admin.charters.store")); ?>" method="post" class="tld-form" enctype="multipart/form-data">
                    <?php echo e(csrf()); ?>

                    <div class="form-group">
                        <label for="title">Charter Name</label>
                        <input type="text" name="title" class="form-control tld-input">
                    </div>
                    <div class="form-group">
                        <label for="content">Information about the charter</label>
                        <div id="editor">
                            <textarea name="content" id="" cols="30" rows="10" class="form-control tld-input"></textarea>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="url">Charter Url</label>
                        <input type="url" name="url" value="" placeholder="url to charter group">
                    </div>

                   Thumbnail Image :  <input type="file" name="thumb">
                    Cover Image : <input type="file" name="cover">

                    <div class="form-group">
                        <button class="btn tld-button btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="text/javascript">
    ClassicEditor
        .create( document.querySelector( '#editor' ),{
            plugins: [Autosave],
            isEnabled: true,
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
        image: {
        toolbar: [ 'imageStyle:block', 'imageStyle:side', '|', 'toggleImageCaption', 'imageTextAlternative' ],
    },
    autosave: {
        save( editor ) {
            // The saveData() function must return a promise
            // which should be resolved when the data is successfully saved.
            return saveData( editor.getData() );
        })
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.Themes.BaseGrey.Admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/Charters/new.blade.php ENDPATH**/ ?>