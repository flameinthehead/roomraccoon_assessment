<html>
<head>
    <title>Shopping List</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.edit-link').click(function () {
                var li = $(this).closest('li');
                li.find('.shop-item-info').hide();
                li.find('.edit-form').show();
            });
        });
    </script>
</head>
<body>
    <?php if (isset($validationError)): ?>
        <p style="color: red"><?=$validationError?></p>
    <?php endif; ?>
