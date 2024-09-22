<?php

define('ADMIN','admin');
route_get(ADMIN,'admin.index');
route_get(ADMIN.'/lang','controllers.admin.set_language');
