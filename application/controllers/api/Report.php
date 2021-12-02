<?php

use Restserver\libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Report extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model', 'report'); // setelah koma alias
        //per method per jam
        //$this->methods['index_get']['limit'] = 100;
    }

    //GET

    public function index_get()
    {

        $id = $this->get('kd_barang');
        if ($id === null) {
            $barang = $this->barang->getBarang();
        } else {
            $barang = $this->barang->getBarang($id);
        }

        if ($barang) {
            $this->response([
                'status' => TRUE,
                'data' => $barang
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function kdBarang_get()
    {

        $barang = $this->barang->getKodeBarang();

        if ($barang) {
            $this->response([
                'status' => TRUE,
                'data' => $barang
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'kd_barang not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function stokBarang_get()
    {

        $barang = $this->barang->getStokBarang();

        if ($barang) {
            $this->response([
                'status' => TRUE,
                'data' => $barang
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'stok barang not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //AKHIR GET

    // public function index_delete()
    // {
    //     $id = $this->delete('kd_barang');

    //     if ($id === null) {
    //         $this->response([
    //             'status' => FALSE,
    //             'message' => 'provide an id'
    //         ], REST_Controller::HTTP_NO_CONTENT);
    //     } else {
    //         if ($this->barang->deleteBarang($id) > 0) {
    //             $this->response([
    //                 'status' => TRUE,
    //                 'id' => $id,
    //                 'message' => 'deleted'
    //             ], REST_Controller::HTTP_BAD_REQUEST);
    //         } else {
    //             $this->response([
    //                 'status' => FALSE,
    //                 'message' => 'id not found!'
    //             ], REST_Controller::HTTP_BAD_REQUEST);
    //         }
    //     }
    // }


    public function index_post()
    {
        $data = [
            'report' => $this->post('report'),
        ];

        if ($this->report->createReport($data) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'Report received !'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'report failed!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }



    // public function index_put()
    // {
    //     $id = $this->put('kd_barang');
    //     $data = [
    //         'kd_barang' => $this->put('kd_barang'),
    //         'nama_barang' => $this->put('nama_barang'),
    //         'jml_barang' => $this->put('jml_barang'),
    //         'harga_pcs' => $this->put('harga_pcs')
    //     ];

    //     if ($this->barang->updateBarang($data, $id) > 0) {
    //         $this->response([
    //             'status' => TRUE,
    //             'message' => 'data updated!'
    //         ], REST_Controller::HTTP_CREATED);
    //     } else {
    //         $this->response([
    //             'status' => FALSE,
    //             'message' => 'failed to update data!'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
    //     }
    // }
}
