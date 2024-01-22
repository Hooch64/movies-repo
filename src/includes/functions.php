<?php

/**
 * Get the header
 * @param string $title title of the page
 * @param string $layout layout to use
 * @return void
 */
function get_header(string $title, string $layout = 'public'): void
{
    global $router;
    require_once '../src/views/layouts/' . $layout . '/header.php';
};

/**
 * Get the footer
 * @param string $title title of the page
 * @param string $layout layout to use
 * @return void
 */
function get_footer(string $layout = 'public'): void
{
    require_once '../src/views/layouts/' . $layout . '/footer.php';
};

/**
 * Create the alert
 * @param string $message the message to save in the alert
 * @param string $type the type of alert
 * @return void
 */
function alert(string $message, string $type = 'danger'): void
{
    $_SESSION['alert'] = [
        'message' => $message,
        'type' => $type
    ];
};

/**
 * Display alert session
 * @return void
 */
function displayAlert(): void
{
    if (!empty($_SESSION['alert'])) {
        echo '<div class="alert alert-' . $_SESSION['alert']['type'] . '" role="alert">' . $_SESSION['alert']['message'] . '</div>';
        unset($_SESSION['alert']);
    }
}

function searchByName($name, $search)
{
    $pos = strpos(strtolower($name), strtolower($search));
    if ($pos === false) {
        return false;
    } else {
        return true;
    }
}
