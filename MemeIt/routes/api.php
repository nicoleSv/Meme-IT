<?php 

    $router = new Router();

    $router->route('POST', 'register', function() {
        UserController::register();
    });

    $router->route('POST', 'login', function() {
        UserController::login();
    });

    $router->route('GET', 'logout', function(){
        UserController::logout(); 
    });    

    $router->route('GET', 'home', function() {
        UserController::index();
    });

    $router->route('GET', 'generator', function() {
        UserController::showTopic();
    });

    $router->route('GET', 'register', function() {
        UserController::loadRegistration();
    });

    $router->route('GET', 'collection', function() {
        UserController::loadCollection();
    });

    $router->route('POST', 'collection/getUsers', function() {
        UserController::getUsers();
    });

    $router->route('GET', '', function(){
        UserController::index(); 
    });


    // Topic Controller
    $router->route('POST', 'generator/save', function(){
        TopicController::saveMeme(); 
    });

    $router->route('POST', 'generator/getMeme', function() {
        TopicController::getMeme();
    });

    $router->route('POST', 'generator/public', function() {
        TopicController::updateVisibility();
    });

    $router->route('POST', 'collection/getAllMemes', function() {
        TopicController::getAllMemes();
    });

    $router->run();
?>