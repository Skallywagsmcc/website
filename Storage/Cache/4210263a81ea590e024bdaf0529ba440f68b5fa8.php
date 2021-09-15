

<?php $__env->startSection("title"); ?>
    Admin panel : Update  Event
<?php $__env->stopSection(); ?>



<?php $__env->startSection("content"); ?>

    <div class="container my-2">
        <div class="row box">
            <div class="col-sm-12">
                <?php if(isset($message)): ?>
                    <?php echo e($message); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="container my-2">
        <div class="row">
            <div class="col-sm-12 text-center  text-md-left pl-md-1"><a href="<?php echo e($url->make("auth.admin.events.home")); ?>">Back
                    to Events Home</a></div>
        </div>
    </div>





    <form action="<?php echo e($url->make("auth.admin.events.update")); ?>" method="post" class="tld-form" enctype="multipart/form-data">
        <?php echo e(csrf()); ?>



        <div class="container my-2">

            <div class="row box my-2">
                <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Edit Event : <?php echo e($event->title); ?></div>
            </div>
            <div class="row box">
                <div class="col-sm-12 d-flex justify-content-center">
                    <div class="h-25 w-25">
                        <img src="/img/uploads/<?php echo e($event->image->name); ?>" class="img-fluid"
                             alt="<?php echo e($event->image->title); ?>">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="file_box">
                        <input type="file" class="file d-none" name="upload">
                        <div class="file_value"></div>
                        <input type="checkbox" id="update_thumb" class="d-none" name="update_thumb" value="1">
                        <a href="#" class="addfile">Update Thumbnail</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container block">
            <div class="row box my-2">
                <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Welcome to the Event Editor</div>
                <div class="col-sm-12 text-center">Welcome to the Event Editor Please use the following Links to
                    navigate to the next and previous section do not refresh as your content will not be saved
                </div>
            </div>

            <div class="row box my-2">
                <div class="col-sm-12 col-md-6 py-2 prevbtn text-center text-md-left pl-md-1"><a href="#" class="py-2">Previous</a>
                </div>
                <div class="col-sm-12 col-md-6 py-2 nextbtn text-center text-md-right pr-md-1"><a href="#" class="py-2">next</a>
                </div>
            </div>
        </div>

        <div class="container  block">
            <div class="row box">
                <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Update Event Title</div>
            </div>
            <div class="row box px-0">
                <div class="col-sm-12 p-2">
                    <input type="text" value="<?php echo e($event->id); ?>" name="id">
                    <div class="form-group">
                        <label for="title">Event Title</label>
                        <input type="text" class="form-control tld-input" name="title"
                               placeholder="Event Title" value="<?php echo e($event->title); ?>">
                    </div>

                    <div class="form-group">
                        <label for="content">About the event</label>
                        <textarea class="form-control tld-input" rows="10" placeholder="About the event"
                                  name="content"><?php echo e($event->content); ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row box my-2">
                <div class="col-sm-12 col-md-6 py-2 prevbtn text-center text-md-left pl-md-1"><a href="#" class="py-2">Previous</a></div>
                <div class="col-sm-12 col-md-6 py-2 nextbtn text-center text-md-right pr-md-1"><a href="#" class="py-2">next</a></div>
            </div>
        </div>


            <div class="container my-2 px-0 block">
                <div class="row box px-0 my-2">
                    <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Update start and end time and
                        date
                    </div>
                </div>
                <div class="row box px-0">
                    <div class="col-sm 12 p-2">
                        <div class="my-2">
                            Change Event Start Date and time : <input type="checkbox" class="toggle_check" name="ms"
                                                                      value="1">
                            <hr class="bg-light">
                            <div class="toggled_content">
                                <div class="form-group">
                                    <label for="start">Event Start time</label>
                                    <input type="datetime-local" class="form-control tld-input" name="start"
                                           value="<?php echo e($event->start); ?>">
                                </div>
                            </div>
                        </div>
                        <div class=we my-2>
                            Change Event End Date and time : <input type="checkbox" class="toggle_check" name="me"
                                                                    value="1">
                            <hr class="bg-light">
                            <div class="toggled_content">
                                <div class="form-group">
                                    <label for="end">Event end time</label>
                                    <input type="datetime-local" class="form-control tld-input" name="end"
                                           value="<?php echo e($event->end); ?>">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="row box my-2">
                    <div class="col-sm-12 col-md-6 py-2 prevbtn text-center text-md-left pl-md-1"><a href="#" class="py-2">Previous</a></div>
                    <div class="col-sm-12 col-md-6 py-2 nextbtn text-center text-md-right pr-md-1"><a href="#" class="py-2">next</a></div>
                </div>
            </div>


            <div class="container my-2 px-0 block">
                <div class="row box px-0 my-2">
                    <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Update Start Location Details
                    </div>
                </div>
                <div class="row box px-0">
                    <div class="col-sm-12 p-2">
                        <div class="form-group">
                            <label for="name">Building Name or number</label>
                            <input type="text" name="esl_name" class="form-control tld-input"
                                   value="<?php echo e($esl[0]); ?>">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="street">Street name</label>
                                <input type="text" name="esl_street" class="form-control tld-input"
                                       value="<?php echo e($esl[1]); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">City</label>
                                <input type="text" name="esl_city" class="form-control tld-input" t
                                       value="<?php echo e($esl[2]); ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="county">County</label>
                                <input type="text" name="esl_county" class="form-control tld-input"" value="<?php echo e($esl[3]); ?>

                                ">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="postcode">Postcode</label>
                                <input type="text" name="esl_postcode" class="form-control tld-input""
                                value="<?php echo e($esl[4]); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row box my-2">
                    <div class="col-sm-12 col-md-6 py-2 prevbtn text-center text-md-left pl-md-1"><a href="#" class="py-2">Previous</a></div>
                    <div class="col-sm-12 col-md-6 py-2 nextbtn text-center text-md-right pr-md-1"><a href="#" class="py-2">next</a></div>
                </div>
            </div>


            <div class="container my-2 px-0 block">
                <div class="row box px-0 my-2">
                    <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Update End Location Details
                    </div>
                </div>
                <div class="row box px-0">
                    <div class="col-sm-12 p-2">
                        <div class="form-group">
                            <label for="name">Building Name or number</label>
                            <input type="text" name="eel_name" class="form-control tld-input"
                                   value="<?php echo e($esl[0]); ?>">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="street">Street name</label>
                                <input type="text" name="eel_street" class="form-control tld-input"
                                       value="<?php echo e($eel[1]); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">City</label>
                                <input type="text" name="eel_city" class="form-control tld-input" t
                                       value="<?php echo e($eel[2]); ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="county">County</label>
                                <input type="text" name="eel_county" class="form-control tld-input""
                                value="<?php echo e($eel[3]); ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="postcode">Postcode</label>
                                <input type="text" name="eel_postcode" class="form-control tld-input""
                                value="<?php echo e($eel[4]); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row box my-2">
                    <div class="col-sm-12 col-md-6 py-2 prevbtn text-center text-md-left pl-md-1"><a href="#" class="py-2">Previous</a></div>
                    <div class="col-sm-12 col-md-6 py-2 nextbtn text-center text-md-right pr-md-1"><a href="#" class="py-2">next</a></div>
                </div>
            </div>

            <div class="container my-2 block">
                <div class="row box my-2">
                    <div class="col-sm-12 head py-2 text-center text-md-left pl-md-1">Update Google Maps Link
                    </div>
                </div>
                <div class="row box">
                    <div class="col-sm-12"><input type="text" name="map_url" value="<?php echo e($event->map_url); ?>"></div>
                </div>

                <div class="row box my-2">
                    <div class="col-sm-12 col-md-6 py-2 prevbtn text-center text-md-left pl-md-1"><a href="#" class="py-2">Previous</a></div>
                    <div class="col-sm-12 col-md-6 py-2 nextbtn text-center text-md-right pr-md-1"><a href="#" class="py-2">next</a></div>
                </div>
            </div>

            <div class="container my-2 px-0">
                <div class="row box px-0">
                    <div class="col-sm-12 p-2">
                        <button class="btn tld-button btn-block">Update Event</button>
                    </div>
                </div>
            </div>


    </form>

    <script>
        $("document").ready()
        {

            // $(".file").hide()
            $(".addfile").click(
                function () {
                    var Filebox = $(this).parents(".file_box");
                    $(this).hide();
                    Filebox.children(".file_value").text("File Currently being Chosen")
                    Filebox.children(".file").click();
                    $("#update_thumb").prop("checked", true);
                    Filebox.children(".cancelfile").show();
                    $(".file").on("change", function () {



                        $(".file_value").text("Currently Chosen :" + $('.file').val().split('\\').pop())
                        Filebox.append('<a href="#" class="cancelfile">Cancel File Upload</a>')
                    })
                    return false
                })

            $("body").on("click", ".cancelfile", function () {
                var Filebox = $(this).parents(".file_box");
                Filebox.children("#update_thumb").prop("checked", false);
                if (Filebox.children("#update_thumb").prop("checked") == false) {
                    Filebox.children(".file").val("");
                    Filebox.children(".file_value").text("");
                    Filebox.children(".addfile").show();
                    Filebox.children(".cancelfile").remove();
                }
            })

        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Layouts.backend", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/public_html/Views/Pages/Backend/Events/edit.blade.php ENDPATH**/ ?>