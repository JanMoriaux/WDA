<?php
/**
 * Created by PhpStorm.
 * User: janmo
 * Date: 7/05/2017
 * Time: 15:37
 */
define (ROOT,__DIR__);

require_once __DIR__ . '/models/database/CRUD/AddressDb.php';
require_once __DIR__ . '/models/database/CRUD/ProductDb.php';

ProductDb::updateStock(15,-9);
