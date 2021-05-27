<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_apotek extends CI_Model
{
    // model untuk data obat
    public function daftar_obat()
    {
        $this->db->select('*');
        $this->db->from('obat');
        $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        $this->db->order_by('obat.id_obat', 'DESC');
        return $this->db->get()->result_array();
    }

    public function obatPerPage($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_obat', $keyword);
        }
        $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        $this->db->order_by('obat.id_obat', 'DESC');
        return $this->db->get('obat', $limit, $start)->result_array();
    }

    public function count_obat()
    {
        $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        $this->db->order_by('obat.id_obat', 'DESC');
        return $this->db->get('obat')->num_rows();
    }

    public function fetch_data($query)
    {
        $this->db->like('nama_obat', $query);
        $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        $this->db->join('kategori', 'obat.id_kategori = kategori.id_kategori');
        $this->db->join('jenis_obat', 'detail_obat.id_jenis = jenis_obat.id_jenis');
        $this->db->order_by('obat.id_obat', 'DESC');
        $query = $this->db->get('obat');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $output[] = array(
                    'nama_obat'  => $row["nama_obat"],
                    'gambar'  => $row["gambar"]
                );
            }
            echo json_encode($output);
        }
    }

    public function detail_obat($data)
    {
        $this->db->select('*');
        $this->db->from('obat');
        $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        $this->db->join('kategori', 'obat.id_kategori = kategori.id_kategori');
        $this->db->join('jenis_obat', 'detail_obat.id_jenis = jenis_obat.id_jenis');
        $this->db->where('obat.id_obat', $data);
        return $this->db->get()->row();
    }
    public function ambilData()
    {
        $this->db->select('*');
        $this->db->from('obat');
        $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        $this->db->join('kategori', 'obat.id_kategori = kategori.id_kategori');
        $this->db->join('jenis_obat', 'detail_obat.id_jenis = jenis_obat.id_jenis');
        return $this->db->get()->result();
    }

    public function add($data)
    {
        $this->db->insert('obat', $data);
    }

    public function addDetailObat($data)
    {

        $this->db->insert('detail_obat', $data);
    }

    public function edit_obat($data)
    {
        $this->db->where('id_obat', $data['id_obat']);
        $this->db->update('obat', $data);
    }

    public function editDetail_obat($data)
    {
        $this->db->where('id_obat', $data['id_obat']);
        $this->db->update('detail_obat', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_obat', $data['id_obat']);
        $this->db->delete('obat', $data);
        $this->db->delete('detail_obat', $data);
    }

    public function del_kat($data)
    {
        $this->db->where('id_kategori', $data['id_kategori']);
        $this->db->delete('kategori', $data);
    }
    public function del_sup($data)
    {
        $this->db->where('id_suplier', $data['id_suplier']);
        $this->db->delete('suplier', $data);
    }

    public function del_jenis($data)
    {
        $this->db->where('id_jenis', $data['id_jenis']);
        $this->db->delete('jenis_obat', $data);
    }

    public function obat_expired()
    {
        return $this->db->query('select *  from obat join detail_obat on obat.id_obat = detail_obat.id_obat join suplier on obat.id_suplier = suplier.id_suplier join kategori on obat.id_kategori = kategori.id_kategori join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE tgl_expired BETWEEN DATE_SUB(NOW(), INTERVAL 40 YEAR) AND NOW()');
    }

    public function hampirExp()
    {
        return $this->db->query('select *  from obat join detail_obat on obat.id_obat = detail_obat.id_obat join suplier on obat.id_suplier = suplier.id_suplier join kategori on obat.id_kategori = kategori.id_kategori join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE tgl_expired BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 60 DAY)');
    }

    public function countex()
    {
        $ce = $this->db->query('select *  from obat join detail_obat on obat.id_obat = detail_obat.id_obat join suplier on obat.id_suplier = suplier.id_suplier join kategori on obat.id_kategori = kategori.id_kategori join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE tgl_expired BETWEEN DATE_SUB(NOW(), INTERVAL 100 YEAR) AND NOW()');
        $nullex = $ce->num_rows();
        return $nullex;
    }

    public function count_sup()
    {
        $cp =  $this->db->query('SELECT * FROM suplier');
        $sup = $cp->num_rows();
        return $sup;
    }

    public function count_kat()
    {
        $cp =  $this->db->query('SELECT * FROM kategori');
        $kat = $cp->num_rows();
        return $kat;
    }
    public function count_med()
    {
        $cm =  $this->db->query('SELECT *, SUM(detail_obat.stok) as totStock FROM detail_obat');
        if ($cm->num_rows() > 0) {
            foreach ($cm->result() as $get) {
                return $get->totStock;
            }
        } else {
            return FALSE;
        }
    }

    public function count_jenis()
    {
        $cu =  $this->db->query('SELECT * FROM jenis_obat');
        $cunit = $cu->num_rows();
        return $cunit;
    }

    public function stokHabis()
    {
        return $this->db->query('select *  from obat join detail_obat on obat.id_obat = detail_obat.id_obat join suplier on obat.id_suplier = suplier.id_suplier join kategori on obat.id_kategori = kategori.id_kategori join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE stok BETWEEN 0 AND 0');
    }

    public function countstock()
    {
        $cs =  $this->db->query('select *  from obat join detail_obat on obat.id_obat = detail_obat.id_obat join kategori on obat.id_kategori = kategori.id_kategori join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE stok BETWEEN 0 AND 0');
        $nullstock = $cs->num_rows();
        return $nullstock;
    }

    function stok_hampir_habis()
    {
        return $this->db->query('select *  from obat join detail_obat on obat.id_obat = detail_obat.id_obat join suplier on obat.id_suplier = suplier.id_suplier join kategori on obat.id_kategori = kategori.id_kategori join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE stok BETWEEN 1 AND 8');
    }

    function kategori()
    {
        return $this->db->get('kategori');
    }

    function suplier()
    {
        return $this->db->get('suplier');
    }

    function jenis()
    {
        return $this->db->get('jenis_obat');
    }

    function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
        return $this->db->get()->row();
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }


    // mengambil data suplier per baris.
    function get_suplier()
    {
        $data = array();
        $query = $this->db->get('suplier')->result_array();

        if (is_array($query) && count($query) > 0) {
            foreach ($query as $row) {
                $data['-'] = '- Pilih Suplier -';
                $data[$row['id_suplier']] = $row['nama_sup'];
            }
        }
        asort($data);
        return $data;
    }

    public function get_obat($id_suplier)
    {
        $this->db->select('*');
        $this->db->from('obat');
        $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        $this->db->where('obat.id_suplier', $id_suplier);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            foreach ($query->result_array() as $row) {
                $data['-'] = '- Pilih Obat -';
                $result[$row['id_obat']] = ucwords(strtolower($row['nama_obat']));
            }
        } else {
            $result['-'] = '- Belum Ada Obat -';
        }
        return $result;
    }

    public function get_stok($id_obat)
    {
        $this->db->select('*');
        $this->db->from('obat');
        $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        $this->db->join('jenis_obat', 'detail_obat.id_jenis = jenis_obat.id_jenis');
        $this->db->where('obat.id_obat', $id_obat);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {

            foreach ($query->result_array() as $row) {
                $data['-'] = '- Pilih Obat -';
                $result[$row['id_obat']] = array(
                    $row['harga_beli'],
                    $row['stok'],
                    $row['jenis']
                );
            }
        } else {
            $result['-'] = '- Belum Ada Obat -';
        }
        return $result;
    }

    public function get_jenisObat($id_jenis)
    {
        $query = $this->db->query("SELECT * FROM obat join detail_obat on obat.id_obat = detail_obat.id_obat join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE obat.id_jenis= $id_jenis");
        if ($query->num_rows() > 0) {

            foreach ($query->result_array() as $row) {
                $data['-'] = '- Jenis Obat -';
                $result[$row['id_jenis']] = ucwords(strtolower($row['jenis']));
            }
        } else {
            $result['-'] = '- Belum Ada Jenis Obat -';
        }
        return $result;
    }

    // mengambil data obat dan detailnya perbaris.
    function get_medicine()
    {
        $data = array();
        $query =  $this->db->select('*');
        $this->db->from('obat');
        $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');

        if (is_array($query) && count($query) > 0) {
            foreach ($query as $row) {
                $data[$row['nama_obat']] = $row['nama_obat'];
            }
        }
        asort($data);
        return $data;
    }

    // pembelian obat


    function purchase()
    {
        $this->db->select('*');
        $this->db->select_sum('purchase.banyak');
        $this->db->join('obat', 'purchase.id_obat = obat.id_obat');
        $this->db->join('detail_obat', 'purchase.id_obat = detail_obat.id_obat');
        $this->db->join('suplier', 'purchase.id_suplier = suplier.id_suplier');
        $this->db->join('user', 'purchase.user_id = user.user_id');

        $this->db->group_by('no_ref');
        $this->db->order_by('tgl_beli', 'DESC');

        $run_q = $this->db->get('purchase');
        return $run_q;
    }
}
