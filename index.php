<?php  
session_start();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//echo "путь: $uri";
$segments = explode('/', trim($uri, '/'));


$method = $_SERVER['REQUEST_METHOD'];

if (!empty($segments[1]) and $segments[1] == 'carouselengine')
{
	$file = '/tomasina/moduls/carouselengine/' . $segments[2];
	require $file;
}

if (!empty($segments[1])) 
{
	if (!empty($segments[2]))
	{
		if ($segments[2]== 'prof') {
			
			if (!empty($_SESSION['auth']) and $_SESSION['status'] == '1')
			{
				
				if (!empty($segments[3]))
				{
					if ($segments[3]== 'interviews')
					{
						$file = 'pages/prof_admin_interviews.php';
					}
					elseif ($segments[3] == 'cats')
					{
						$file = 'pages/prof_admin_cats.php';
					}
					elseif ($segments[3] == 'trans')
					{
						$file = 'pages/prof_admin_trans.php';
					}
					elseif ($segments[3] == 'getUserData')
					{
						$file = 'pages/get_user_data.php';
					}
					elseif ($segments[3] == 'getUserDataResult')
					{
						$file = 'pages/get_user_dataResult.php';
					}
					elseif ($segments[3] == 'get_cat_data') 
					{
						$file = 'pages/get_cat_data.php';
					}
					elseif ($segments[3] == 'report') 
					{
						$file = 'pages/get_report.php';
					}
					else
					{
						$file = 'pages/error404.php';
					}

				}
				else
				{
					$file = 'pages/prof_admin_trans.php';
				}
			}
			elseif (!empty($_SESSION['auth']) and $_SESSION['status'] == '2')
			{
				if (!empty($segments[3]))
				{
					if ($segments[3]== 'edit')
					{
						$file = 'pages/prof_user_edit.php';
					}
					elseif ($segments[3] == 'interviews')
					{
						$file = 'pages/prof_user_interviews.php';
					}
					elseif ($segments[3] == 'cats')
					{
						$file = 'pages/prof_user_cats.php';
					}
					else
					{
						$file = 'pages/error404.php';
					}
				}
				else
				{
					$file = 'pages/prof_user.php';
				}
			}
			else	
			{
				$file = 'pages/error404.php';
			}
		}
		else
		{
			$file = 'pages/' . $segments[2] . '.php';
		}
	}
	else {
		$file = 'pages/error404.php';
	} 
}
elseif ($segments[0] == 'tomasina')
{
	$file = 'pages/main.php';
}
else
{
	$file = 'pages/error404.php';
}
require $file;
?>