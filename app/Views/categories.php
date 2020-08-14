<html>
<head>
    <title>Categories</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        .box {
            width: 100%;
            max-width: 650px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="container box">
    <br/>
    <br/>
    <h3 align="center">Categories & SubCategories</h3>
    <br/>

    <div class="alert print-error-msg" style="display:none"></div>
    <div class="form-group">
        <?php echo $categories; ?>
    </div>

    <script>
        $(document).ready(function () {
            $(".form-group").on("change", ".category", function () {
                var parent_category_id = $(this).val();
                if (parent_category_id != '') {
                    $.ajax({
                        url: "<?php echo base_url(); ?>/categories/addSubCategory/" + parent_category_id,
                        method: "POST",
                        success: function (data) {
                            var res = $.parseJSON(data);
                            if ($.isEmptyObject(res.output)) {
                                $(".print-error-msg").removeClass('alert-success').addClass('alert-danger').css('display', 'block');
                            } else {
                                $(".print-error-msg").removeClass('alert-danger').addClass('alert-success');
                                $(".category:last").after(res.output);
                            }
                            $(".print-error-msg").html(res.message);
                        }
                    });
                } else {
                    $(".print-error-msg").addClass('alert-danger').css('display', 'block');
                    $(".print-error-msg").html('An error occurred while adding subcategories');
                }
            });
        });
    </script>
</body>
</html>