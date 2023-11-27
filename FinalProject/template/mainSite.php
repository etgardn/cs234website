<?php

function init(){
    require config('template_path') . '/loginTemplate.php';
}

function site_name(){
    echo config('name');
}

function nav_menu($sep=' | '){
    $nav_menu='';
    $nav_item=config('nav_menu');

    foreach ($nav_item as $uri=>$name){
        $nav_menu.='<a href="' . 'content/' . $uri . ".phtml" . '">'. $name . '</a>'. $sep; 
    }
    echo trim($nav_menu,$sep);
}

function page_content()
{
    $page='home';
    $path=getcwd() . '/' . config('content_path') . '/'. $page . '.phtml';

    echo file_get_contents($path);
}
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
<!DOCTYPE html>
<html>
<head>

</head>
<body>
<div>
    <header>
        <h1><?php site_name();?></h1>
        <nav>
            <?php nav_menu();?>
        </nav>    
    </header>

    <article>
        <?php page_content();?>
    </article>

    <footer>
        <small>&copy;<?php echo date('Y');?><?php site_name();?></small>
    </footer>
</div>
</body>
</html>