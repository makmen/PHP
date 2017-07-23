<?php

abstract class Config {

    const SITENAME = "tasksmanager.ru";
    const SECRET = "KSLweR4pV"; // хэширование данные

    const ADM_EMAIL = "admin@makas.ru";
    const ADM_NAME = "Админ";

    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_NAME = "akono";
    const DB_PREFIX = "mk_";
    const DB_SYM_QUERY = "?";

    const DIR_IMG = "/images/";
    const DIR_IMG_ARTICLES = "/images/articles/";
    const DIR_AVATAR = "/images/avatars/";
    const DIR_TMPL = BASEPATH . "/tmpl/";
    const DIR_EMAILS = BASEPATH . "/tmpl/email/";

    const FILE_MESSAGES = BASEPATH . "/text/messages.ini";

    const FORMAT_DATE = "%Y-%m-%d %H:%M:%S";

    // pagination
    const COUNT_USERS_ON_PAGE = 10;
    const COUNT_TASKS_ON_PAGE = 10; 
    const COUNT_PROJECTS_ON_PAGE = 9; 

    const COUNT_SHOW_PAGES = 10;

    const MIN_SEARCH_LEN = 3;
    const LEN_SEARCH_RES = 255;

    const SEF_SUFFIX = ".html";

    const DEFAULT_AVATAR = "default.png";
    const MAX_SIZE_AVATAR = 51200;
    
    const SERVER_NAME = "http://frtasks.local";
    const DEFAULT_CONTROLLER = 'project';
    const DEFAULT_ACTION = 'index';
    const LAYOUT = "layout";
    
}

