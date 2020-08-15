<?php
use App\Router;

Router::get("/init/festivals", "ApiController@initialFestivals");

/**
 * PAGES
 */
Router::get("/", "MainController@homePage");
Router::get("/exchange-guide", "MainController@exchangePage");
Router::get("/festival-main", "MainController@mainFestivalPage");
Router::get("/festival-list", "MainController@listFestivalPage");
Router::get("/location.php", "MainController@locationPage");
Router::get("/notice", "MainController@noticePage");
Router::get("/festivals/form", "MainController@insertFormPage", "user");
Router::get("/festivals/form/{id}", "MainController@updateFormPage", "user");
Router::get("/festivals/{id}", "MainController@festivalInfoPage");
Router::get("/schedules", "MainController@schedulePage");

/**
 * ACTIONS
 */
Router::post("/login", "MainController@login");
Router::get("/logout", "MainController@logout");
Router::post("/insert/festivals", "MainController@insertFestival", "user");
Router::post("/update/festivals/{id}", "MainController@updateFestival", "user");
Router::get("/festivals/{type}/{id}", "MainController@downloadImage");
Router::get("/delete/festivals/{id}", "MainController@deleteFestival", "user");
Router::post("/festivals/{fid}/reviews", "MainController@insertReview");
Router::get("/delete/reviews/{id}", "MainController@deleteReview", "user");

/**
 * API
 */
Router::get("/api/exchange-rate", "ApiController@jsonExchangeRate");
Router::get("/api/festival-list", "ApiController@jsonFestivalList");
Router::get("/openAPI/festivalList.php", "ApiController@jsonFestivalByDate");

Router::start();