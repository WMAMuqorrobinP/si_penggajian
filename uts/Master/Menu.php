<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/uts/index.php?target=";
        $data = [
            array('Text' => 'Home', 'Link' => $base . 'home'),
            array('Text' => 'Karyawan', 'Link' => $base . 'karyawan'),
            array('Text' => 'Bagian', 'Link' => $base . 'bagian'),
            array('Text' => 'Gaji', 'Link' => $base . 'gaji')
        ];
        return $data;
    }
}