<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterAuth implements FilterInterface
{
    /**
     * Berjalan SEBELUM Controller dieksekusi (Proteksi Halaman)
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika session 'log' tidak ada / belum login
        if (empty(session()->get('login') ==1)) {
            // Tendang user kembali ke halaman login dengan pesan peringatan
            session()->setFlashdata('pesan', 'Anda Harus Login Terlebih Dahulu !!');
            return redirect()->to(base_url('Auth/Login'));
        }
    }

    /**
     * Berjalan SETELAH Controller dieksekusi
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Jika sudah login, lempar balik ke halaman Admin jika coba akses login lagi
        if (session()->get('login') == 1) {
            return redirect()->to(base_url('Admin')); 
        }
    }
    public function __construct()
{
    // Pastikan di sini mengecek 'login' (bukan 'log')
    if (session()->get('login') == '') {
        session()->setFlashdata('pesan', 'Anda Belum Login, Silahkan Login Terlebih Dahulu !!');
        return redirect()->to(base_url('Auth/Login'))->send();
    }
}
}