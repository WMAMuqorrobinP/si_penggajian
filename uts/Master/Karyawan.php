<?php 

namespace Master;

use Config\Query_builder;

class Karyawan
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('karyawan ')->get()->resultArray();
        $res = '<a href="?target=karyawan&act=tambah_karyawan" class="btn btn-info btn-sm">Tambah karyawan</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepone</th>
                    <th>Alamat</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
            $no = 1;
            foreach ($data as $r) {
                $res .= '<tr>
                <td width="10">'.$no.'</td>
                <td width="100">'.$r['ID_KARYAWAN'].'</td>
                <td width="100">'.$r['NAMA'].'</td>
                <td width="100">'.$r['JENIS_KELAMIN'].'</td>
                <td>'.$r['TELEPON'].'</td>
                <td width="100">'.$r['ALAMAT'].'</td>
                <td width="150">
                    <a href="?target=karyawan&act=edit_karyawan&id='.$r['ID_KARYAWAN'].'" class="btn btn-success btn-sm">Edit</a>
                    <a href="?target=karyawan&act=delete_karyawan&id='.$r['ID_KARYAWAN'].'" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
                $no++;
            }
            $res .='</tbody></table></div>';
            return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=karyawan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=karyawan&act=simpan_karyawan">
            <div class="mb-3">
                <label for="ID_KARYAWAN" class="form-label">ID_KARYAWAN</label>
                <input type="text" class="form-control" id="ID_KARYAWAN" name="ID_KARYAWAN">
            </div>
            <div class="mb-3">
                <label for="NAMA" class="form-label">NAMA</label>
                <input type="text" class="form-control" id="NAMA" name="NAMA">
            </div>
            <div class="mb-3">
                <label for="JENIS_KELAMIN" class="form-label">JENIS_KELAMIN</label>
                <input type="text" class="form-control" id="JENIS_KELAMIN" name="JENIS_KELAMIN">
            </div>
            <div class="mb-3">
                <label for="TELEPON" class="form-label">TELEPON</label>
                <input type="text" class="form-control" id="TELEPON" name="TELEPON">
            </div>
            <div class="mb-3">
                <label for="ALAMAT" class="form-label">ALAMAT</label>
                <input type="text" class="form-control" id="ALAMAT" name="ALAMAT">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan(){
        $ID_KARYAWAN = $_POST['ID_KARYAWAN'];
        $NAMA = $_POST['NAMA'];
        $JENIS_KELAMIN = $_POST['JENIS_KELAMIN'];
        $TELEPON = $_POST['TELEPON'];
        $ALAMAT = $_POST['ALAMAT'];

        $data = array(
            'ID_KARYAWAN' => $ID_KARYAWAN,
            'NAMA' => $NAMA,
            'JENIS_KELAMIN' =>$JENIS_KELAMIN,
            'TELEPON' =>$TELEPON,
            'ALAMAT' =>$ALAMAT
        );
        return $this->db->table('karyawan')->insert($data);
    }
    public function edit($id)
    {
        // get data karyawan
        $r = $this->db->table('karyawan')->where("ID_KARYAWAN='$id'")->get()->rowArray();
        // cek radio

        $res = '<a href="?target=karyawan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=karyawan&act=update_karyawan">
            <input type="hidden" class="form-control" id="param" name="param" value="'.$r['ID_KARYAWAN'].'">
            <div class="mb-3">
                <label for="ID_KARYAWAN" class="form-label">ID_KARYAWAN</label>
                <input type="text" class="form-control" id="ID_KARYAWAN" name="ID_KARYAWAN" value="'.$r['ID_KARYAWAN'].'">
            </div>
            <div class="mb-3">
                <label for="NAMA" class="form-label">NAMA</label>
                <input type="text" class="form-control" id="NAMA" name="NAMA" value="'.$r['NAMA'].'">
            </div>
            <div class="mb-3">
                <label for="JENIS_KELAMIN" class="form-label">JENIS_KELAMIN</label>
                <input type="text" class="form-control" id="JENIS_KELAMIN" name="JENIS_KELAMIN" value="'.$r['JENIS_KELAMIN'].'">
            </div>
            <div class="mb-3">
                <label for="TELEPON" class="form-label">TELEPON</label>
                <input type="text" class="form-control" id="TELEPON" name="TELEPON" value="'.$r['TELEPON'].'">
            </div>
            <div class="mb-3">
                <label for="ALAMAT" class="form-label">ALAMAT</label>
                <input type="text" class="form-control" id="ALAMAT" name="ALAMAT" value="'.$r['ALAMAT'].'">
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
        $ID_KARYAWAN = $_POST['ID_KARYAWAN'];
        $NAMA = $_POST['NAMA'];
        $JENIS_KELAMIN = $_POST['JENIS_KELAMIN'];
        $TELEPON = $_POST['TELEPON'];
        $ALAMAT = $_POST['ALAMAT'];

        $data = array(
            'ID_KARYAWAN' => $ID_KARYAWAN,
            'NAMA' => $NAMA,
            'JENIS_KELAMIN' =>$JENIS_KELAMIN,
            'TELEPON' =>$TELEPON,
            'ALAMAT' =>$ALAMAT
            
        );
        return $this->db->table('karyawan')->where(" ID_KARYAWAN='$param'")->update($data);
    }

    public function delete($id) {
        return $this->db->table(' karyawan ')->where(" ID_KARYAWAN='$id' ")->delete();
    }
}