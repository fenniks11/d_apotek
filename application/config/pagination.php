<?php
defined('BASEPATH') or exit('No direct script access allowed');

// styling
$config['full_tag_open'] = ' <nav aria-label="Page navigation example" class="ml-4"><ul class="pagination justify-content-center">';
$config['full_tag_close'] = '</ul></nav>';

// halaman pertama
$config['first_link'] = 'First';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '<li>';

// halaman terakhir
$config['last_link'] = 'Last';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '<li>';

// halaman selanjutnya
$config['next_link'] = '&raquo';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '<li>';

// halaman selanjutnya
$config['prev_link'] = '&laquo';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '<li>';

// halaman saat ini
$config['cur_tag_open'] = '<li class="page-item active"> <a class="page-link" href="#">';
$config['cur_tag_close'] = '</a><li>';

// halaman perdigit
$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '<li>';

// Display
$config['attributes'] = array('class' => 'page-link');
