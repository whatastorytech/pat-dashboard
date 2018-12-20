<?php
function get_error($key)
{
    global $arrErrors;
    return isset($arrErrors[$key])? $arrErrors[$key] : '';
}



class FlashMessage
{

    public static function render() {
        if (!isset($_SESSION['messages'])) {
            return null;
        }
        $messages = $_SESSION['messages'];
        unset($_SESSION['messages']);
        return implode('<br/>', $messages);
    }

    public static function add($message) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        }
        $_SESSION['messages'][] = $message;
    }

}


?>