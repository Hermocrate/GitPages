<?php
// public/index.php
require_once '../helpers/routeHelper.php';
require_once '../controllers/BlogController.php';

$controller = new BlogController();
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case ACTION_CREATE_POST:
            $controller->create();
            break;
        case ACTION_EDIT_POST:
            $controller->edit($_GET['EMPLOYE_ID']);
            break;
        case ACTION_DELETE_POST:
            $controller->delete($_GET['EMPLOYE_ID']);
            break;
        default:
            $controller->index();
            break;
    }
} else {
    $controller->index();
}
?>
