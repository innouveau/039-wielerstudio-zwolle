<?php
$message = get_dynamic_sidebar('message_box');

function get_dynamic_sidebar($sidebar_id) {
    $sidebar_contents = "";
    ob_start();
    dynamic_sidebar($sidebar_id);
    $sidebar_contents = ob_get_clean();
    return $sidebar_contents;
}

// apparently there are some space on the message even when there is nothing in the widget
// we consider less then 33 characters as an emtpy widget.

if (strlen($message) > 32) {
?>


<div id="message-box">
    <div id="message-box-content">
        <?php echo $message; ?>
    </div>
</div>

<?php
}
?>