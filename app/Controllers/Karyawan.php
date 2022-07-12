<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\KaryawanModel;
use CodeIgniter\HTTP\RequestTrait;

class Karyawan extends ResourceController
{
    protected $format = 'json';
    use RequestTrait;
    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'messages'   => 'success',
            'data'       => $this->karyawanModel->findAll()
        ];
        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->karyawanModel->find($id);
        if ($data) {
            $response = [
                'messages'   => 'success',
                'data'       => $data
            ];
            return $this->respond($response, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = $this->request->getPost();
        if (!$this->karyawanModel->save($data)) {
            return $this->fail($this->karyawanModel->errors());
        }
        $response = [
            'status'    => 200,
            'error'     => null,
            'messages'  => [
                'success'   => 'Data berhasil disimpan'
            ]
        ];
        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $isExists = $this->karyawanModel->find($id);

        if (!$isExists) {
            return $this->failNotFound("data tidak ditemukan untuk id $id");
        }
        $data = $this->request->getRawInput();
        $data['id_karyawan'] = $id;
        if (!$this->karyawanModel->save($data)) {
            return $this->fail($this->karyawanModel->errors());
        }
        $response = [
            'status'    => 201,
            'error'     => null,
            'messages'  => [
                'success'   => 'Data berhasil update'
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $data = $this->karyawanModel->find($id);
        if ($data) {
            $this->karyawanModel->delete($id);
            $response = [
                'status'    => 200,
                'error'     => null,
                'messages'  => [
                    'success'   => 'Data berhasil dihapus'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }
    }
}
