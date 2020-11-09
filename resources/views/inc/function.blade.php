{{-- Functions --}}
@php


if (!function_exists('setTitle')) :
    function setTitle($page_name) {

        $admin_name = '| SMARTER';

        if ($page_name === 'home') :
            echo  trans('navbar.dashboard');
        elseif ($page_name === 'sales') :
            echo 'Sales Admin ' . $admin_name;
        else :
         echo  trans('navbar.'. ucfirst($page_name)) . $admin_name;
        endif;
    }
endif;

if (!function_exists('set_breadcrumb')) {
    function set_breadcrumb($page_name, $category_name) {

        $category = ucfirst($category_name);

        $removeUnderscore = str_replace('_', ' ', $page_name);

        $removeDash = str_replace('-', ' ', $removeUnderscore);

        $page = ucwords($removeDash);

        if ($page_name === 'home') :
            $name_c = trans('navbar.'. $category);
            echo '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $name_c  .'</a></li>';
        elseif ($page_name === 'about_us') :
            $name_p = trans('navbar.'. $page);
            echo '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $name_p  .'</a></li>';
        else :
        $name_c = trans('navbar.'. $category);

        $name_p = trans('navbar.'. $page);
          echo '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $name_c .'</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>' . $name_p .'</span></li>';
        endif;

    }
}


// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function scrollspy($offset) {
    echo 'data-target="#navSection" data-spy="scroll" data-offset="'. $offset . '"';
}

@endphp
