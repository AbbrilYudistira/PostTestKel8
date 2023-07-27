<?php

namespace App\Controllers;

class Karakter extends BaseController
{
    function __construct()
    {
        $this->model = new \App\Models\ModelKarakter();
    }
    public function hapus($ID)
    {
        $this->model->delete($ID);
        return redirect()->to('Karakter');
    }
    public function edit($ID)
    {
        return json_encode($this->model->find($ID));
    }

    public function simpan()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'Nama'=>[
                'label' => 'Nama',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
            'Email'=>[
                'label' => 'Email',
                'rules' => 'required|min_length[5]|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter',
                    'valid_email' => 'Email yang kamu masukkan tidak valid'
                ]
            ],
            'Alamat'=>[
                'label' => 'Alamat',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
                ]
            ],
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()){
            $ID = $this->request->getPost('ID');
            $Nama = $this->request->getPost('Nama');
            $Email = $this->request->getPost('Email');
            $Bidang = $this->request->getPost('Bidang');
            $Alamat = $this->request->getPost('Alamat');

            $data = [
                'ID'=>$ID,
                'Nama'=>$Nama,
                'Email'=>$Email,
                'Bidang'=>$Bidang,
                'Alamat'=>$Alamat
            ];

            $this->model->save($data);

            $hasil['sukses'] = "Berhasil memasukkan data";
            $hasil['error'] = true;
        } else {
            $hasil['sukses'] = false;
            $hasil['error'] = $validasi->listErrors();
        }

        return json_encode($hasil);
    }
    public function index()
    {
        $jumlahBaris = 10;
        $katakunci = $this->request->getGet('katakunci');
        if($katakunci){
            $pencarian = $this->model->cari($katakunci);
        }else{
            $pencarian = $this->model;
        }
        $data['katakunci'] = $katakunci;
        $data['dataKarakter'] = $pencarian->orderBy('ID', 'desc')->paginate($jumlahBaris);
        $data['pager'] = $this->model->pager;
        $data['nomor'] = ($this->request->getGet('page')==1)?'0':$this->request->getGet('page');
        return view('karakter_view', $data);
    }
}
