<?php include_once 'header.php'; ?>
    <?=(is_array($renderData) && isset($renderData['message']) ? $renderData['message'] : 'Unknown error'); ?><br />
    <a href="/list">Move back</a>
<?php include_once 'footer.php'; ?>