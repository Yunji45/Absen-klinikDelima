<?php

return [
    'ip_address'    => env('IP_ADDRESS', '192.168.137.1'),
    // 'jam_masuk'     => env('JAM_MASUK', '01:00:00'),
    // 'jam_keluar'    => env('JAM_KELUAR', '02:00:00'),

    'jam_masuk_PS'  => env('JAM_MASUK_PS', '03:00:00'),
    'jam_keluar_PS'  => env('JAM_KELUAR_PS', '03:30:00'),

    'jam_masuk_SM'  => env('JAM_MASUK_PS', '16:00:00'),
    'jam_keluar_SM'  => env('JAM_KELUAR_PS', '07:00:00'),
    
    'jam_masuk_PM'  => env('JAM_MASUK_PM', '07:00:00'),
    'jam_keluar_PM'  => env('JAM_KELUAR_PM', '22:00:00'),

];
//jam database berbeda dengan jam WIB
//jam 01:00 berarti jam 08:00