<?php 

namespace Master;

use Config\Query_builder;

class Gaji
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('gaji ')->get()->resultArray();
        $res = '<a href="?target=gaji&act=tambah_gaji" class="btn btn-info btn-sm">Tambah Gaji</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>NO</th>
                    <th>ID_GAJI</th>
                    <th>GAJI_POKOK</th>
                    <th>TUNJANGAN</th>
                    <th>TOOLS</th>
                </tr>
            </thead>
            <tbody>';
            $no = 1;
            foreach ($data as $r) {
                $res .= '<tr>
                <td width="10">'.$no.'</td>
                <td width="100">'.$r['ID_GAJI'].'</td>
                <td>'.$r['GAJI_POKOK'].'</td>
                <td width="10">'.$r['TUNJANGAN'].'</td>
                <td width="150">
                    <a href="?target=gaji&act=edit_gaji&id='.$r['ID_GAJI'].'" class="btn btn-success btn-sm">Edit</a>
                    <a href="?target=gaji&act=delete_gaji&id='.$r['ID_GAJI'].'" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
                $no++;
            }
            $res .='</tbody></table></div>';
            return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=gaji" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=gaji&act=simpan_gaji">
            <div class="mb-3">
                <label for="ID_GAJI" class="form-label">ID_GAJI</label>
                <input type="text" class="form-control" id="ID_GAJI" name="ID_GAJI">
            </div>
            <div class="mb-3">
                <label for="GAJI_POKOK" class="form-label">GAJI_POKOK</label>
                <input type="text" class="form-control" id="GAJI_POKOK" name="GAJI_POKOK">
            </div>
            <div class="mb-3">
                <label for="TUNJANGAN" class="form-label">TUNJANGAN</label>
                <input type="text" class="form-control" id="TUNJANGAN" name="TUNJANGAN">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan(){
        $ID_GAJI = $_POST['ID_GAJI'];
        $GAJI_POKOK = $_POST['GAJI_POKOK'];
        $TUNJANGAN = $_POST['TUNJANGAN'];

        $data = array(
            'ID_GAJI' => $ID_GAJI,
            'GAJI_POKOK' => $GAJI_POKOK,
            'TUNJANGAN' =>$TUNJANGAN

        );
        return $this->db->table('gaji')->insert($data);
    }
    public function edit($id)
    {
        // get data gaji
        $r = $this->db->table('gaji')->where("ID_GAJI='$id'")->get()->rowArray();
        // cek radio

        $res = '<a href="?target=gaji" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=gaji&act=update_gaji">
            <input type="hidden" class="form-control" id="param" name="param" value="'.$r['ID_GAJI'].'">
            
            <div class="mb-3">
                <label for="ID_GAJI" class="form-label">ID_GAJI</label>
                <input type="text" class="form-control" id="ID_GAJI" name="ID_GAJI" value="'.$r['ID_GAJI'].'">
            </div>
            <div class="mb-3">
                <label for="GAJI_POKOK" class="form-label">GAJI_POKOK</label>
                <input type="text" class="form-control" id="GAJI_POKOK" name="GAJI_POKOK" value="'.$r['GAJI_POKOK'].'">
            </div>
            <div class="mb-3">
                <label for="TUNJANGAN" class="form-label">TUNJANGAN</label>
                <input type="text" class="form-control" id="TUNJANGAN" name="TUNJANGAN" value="'.$r['TUNJANGAN'].'">
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
        $ID_GAJI = $_POST['ID_GAJI'];
        $GAJI_POKOK = $_POST['GAJI_POKOK'];
        $TUNJANGAN = $_POST['TUNJANGAN'];

        $data = array(
            'ID_GAJI' => $ID_GAJI,
            'GAJI_POKOK' => $GAJI_POKOK,
            'TUNJANGAN' =>$TUNJANGAN,
            
        );
        return $this->db->table('gaji')->where(" ID_GAJI='$param'")->update($data);
    }

    public function delete($id) {
        return $this->db->table(' gaji ')->where(" ID_GAJI='$id' ")->delete();
    }
}