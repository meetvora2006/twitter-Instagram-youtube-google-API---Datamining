<?php 
/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */
function get_buttons($id)
{
    $ci= & get_instance();
    $html='<span class="actions">';
    $html .='<a href="'.  base_url('admin.php/post/edit/'.$id).'"><img src="'.  base_url('assets/images/edit.png').'"/></a>';
	$html .='<img src="'. base_url('assets/images/delete.png').'" onclick="deletepost('.$id.')"/>';
	$html .='<a href="'.  base_url('admin.php/favourite/'.$id).'">favourite</a>';
	$html .='<a href="'.  base_url('admin.php/stack/'.$id).'">stack</a>';
    $html.='</span>';
    
    return $html;
}


function get_buttons_user($id)
{
    $ci= & get_instance();
    $html='<span class="actions">';
    $html .='<a href="'.  base_url('admin.php/user/edit/'.$id).'"><img src="'.  base_url('assets/images/edit.png').'"/></a>';
	$html .='<img src="'. base_url('assets/images/delete.png').'" onclick="deleteuser('.$id.')"/>';
	$html .='<a href="'.  base_url('admin.php/userfavourite/'.$id).'">favourite</a>';
	$html .='<a href="'.  base_url('admin.php/userstack/'.$id).'">stack</a>';
    $html.='</span>';
    
    return $html;
}


function get_buttons_category($id)
{
    $ci= & get_instance();
    $html='<span class="actions">';
    $html .='<a href="'.  base_url('admin.php/category/edit/'.$id).'"><img src="'.  base_url('assets/images/edit.png').'"/></a>';
	$html .='<img src="'. base_url('assets/images/delete.png').'" onclick="deletecategory('.$id.')"/>';
    $html.='</span>';
    
    return $html;
}