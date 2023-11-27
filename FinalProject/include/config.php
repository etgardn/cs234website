<?php

function config($key='')
{
    $config=[
        'name'=>'Great Website',
        'nav_menu'=>[
            'home'=>'Home',
            'about-us'=>'About Us',
            'products'=>'Products',
            'contact'=>'Contact',
        ],
        'template_path'=>'template',
        'content_path'=>'content',
    ];

    return isset($config[$key]) ? $config[$key]:null;
}
?>