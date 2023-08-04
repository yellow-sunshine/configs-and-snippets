<?php
function unserializeData($data)
{
    $data = preg_replace_callback(
        '!s:(\d+):"(.*?)";!',
        function ($matches) {
            return 's:' . strlen($matches[2]) . ':"' . $matches[2] . '";';
        },
        $data
    );
    return unserialize($data);
}
?>
