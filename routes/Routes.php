<?php

use App\Router;
use App\websiteController;

# Show the home page
Router::new('/', 'WebsiteController', 'index')->name('home');
Router::new('/home', 'websiteController', 'index')->name('home');


# show login page
Router::new('/login', 'LoginController', 'show_page')->name('login');
# process the login page
Router::new('/login/process', 'LoginController', 'process')->name('login_process');
# logout
Router::new('/logout', 'LoginController', 'logout')->name('logout');

# الملف ده بتكتبي فيه كل الروابط بتاعتك الي في الموقع وتربطي بكل رابط الداله بتاعته زي كدا
# البارمترز
# 1 => الرابط
# 2 => اسم الكنترولر
# 3 => اسم الداله الي في الكنترولر

Router::new('/about', 'websiteController', 'about')->name('about');
Router::new('/contact-us', 'websiteController', 'contact_us')->name('contact-us');

/**
 * Services
 */
Router::new('/services/news', 'websiteController', 'news')->name('news');
Router::new('/services/results', 'websiteController' , 'results')->name('results')->middleware('auth');


Router::new('/admincp/dashboard', 'AdmniController', 'index')->name('admin_dashboard')->middleware('auth')->middleware('admin');

?>