<?php 

namespace Master;

use Config\Query_builder;

class Bagian
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('bagian ')->get()->resultArray();
        $res = '<a href="?target=bagian&act=tambah_bagian" class="btn btn-info btn-sm">Tambah bagian</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Nama Bagian</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
            $no = 1;
            foreach ($data as $r) {
                $res .= '<tr>
                <td width="10">'.$no.'</td>
                <td width="100">'.$r['ID_BAGIAN'].'</td>
                <td>'.$r['NAMA_BAGIAN'].'</td>
                <td width="150">
                    <a href="?target=bagian&act=edit_bagian&id='.$r['ID_BAGIAN'].'" class="btn btn-success btn-sm">Edit</a>
                    <a href="?target=bagian&act=delete_bagian&id='.$r['ID_BAGIAN'].'" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
                $no++;
            }
            $res .='</tbody></table></div>';
            return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=bagian" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=bagian&act=simpan_bagian">
            <div class="mb-3">
                <label for="ID_BAGIAN" class="form-label">ID_BAGIAN</label>
                <input type="text" class="form-control" id="ID_BAGIAN" name="ID_BAGIAN">
            </div>
            <div class="mb-3">
                <label for="NAMA_BAGIAN" class="form-label">NAMA_BAGIAN</label>
                <input type="text" class="form-control" id="NAMA_BAGIAN" name="NAMA_BAGIAN">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan(){
        $ID_BAGIAN = $_POST['ID_BAGIAN'];
        $NAMA_BAGIAN = $_POST['NAMA_BAGIAN'];

        $data = array(
            'ID_BAGIAN' => $ID_BAGIAN,
            'NAMA_BAGIAN' => $NAMA_BAGIAN
        );
        return $this->db->table('bagian')->insert($data);
    }
    public function edit($id)
    {
        // get data bagian
        $r = $this->db->table('bagian')->where("ID_BAGIAN='$id'")->get()->rowArray();
        // cek radio

        $res = '<a href="?target=bagian" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=bagian&act=update_bagian">
            <input type="hidden" class="form-control" id="param" name="param" value="'.$r['ID_BAGIAN'].'">
            
            <div class="mb-3">
                <label for="ID_BAGIAN" class="form-label">ID_BAGIAN</label>
                <input type="text" class="form-control" id="ID_BAGIAN" name="ID_BAGIAN" value="'.$r['ID_BAGIAN'].'">
            </div>
            <div class="mb-3">
                <label for="NAMA_BAGIAN" class="form-label">NAMA_BAGIAN</label>
                <input type="text" class="form-control" id="NAMA_BAGIAN" name="NAMA_BAGIAN" value="'.$r['NAMA_BAGIAN'].'">
            </div>
            <button type="submit" class="btn btn-primary">Ubah</button>
        </form>';
        return $res;
    }

    public function cekRadio($val, $val2) {
        if($val==$val2) {
            return "checked";
        }
        return "";
    }

    public function update() {
        $param = $_POST['param'];
        $ID_BAGIAN = $_POST['ID_BAGIAN'];
        $NAMA_BAGIAN = $_POST['NAMA_BAGIAN'];


        $data = array(
            'ID_BAGIAN' => $ID_BAGIAN,
            'NAMA_BAGIAN' => $NAMA_BAGIAN
        );
        return $this->db->table('bagian')->where(" ID_BAGIAN='$param'")->update($data);
    }

    public function delete($id) {
        return $this->db->table(' bagian ')->where(" ID_BAGIAN='$id' ")->delete();
    }
}