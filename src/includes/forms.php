<?php

/**
 * Check if a field is empty
 * @param string $field
 * @param string $message
 * @return array
 */
function checkEmptyFields($field, $message = 'Veuillez renseigner tous les champs')
{
    $result = ['class' => '', 'message' => ''];
    if (isset($_POST[$field]) && empty($_POST[$field])) {
        $result = [
            'class' => 'is-invalid',
            'message' => '<span class="invalid-feedback">' . $message . '</span>'
        ];
    }
    return $result;
}

/**
 * Get value back if edit is needed
 * @param string $field
 * @return string
 */
function getValue($field)
{
    if (isset($_POST[$field])) {
        return $_POST[$field];
    }
    return '';
}
