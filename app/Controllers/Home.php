<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'home'
        ] ;
        return view('v_template_front_end', $data);
    }
}
