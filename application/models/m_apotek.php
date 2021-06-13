<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_apotek extends CI_Model
{
    // Model untuk data user

    public function getUser($data)
    {
        // $this->db->select('*');
        // $this->db->from('invoice');
        // $this->db->join('user', 'invoice.member_email = user.email');
        // $this->db->join('alm_user', 'user.user_id = alm_user.user_id');
        // $this->db->join('provinsi', 'alm_user.provinsi = provinsi.id_provinsi');
        // $this->db->join('kabupaten', 'alm_user.kabkot = kabupaten.id_kabupaten');
        // $this->db->join('kecamatan', 'alm_user.kecamatan = kecamatan.id_kecamatan');
        // $this->db->join('kelurahan', 'alm_user.kelurahan = kelurahan.id_kelurahan');

        // mengambil nilai dari view alamat_user
        $this->db->where('email', $data);
        return $this->db->get('alamat_user')->row_array();
    }
    public function getDataPembeli($data)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('alm_user', 'user.user_id = alm_user.user_id');
        $this->db->join('provinsi', 'alm_user.provinsi = provinsi.id_provinsi');
        $this->db->join('kabupaten', 'alm_user.kabkot = kabupaten.id_kabupaten');
        $this->db->join('kecamatan', 'alm_user.kecamatan = kecamatan.id_kecamatan');
        $this->db->join('kelurahan', 'alm_user.kelurahan = kelurahan.id_kelurahan');
        $this->db->where('email', $data);
        return $this->db->get()->result();
    }

    function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function selectAll($table)
    {
        $this->db->get($table);
    }
    function getResep()
    {
        $this->db->select('id_resep,resep.gambar as gambar_resep, status, user.nama as nama_pengirim, user.email as email, waktu, keterangan, resep.user_id as id_admin');
        $this->db->from('resep');
        $this->db->join('user', 'resep.member_id = user.user_id');
        $this->db->order_by('waktu', 'DESC');
        return $this->db->get()->result_array();
    }

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

        // Mengambil Nilai dari view semua_obat_d_apotek
        return $this->db->get('semua_obat_d_apotek', $limit, $start)->result_array();
        // $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        // $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        // $this->db->order_by('obat.id_obat', 'DESC');
        // select nama_obat, harga_default, harga_beli, stok, tgl_expired from obat join detail_obat on obat.id_obat = detail_obat.id_obat  order by obat.id_obat DESC.
        // return $this->db->get('obat', $limit, $start)->result_array();
    }
    public function obatTersedia($limit, $start)
    {
        // $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        // $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        // $this->db->order_by('obat.id_obat', 'DESC');
        // return $this->db->get_where('obat', 'stok > 0 and tgl_expired >= now()', $limit, $start)->result_array();

        // mengambil isi dari view obat_tersedia
        return $this->db->get('obat_tersedia', $limit, $start)->result_array();
    }
    public function obatDijual($limit, $start, $keyword)
    {
        if ($keyword) {
            $this->db->like('nama_obat', $keyword);
        }
        $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        $this->db->order_by('obat.id_obat', 'DESC');
        return $this->db->get_where('obat', 'stok > 0 and tgl_expired >= now()', $limit, $start)->result_array();
    }
    public function obatBebas($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_obat', $keyword);
        }
        // $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        // $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        // $this->db->join('kategori', 'obat.id_kategori = kategori.id_kategori');
        // $this->db->where('obat.id_kategori', 1);
        // $this->db->order_by('obat.id_obat', 'DESC');

        // mengambil nilai dari view obat_bebas
        return $this->db->get('obat_bebas', $limit, $start)->result_array();
    }
    public function obatBebasTerbatas($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_obat', $keyword);
        }
        // $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        // $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        // $this->db->join('kategori', 'obat.id_kategori = kategori.id_kategori');
        // $this->db->where('obat.id_kategori', 2);
        // $this->db->order_by('obat.id_obat', 'DESC');

        //  // mengambil nilai dari view obat_bebas_terbatas
        return $this->db->get('obat_bebas_terbatas', $limit, $start)->result_array();
    }
    public function obatKeras($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_obat', $keyword);
        }
        // $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        // $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        // $this->db->join('kategori', 'obat.id_kategori = kategori.id_kategori');
        // $this->db->where('obat.id_kategori', 3);
        // $this->db->order_by('obat.id_obat', 'DESC');
        // Mengambil nilai dari view obat_keras
        return $this->db->get('obat_keras', $limit, $start)->result_array();
    }

    // hitung obat
    public function count_obat()
    {
        // $this->db->select('count *');
        // $this->db->join('detail_obat', 'obat.id_obat = detail_obat.id_obat');
        // $this->db->join('suplier', 'obat.id_suplier = suplier.id_suplier');
        // $this->db->order_by('obat.id_obat', 'DESC');
        // return $this->db->get_where('obat', 'stok > 0 and tgl_expired >= now()')->num_rows();
        // $query = ("SELECT COUNT(*) as jumlah FROM `obat_tersedia`");
        // return $this->db->query($query)->result_array();

        // mengambil jumlah baris dari view obat_tersedia
        return $this->db->get('obat_tersedia')->num_rows();
    }

    // hitung user
    public function count_user()
    {
        $cm =  $this->db->query('SELECT count(user_id) as totUser FROM user');
        if ($cm->num_rows() > 0) {
            foreach ($cm->result() as $get) {
                return $get->totUser;
            }
        } else {
            return FALSE;
        }
    }
    public function count_obatTerjual()
    {
        $cm =  $this->db->query('SELECT count(id_tagihan) as totObatTerjual FROM invoice');
        if ($cm->num_rows() > 0) {
            foreach ($cm->result() as $get) {
                return $get->totObatTerjual;
            }
        } else {
            return FALSE;
        }
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
        // Mengambil isi view detail_semua_obat
        $this->db->where('id_obat', $data);
        return $this->db->get('detail_semua_obat')->row();
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
    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
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
        // return $this->db->query('select *  from obat join detail_obat on obat.id_obat = detail_obat.id_obat join suplier on obat.id_suplier = suplier.id_suplier join kategori on obat.id_kategori = kategori.id_kategori join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE tgl_expired BETWEEN DATE_SUB(NOW(), INTERVAL 40 YEAR) AND NOW()');
        // Mengambil isi view obat_expired
        return $this->db->get('obat_expired');
    }

    public function hampirExp()
    {
        // return $this->db->query('select *  from obat join detail_obat on obat.id_obat = detail_obat.id_obat join suplier on obat.id_suplier = suplier.id_suplier join kategori on obat.id_kategori = kategori.id_kategori join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE tgl_expired BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 60 DAY)');
        return $this->db->get('obat_akan_kadaluarsa');
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
        // Mengambil isi dari view obat_habis
        return $this->db->get('obat_habis');
        // return $this->db->query('select *  from obat join detail_obat on obat.id_obat = detail_obat.id_obat join suplier on obat.id_suplier = suplier.id_suplier join kategori on obat.id_kategori = kategori.id_kategori join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE stok <0');
    }

    function stok_hampir_habis()
    {
        //  Mengambil isi dari view obat_hampir_habis
        return $this->db->get('obat_hampir_habis');
        // return $this->db->query('select *  from obat join detail_obat on obat.id_obat = detail_obat.id_obat join suplier on obat.id_suplier = suplier.id_suplier join kategori on obat.id_kategori = kategori.id_kategori join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE stok BETWEEN 1 AND 8');
    }

    public function countstock()
    {
        $cs =  $this->db->query('select *  from obat join detail_obat on obat.id_obat = detail_obat.id_obat join kategori on obat.id_kategori = kategori.id_kategori join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis WHERE stok < 0');
        $nullstock = $cs->num_rows();
        return $nullstock;
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


    // penjualan obat
    function invoice($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('member_email', $keyword);
        }
        // $this->db->select('*');
        // $this->db->select_sum('invoice.banyak');
        // $this->db->group_by('no_ref');
        // $this->db->order_by('tgl_beli', 'DESC');
        // ambil nilai dari view v_invoice
        return $this->db->get('v_invoice', $limit, $start)->result_array();
    }
    function allInvoice()
    {
        $this->db->select('*');
        $this->db->select_sum('invoice.banyak');
        $this->db->group_by('no_ref');
        $this->db->order_by('tgl_beli', 'DESC');
        return $this->db->get('invoice')->result_array();
    }

    function show_data($where, $table)
    {
        $this->db->select('*');
        $this->db->select_sum('banyak');
        $run_q = $this->db->get_where($table, $where);
        return $run_q;
    }
    function ambil_purchase($where, $table)
    {
        $this->db->select('*');
        $this->db->join('suplier', 'purchase.id_suplier = suplier.id_suplier');
        $this->db->select_sum('banyak');
        $run_q = $this->db->get_where($table, $where);
        return $run_q;
    }

    function show_invoice($where)
    {
        $run_q = $this->db->get_where('show_invoice', $where);
        return $run_q;
    }
    function show_purchase($where, $table)
    {
        $this->db->join('obat', 'purchase.id_obat = obat.id_obat');
        $this->db->join('suplier', 'purchase.id_suplier = suplier.id_suplier');
        $run_q = $this->db->get_where($table, $where);
        return $run_q;
    }
    // hitung invoice
    public function count_invoice()
    {
        return $this->db->get('invoice')->num_rows();
    }

    // model untuk menghapus data dari table yang tidak perlu spesifikasi apapun
    function delete_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    // pembelian obat
    function purchase($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_sup', $keyword);
            $this->db->or_like('no_ref', $keyword);
        }
        // $this->db->select('*');
        // $this->db->select_sum('purchase.banyak');
        // $this->db->join('obat', 'purchase.id_obat = obat.id_obat');
        // $this->db->join('detail_obat', 'purchase.id_obat = detail_obat.id_obat');
        // $this->db->join('suplier', 'purchase.id_suplier = suplier.id_suplier');
        // $this->db->join('user', 'purchase.user_id = user.user_id');

        // $this->db->group_by('no_ref');
        // $this->db->order_by('tgl_beli', 'DESC');

        return $this->db->get('v_purchase', $limit, $start)->result_array();
    }

    function allPurchase($where)
    {
        $this->db->select('*');
        $this->db->select_sum('purchase.banyak');
        $this->db->join('obat', 'purchase.id_obat = obat.id_obat');
        $this->db->join('detail_obat', 'purchase.id_obat = detail_obat.id_obat');
        $this->db->join('suplier', 'purchase.id_suplier = suplier.id_suplier');
        $this->db->join('user', 'purchase.user_id = user.user_id');

        return $this->db->get('purchase', $where)->result_array();
    }

    public function find($id_obat)
    {
        $result = $this->db->where('id_obat', $id_obat)->limit(1)->get('obat');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }
}
