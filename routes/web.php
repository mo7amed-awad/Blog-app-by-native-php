<?php
route_get('/','front.home');
route_get('lang','controllers.set_language');
route_post('upload','controllers.upload');

include base_path('routes/admin.php');

