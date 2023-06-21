<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\TemaModel;
use App\Models\SubTemaModel;
use App\Models\PembelajaranModel;
use App\Models\QuizModel;
use App\Models\SoalModel;
use App\Models\JawabSoalModel;
use App\Models\JawabQuizModel;
use App\Models\DiskusiModel;
use App\Models\NilaiSoalModel;
use App\Models\AdminModel;
use App\Models\EmailModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Dompdf\Dompdf;
use Dompdf\Options;


class Backend extends BaseController
{

    protected $loginModel;
    protected $temaModel;
    protected $subTemaModel;
    protected $pembelajaranModel;
    protected $quizModel;
    protected $soalModel;
    protected $jawabSoalModel;
    protected $jawabQuizModel;
    protected $diskusiModel;
    protected $nilaiSoalModel;
    protected $session;
    protected $adminModel;
    protected $emailModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->temaModel = new TemaModel();
        $this->subTemaModel = new SubTemaModel();
        $this->pembelajaranModel = new PembelajaranModel();
        $this->quizModel = new QuizModel();
        $this->soalModel = new SoalModel();
        $this->jawabSoalModel = new JawabSoalModel();
        $this->jawabQuizModel = new JawabQuizModel();
        $this->diskusiModel = new DiskusiModel();
        $this->nilaiSoalModel = new NilaiSoalModel();
        $this->adminModel = new AdminModel();
        $this->emailModel = new EmailModel();
        $this->session = session();
        helper(['session']);
    }

    public function index()
    {
        echo view('be/v_login.php');
    }

    public function prosesloginbe()
    {

        $telp = $this->request->getPost('telp');
        $password = $this->request->getPost('password');
        session()->set('telp', $telp);

        $data = [
            'telp' => $telp,
            'password' => $password,
        ];

        $rule = [
            'telp' => [
                'required',
                'max_length[14]',
                'is_unique[admin.telp]',
            ],
            'password' => [
                'required'
            ],
        ];

        // Get user by telp
        $user = $this->adminModel->where('status', '0')->where('telp', $data['telp'])->first();

        // If the user exists, skip the unique rule
        if ($user) {
            $rule = [
                'telp' => 'required|max_length[14]',
                'password' => 'required'
            ];
        }

        $errors = null;

        if (!$this->validateData($data, $rule)) {
            $errors = $this->validator->getErrors();
            echo view('/be/v_login.php', [
                'errors' => $errors,
            ]);
        } else {
            return redirect()->to('/home_be');
        }
    }

    public function home()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData) || isset($userData)) {
            $iduser = $userData['id'];

            $jumlahuser = $this->loginModel->where('status', '0')->findAll();
            $jumlahguru = $this->adminModel->where('status', '0')->where('role', '2')->findAll();
            $jumlahtema = $this->temaModel->where('status', '0')->where('telp', $userPhone)->findAll();
            $jumlahsubtema = $this->subTemaModel->where('status', '0')->where('telp', $userPhone)->findAll();
            $jumlahpembelajaran = $this->pembelajaranModel->where('status', '0')->where('telp', $userPhone)->findAll();
            $jumlahuser_ttl = 0;
            foreach ($jumlahuser as $data) {
                if (isset($data['koreksi']) && $data['koreksi'] == "BENAR") {
                    $jumlahuser_ttl++;
                }
            }

            $jumlah_user = count($jumlahuser);
            $jumlah_guru = count($jumlahguru);
            $jumlah_tema = count($jumlahtema);
            $jumlah_subtema = count($jumlahsubtema);
            $jumlah_pembelajaran = count($jumlahpembelajaran);

            if ($userData != null) {

                $data = [
                    'title' => 'Home | T-Learning',
                    'active' => 'T-learning',
                    'user' => $userData,
                    'totaluser' => $jumlah_user,
                    'totalguru' => $jumlah_guru,
                    'jumlahtema' => $jumlah_tema,
                    'jumlahsubtema' => $jumlah_subtema,
                    'jumlahpembelajaran' => $jumlah_pembelajaran,
                ];

                if (!empty($userData) && is_array($userData)) {
                    echo view('be/v_header.php', $data);
                    echo view('be/v_home.php', $data);
                    echo view('be/v_footer.php', $data);
                } else {
                    echo 'Data Tidak Ditemukan';
                }
            } else {
                echo 'Nomor Telepon Tidak Ditemukan';
            }
        } else {
            echo view("be/v_login.php");
        }
    }

    public function tema()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData) || isset($userData)) {
            $item =  $this->temaModel->where('telp', $userPhone)->where('status', '0')->findAll();

            $data = [
                'title' => 'Tema | T-Learning',
                'active' => 'Tema',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_tema.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function prosestambahtema()
    {
        $userPhone = session()->get('telp');

        $tema = $this->request->getPost('tema');
        $logo = $this->request->getFile('logo');
        $tematext = strtolower((string)$tema);
        $url = str_replace(' ', '-', $tematext);

        $logoname = $logo->getRandomName();

        $logo->move(ROOTPATH . 'public/uploads/icons', $logoname);

        $data = [
            'telp' => $userPhone,
            'tema' => $tema,
            'url' => $url,
            'logo' => $logoname,
        ];

        $this->temaModel->save($data);

        return redirect()->back();
    }

    public function edittema()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData) || isset($userData)) {

            $item =  $this->temaModel->where('status', '0')->where('id', $id)->first();

            $data = [
                'title' => 'Edit Tema | T-Learning',
                'active' => 'Edit Tema',
                'item' => $item,
                'user' => $userData,
                'id' => $id,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_tema_edit.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function prosesedittema()
    {
        $userPhone = session()->get('telp');

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $item = $this->temaModel->where('status', '0')->where('id', $id)->first();
        $oldlogo = $item['logo'];

        $tema = $this->request->getPost('tema');
        $logo = $this->request->getFile('logo');
        $tematext = strtolower((string)$tema);
        $url = str_replace(' ', '-', $tematext);

        if (isset($logo) && $logo->isValid()) {

            unlink(ROOTPATH . 'public/uploads/icons/' . $oldlogo);

            $logoname = $logo->getRandomName();
            $logo->move(ROOTPATH . 'public/uploads/icons', $logoname);

            $data = [
                'id' => $item['id'],
                'telp' => $userPhone,
                'tema' => $tema,
                'url' => $url,
                'logo' => $logoname,
            ];
        } else {
            $data = [
                'id' => $item['id'],
                'telp' => $userPhone,
                'tema' => $tema,
                'url' => $url,
                'logo' => $oldlogo,
            ];
        }

        $this->temaModel->save($data);

        return redirect()->to('/be_tema');
    }

    public function hapustema()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $tema = $this->temaModel->where('status', '0')->where('id', $id)->first();
        $kunci = $tema['url'];
        $subtema = $this->subTemaModel->where('status', '0')->where('kunci', $kunci)->findAll();

        $data = [
            'id' => $id,
            'telp' => $tema['telp'],
            'tema' => $tema['tema'],
            'url' => $tema['url'],
            'logo' => $tema['logo'],
            'status' => '1',
            'created_at' => $tema['created_at'],
        ];

        foreach ($subtema as $sub) {

            $item = [
                'id' => $sub['id'],
                'telp' => $sub['telp'],
                'subtema' => $sub['subtema'],
                'url' => $sub['url'],
                'kunci' => $sub['kunci'],
                'status' => '1',
                'created_at' => $sub['created_at'],
            ];

            $this->subTemaModel->save($item);

            $url = $sub['url'];
            $pembelajaran = $this->pembelajaranModel->where('status', '0')->where('kunci', $url)->findAll();

            foreach ($pembelajaran as $pb) {
                $row = [
                    'id' => $pb['id'],
                    'telp' => $pb['telp'],
                    'judul_video' => $pb['judul_video'],
                    'video' => $pb['video'],
                    'nama_video' => $pb['nama_video'],
                    'judul_materi' => $pb['judul_materi'],
                    'materi' => $pb['materi'],
                    'nama_materi' => $pb['nama_materi'],
                    'diskusi' => $pb['diskusi'],
                    'url' => $pb['url'],
                    'kunci' => $pb['kunci'],
                    'status' => '1',
                    'created_at' => $pb['created_at'],
                ];

                $this->pembelajaranModel->save($row);

                $url = $pb['url'];
                $quiz = $this->quizModel->where('status', '0')->where('url', $url)->findAll();

                foreach ($quiz as $q) {
                    $i = [
                        'id' => $q['id'],
                        'telp' => $q['telp'],
                        'soal_id' => $q['soal_id'],
                        'soal' => $q['soal'],
                        'jawaban1' => $q['jawaban1'],
                        'jawaban2' => $q['jawaban2'],
                        'opsi1' => $q['opsi1'],
                        'opsi2' => $q['opsi2'],
                        'opsi3' => $q['opsi3'],
                        'opsi4' => $q['opsi4'],
                        'detik' => $q['detik'],
                        'url' => $q['url'],
                        'kunci' => $q['kunci'],
                        'status' => '1',
                        'created_at' => $q['created_at'],
                    ];

                    $this->quizModel->save($i);

                    $soal_id = $q['soal_id'];
                    $url = $q['url'];

                    $jawabquiz = $this->jawabQuizModel->where('status', '0')->where('soal_id', $soal_id)->where('url', $url)->findAll();

                    foreach ($jawabquiz as $j) {
                        $a = [
                            'id' => $j['id'],
                            'soal_id' => $j['soal_id'],
                            'nama' => $j['nama'],
                            'telp' => $j['telp'],
                            'jawaban1' => $j['jawaban1'],
                            'jawaban2' => $j['jawaban2'],
                            'jawaban' => $j['jawaban'],
                            'screenshot' => $j['screenshot'],
                            'pembelajaran' => $j['pembelajaran'],
                            'url' => $j['url'],
                            'kunci' => $j['kunci'],
                            'status' => '1',
                            'created_at' => $j['created_at'],
                        ];

                        $this->jawabQuizModel->save($a);
                    }
                }

                $soal = $this->soalModel->where('status', '0')->where('url', $url)->findAll();

                foreach ($soal as $s) {
                    $d = [
                        'id' => $s['id'],
                        'telp' => $s['telp'],
                        'soal_id' => $s['soal_id'],
                        'soal' => $s['soal'],
                        'jawaban' => $s['jawaban'],
                        'opsi1' => $s['opsi1'],
                        'opsi2' => $s['opsi2'],
                        'opsi3' => $s['opsi3'],
                        'opsi4' => $s['opsi4'],
                        'jam' => $s['jam'],
                        'menit' => $s['menit'],
                        'detik' => $s['detik'],
                        'url' => $s['url'],
                        'kunci' => $s['kunci'],
                        'status' => '1',
                        'created_at' => $s['created_at'],
                    ];

                    $this->soalModel->save($d);

                    $soal_id = $s['soal_id'];
                    $url = $s['url'];

                    $jawabsoal = $this->jawabSoalModel->where('status', '0')->where('soal_id', $soal_id)->where('url', $url)->findAll();

                    foreach ($jawabsoal as $z) {
                        $x = [
                            'id' => $z['id'],
                            'soal_id' => $z['soal_id'],
                            'telp' => $z['telp'],
                            'nama' => $z['nama'],
                            'jawaban' => $z['jawaban'],
                            'koreksi' => $z['koreksi'],
                            'url' => $z['url'],
                            'kunci' => $z['kunci'],
                            'status' => '1',
                            'created_at' => $z['created_at'],
                        ];

                        $this->jawabSoalModel->save($x);

                        $url = $z['url'];

                        $nilaisoal = $this->nilaiSoalModel->where('status', '0')->where('url', $url)->findAll();

                        foreach ($nilaisoal as $c) {
                            $v = [
                                'id' => $c['id'],
                                'telp' => $c['telp'],
                                'nama' => $c['nama'],
                                'jumlah_soal' => $c['jumlah_soal'],
                                'penyelesaian' => $c['penyelesaian'],
                                'benar' => $c['benar'],
                                'salah' => $c['salah'],
                                'skor' => $c['skor'],
                                'pembelajaran' => $c['pembelajaran'],
                                'url' => $c['url'],
                                'kunci' => $c['kunci'],
                                'status' => '1',
                                'created_at' => $c['created_at'],
                            ];

                            $this->nilaiSoalModel->save($v);
                        }
                    }
                }
            }
        }

        $this->temaModel->save($data);

        return redirect()->back();
    }

    public function subtema()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $item =  $this->subTemaModel->where('telp', $userPhone)->where('status', '0')->findAll();
            $row =  $this->temaModel->where('status', '0')->findAll();

            $data = [
                'title' => 'Sub Tema | T-Learning',
                'active' => 'Sub Tema',
                'item' => $item,
                'row' => $row,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_subtema.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function prosestambahsub()
    {
        $userPhone = session()->get('telp');

        $urltema = $this->request->getPost('kunci');

        $tema = $this->temaModel->where('status', '0')->where('url', $urltema)->first();
        $kunci = $tema['url'];

        $subtema = (string) $this->request->getPost('subtema');
        $subtema = preg_replace('/[^A-Za-z0-9\-]/', ' ', $subtema);
        $subtema = trim($subtema);
        $subtema = preg_replace('/\s+/', ' ', $subtema);
        $subtema = strtolower($subtema);
        $url = str_replace(" ", "-", $subtema);

        $judul = $this->request->getPost('subtema');

        $data = [
            'telp' => $userPhone,
            'subtema' => $judul,
            'url' => $url,
            'kunci' => $kunci
        ];

        $this->subTemaModel->save($data);

        return redirect()->back();
    }

    public function editsub()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $subparts = explode('&', $parts[1]);
        $temaurl = $subparts[0];
        $tema = $this->temaModel->where('status', '0')->where('url', $temaurl)->first();
        $namatema = $tema['tema'];

        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $id = $parts[2];
            $item =  $this->subTemaModel->where('status', '0')->where('id', $id)->first();

            $row =  $this->temaModel->where('status', '0')->findAll();

            $data = [
                'title' => 'Edit Subtema | T-Learning',
                'active' => 'Edit Subtema',
                'url' => $temaurl,
                'item' => $item,
                'user' => $userData,
                'id' => $id,
                'row' => $row,
                'namatema' => $namatema,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_sub_edit.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function proseseditsub()
    {
        $userPhone = session()->get('telp');

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $urltema = $parts[1];
        $id = $parts[2];

        $subtema = (string) $this->request->getPost('judul');
        $subtema = preg_replace('/[^A-Za-z0-9\-]/', ' ', $subtema);
        $subtema = trim($subtema);
        $subtema = preg_replace('/\s+/', ' ', $subtema);
        $subtema = strtolower($subtema);
        $url = str_replace(" ", "-", $subtema);

        $item = $this->subTemaModel->where('status', '0')->where('id', $id)->first();
        $kunci = $item['kunci'];

        $judul = $this->request->getPost('judul');

        $data = [
            'id' => $id,
            'telp' => $userPhone,
            'subtema' => $judul,
            'url' => $url,
            'kunci' => $kunci
        ];

        $this->subTemaModel->save($data);

        return redirect()->to('be_subtema');
    }

    public function hapussub()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $subtema = $this->subTemaModel->where('status', '0')->where('id', $id)->first();

        $item = [
            'id' => $subtema['id'],
            'telp' => $subtema['telp'],
            'subtema' => $subtema['subtema'],
            'url' => $subtema['url'],
            'kunci' => $subtema['kunci'],
            'status' => '1',
            'created_at' => $subtema['created_at'],
        ];

        $url = $subtema['url'];
        $pembelajaran = $this->pembelajaranModel->where('status', '0')->where('kunci', $url)->findAll();

        foreach ($pembelajaran as $pb) {
            $row = [
                'id' => $pb['id'],
                'telp' => $pb['telp'],
                'judul_video' => $pb['judul_video'],
                'video' => $pb['video'],
                'nama_video' => $pb['nama_video'],
                'judul_materi' => $pb['judul_materi'],
                'materi' => $pb['materi'],
                'nama_materi' => $pb['nama_materi'],
                'diskusi' => $pb['diskusi'],
                'url' => $pb['url'],
                'kunci' => $pb['kunci'],
                'status' => '1',
                'created_at' => $pb['created_at'],
            ];

            $this->pembelajaranModel->save($row);

            $url = $pb['url'];
            $quiz = $this->quizModel->where('status', '0')->where('url', $url)->findAll();

            foreach ($quiz as $q) {
                $i = [
                    'id' => $q['id'],
                    'telp' => $q['telp'],
                    'soal_id' => $q['soal_id'],
                    'soal' => $q['soal'],
                    'jawaban1' => $q['jawaban1'],
                    'jawaban2' => $q['jawaban2'],
                    'opsi1' => $q['opsi1'],
                    'opsi2' => $q['opsi2'],
                    'opsi3' => $q['opsi3'],
                    'opsi4' => $q['opsi4'],
                    'detik' => $q['detik'],
                    'url' => $q['url'],
                    'kunci' => $q['kunci'],
                    'status' => '1',
                    'created_at' => $q['created_at'],
                ];

                $this->quizModel->save($i);

                $soal_id = $q['soal_id'];
                $url = $q['url'];

                $jawabquiz = $this->jawabQuizModel->where('status', '0')->where('soal_id', $soal_id)->where('url', $url)->findAll();

                foreach ($jawabquiz as $j) {
                    $a = [
                        'id' => $j['id'],
                        'soal_id' => $j['soal_id'],
                        'nama' => $j['nama'],
                        'telp' => $j['telp'],
                        'jawaban1' => $j['jawaban1'],
                        'jawaban2' => $j['jawaban2'],
                        'jawaban' => $j['jawaban'],
                        'screenshot' => $j['screenshot'],
                        'pembelajaran' => $j['pembelajaran'],
                        'url' => $j['url'],
                        'kunci' => $j['kunci'],
                        'status' => '1',
                        'created_at' => $j['created_at'],
                    ];

                    $this->jawabQuizModel->save($a);
                }
            }

            $soal = $this->soalModel->where('status', '0')->where('url', $url)->findAll();

            foreach ($soal as $s) {
                $d = [
                    'id' => $s['id'],
                    'telp' => $s['telp'],
                    'soal_id' => $s['soal_id'],
                    'soal' => $s['soal'],
                    'jawaban' => $s['jawaban'],
                    'opsi1' => $s['opsi1'],
                    'opsi2' => $s['opsi2'],
                    'opsi3' => $s['opsi3'],
                    'opsi4' => $s['opsi4'],
                    'jam' => $s['jam'],
                    'menit' => $s['menit'],
                    'detik' => $s['detik'],
                    'url' => $s['url'],
                    'kunci' => $s['kunci'],
                    'status' => '1',
                    'created_at' => $s['created_at'],
                ];

                $this->soalModel->save($d);

                $soal_id = $s['soal_id'];
                $url = $s['url'];

                $jawabsoal = $this->jawabSoalModel->where('status', '0')->where('soal_id', $soal_id)->where('url', $url)->findAll();

                foreach ($jawabsoal as $z) {
                    $x = [
                        'id' => $z['id'],
                        'soal_id' => $z['soal_id'],
                        'telp' => $z['telp'],
                        'nama' => $z['nama'],
                        'jawaban' => $z['jawaban'],
                        'koreksi' => $z['koreksi'],
                        'url' => $z['url'],
                        'kunci' => $z['kunci'],
                        'status' => '1',
                        'created_at' => $z['created_at'],
                    ];

                    $this->jawabSoalModel->save($x);

                    $url = $z['url'];

                    $nilaisoal = $this->nilaiSoalModel->where('status', '0')->where('url', $url)->findAll();

                    foreach ($nilaisoal as $c) {
                        $v = [
                            'id' => $c['id'],
                            'telp' => $c['telp'],
                            'nama' => $c['nama'],
                            'jumlah_soal' => $c['jumlah_soal'],
                            'penyelesaian' => $c['penyelesaian'],
                            'benar' => $c['benar'],
                            'salah' => $c['salah'],
                            'skor' => $c['skor'],
                            'pembelajaran' => $c['pembelajaran'],
                            'url' => $c['url'],
                            'kunci' => $c['kunci'],
                            'status' => '1',
                            'created_at' => $c['created_at'],
                        ];

                        $this->nilaiSoalModel->save($v);
                    }
                }
            }
        }
        $this->subTemaModel->save($item);

        return redirect()->back();
    }

    public function pembelajaran()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $item =  $this->pembelajaranModel->where('status', '0')->where('telp', $userPhone)->findAll();

            $data = [
                'title' => 'Pembelajaran | T-Learning',
                'active' => 'Pembelajaran',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_pembelajaran.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function tambahpembelajaran()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData || isset($userData))) {

            $row =  $this->temaModel->where('status', '0')->findAll();
            $item = $this->subTemaModel->where('status', '0')->findAll();

            $data = [
                'title' => 'Tambah Pembelajaran | T-Learning',
                'active' => 'Tambah Pembelajaran',
                'user' => $userData,
                'row' => $row,
                'item' => $item,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_pembelajaran_tambah.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function prosestambahpembelajaran()
    {
        $userPhone = session()->get('telp');

        $urltema = $this->request->getPost('url');

        // Ambil file yang di-upload
        $videoFile = $this->request->getFile('video');
        $videoFileName = $videoFile->getName();
        $materiFile = $this->request->getFile('materi');
        $materiFileName = $materiFile->getName();

        if (!$videoFile->isValid() || $videoFile->getSize() > 104857600 || !in_array($videoFile->getExtension(), ['mp4', 'mkv', 'avi'])) {
            return redirect()->back()->withInput()->with('error', 'File video tidak valid atau melebihi ukuran maksimum (100 MB) atau bukan tipe file yang diizinkan (mp4, mkv, avi)');
        }

        // Generate nama unik untuk file
        $videoName = $videoFile->getRandomName();
        $materiName = $materiFile->getRandomName();

        // Pindahkan file ke direktori uploads/videos
        $videoFile->move(ROOTPATH . 'public/uploads/videos', $videoName);
        $materiFile->move(ROOTPATH . 'public/uploads/files', $materiName);

        // Simpan data video ke database
        $data = [
            'telp' => $userPhone,
            'pembelajaran' => $this->request->getPost('pembelajaran'),
            'judul_video' => $this->request->getPost('judulvideo'),
            'video' => $videoName,
            'nama_video' => $videoFileName,
            'judul_materi' => $this->request->getPost('judulmateri'),
            'materi' => $materiName,
            'nama_materi' => $materiFileName,
            'diskusi' => $this->request->getPost('diskusi'),
            'url' => null,
            'kunci' => $urltema,
            'created_at' => null,
        ];
        $this->pembelajaranModel->insert($data);

        $latestUser = $this->pembelajaranModel->getLatestUser();
        $id = $latestUser->id;
        $telp = $latestUser->telp;
        $pembelajaran = $latestUser->pembelajaran;
        $judul_video = $latestUser->judul_video;
        $video = $latestUser->video;
        $judul_materi = $latestUser->judul_materi;
        $materi = $latestUser->materi;
        $diskusi = $latestUser->diskusi;
        $created_at = $latestUser->created_at;

        $url = 'pembelajaran' . $id;


        $data = [
            'id' => $id,
            'telp' => $telp,
            'pembelajaran' => $pembelajaran,
            'judul_video' => $judul_video,
            'video' => $video,
            'judul_materi' => $judul_materi,
            'materi' => $materi,
            'diskusi' => $diskusi,
            'url' => $url,
            'created_at' => $created_at,
        ];

        $this->pembelajaranModel->save($data);

        return redirect()->to('/be_pembelajaran');
    }

    public function editpembelajarandata()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('telp', $userPhone)->where('status', '0')->first();

        if (!empty($userData) || isset($userData)) {

            $iduser = $userData['id'];

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $subparts = explode('&', $parts[1]);
            $subpartstema = explode('&', $parts[2]);
            $urltema = $parts[2];
            $urlkunci = $subparts[0];

            $tema = $this->pembelajaranModel->where('status', '0')->where('url', $urltema)->first();

            $data = [
                'title' => 'Edit Pembelajaran | T-Learning',
                'active' => 'Edit Pembelajaran',
                'item' => $tema,
                'url' => $urltema,
                'kunci' => $urlkunci,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_pembelajaran_edit_data.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function proseseditpembelajarandata()
    {
        $userPhone = session()->get('telp');

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $subparts = explode('&', $parts[1]);
        $urltema = $parts[2];
        $urlkunci = $subparts[0];

        $tema = $this->pembelajaranModel->where('status', '0')->where('url', $urltema)->first();
        $id = $tema['id'];
        $oldvideo = $tema['video'];
        $oldvideoname = $tema['nama_video'];
        $oldmateri = $tema['materi'];
        $oldmateriname = $tema['nama_materi'];

        $video = $this->request->getFile('video');
        $materi = $this->request->getFile('materi');

        // jika ada file yang diupload
        if ($video && $video->isValid() && $materi && $materi->isValid()) {
            // hapus file lama
            unlink(ROOTPATH . 'public/uploads/videos/' . $oldvideo);
            unlink(ROOTPATH . 'public/uploads/files/' . $oldmateri);

            // Ambil file yang di-upload
            $videoFile = $this->request->getFile('video');
            $videoFileName = $videoFile->getName();
            $materiFile = $this->request->getFile('materi');
            $materiFileName = $materiFile->getName();

            // Generate nama unik untuk file
            $videoName = $videoFile->getRandomName();
            $materiName = $materiFile->getRandomName();

            // Pindahkan file ke direktori uploads/videos
            $videoFile->move(ROOTPATH . 'public/uploads/videos', $videoName);
            $materiFile->move(ROOTPATH . 'public/uploads/files', $materiName);

            // Simpan data video ke database
            $data = [
                'id' => $id,
                'telp' => $userPhone,
                'pembelajaran' => $this->request->getPost('pembelajaran'),
                'judul_video' => $this->request->getPost('judulvideo'),
                'video' => $videoName,
                'nama_video' => $videoFileName,
                'judul_materi' => $this->request->getPost('judulmateri'),
                'materi' => $materiName,
                'nama_materi' => $materiFileName,
                'diskusi' => $this->request->getPost('diskusi'),
                'url' => $urltema,
                'kunci' => $urlkunci,
                'created_at' => null,
            ];
        } elseif ($video && $video->isValid()) {
            // hapus file lama
            unlink(ROOTPATH . 'public/uploads/videos/' . $oldvideo);

            // Ambil file yang di-upload
            $videoFile = $this->request->getFile('video');
            $videoFileName = $videoFile->getName();

            // Generate nama unik untuk file
            $videoName = $videoFile->getRandomName();

            // Pindahkan file ke direktori uploads/videos
            $videoFile->move(ROOTPATH . 'public/uploads/videos', $videoName);

            // Simpan data video ke database
            $data = [
                'id' => $id,
                'telp' => $userPhone,
                'pembelajaran' => $this->request->getPost('pembelajaran'),
                'judul_video' => $this->request->getPost('judulvideo'),
                'video' => $videoName,
                'nama_video' => $videoFileName,
                'judul_materi' => $this->request->getPost('judulmateri'),
                'materi' => $oldmateri,
                'nama_materi' => $oldmateriname,
                'diskusi' => $this->request->getPost('diskusi'),
                'url' => $urltema,
                'kunci' => $urlkunci,
                'created_at' => null,
            ];
        } elseif ($materi && $materi->isValid()) {
            // hapus file lama
            unlink(ROOTPATH . 'public/uploads/files/' . $oldmateri);

            // Ambil file yang di-upload
            $materiFile = $this->request->getFile('materi');
            $materiFileName = $materiFile->getName();

            // Generate nama unik untuk file
            $materiName = $materiFile->getRandomName();

            // Pindahkan file ke direktori uploads/videos
            $materiFile->move(ROOTPATH . 'public/uploads/files', $materiName);

            // Simpan data video ke database
            $data = [
                'id' => $id,
                'telp' => $userPhone,
                'pembelajaran' => $this->request->getPost('pembelajaran'),
                'judul_video' => $this->request->getPost('judulvideo'),
                'video' => $oldvideo,
                'nama_video' => $oldvideoname,
                'judul_materi' => $this->request->getPost('judulmateri'),
                'materi' => $materiName,
                'nama_materi' => $materiFileName,
                'diskusi' => $this->request->getPost('diskusi'),
                'url' => $urltema,
                'kunci' => $urlkunci,
                'created_at' => null,
            ];
        } else {
            $data = [
                'id' => $id,
                'telp' => $userPhone,
                'pembelajaran' => $this->request->getPost('pembelajaran'),
                'judul_video' => $this->request->getPost('judulvideo'),
                'video' => $oldvideo,
                'nama_video' => $oldvideoname,
                'judul_materi' => $this->request->getPost('judulmateri'),
                'materi' => $oldmateri,
                'nama_materi' => $oldmateriname,
                'diskusi' => $this->request->getPost('diskusi'),
                'url' => $urltema,
                'kunci' => $urlkunci,
                'created_at' => null,
            ];
        }

        $this->pembelajaranModel->where('url', $urltema)->save($data);

        return redirect()->to('/be_pembelajaran');
    }

    public function hapuspembelajarandata()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $pembelajaran = $this->pembelajaranModel->where('status', '0')->where('id', $id)->first();

        $row = [
            'id' => $pembelajaran['id'],
            'telp' => $pembelajaran['telp'],
            'judul_video' => $pembelajaran['judul_video'],
            'video' => $pembelajaran['video'],
            'nama_video' => $pembelajaran['nama_video'],
            'judul_materi' => $pembelajaran['judul_materi'],
            'materi' => $pembelajaran['materi'],
            'nama_materi' => $pembelajaran['nama_materi'],
            'diskusi' => $pembelajaran['diskusi'],
            'url' => $pembelajaran['url'],
            'kunci' => $pembelajaran['kunci'],
            'status' => '1',
            'created_at' => $pembelajaran['created_at'],
        ];

        $this->pembelajaranModel->save($row);

        $url = $pembelajaran['url'];
        $quiz = $this->quizModel->where('status', '0')->where('url', $url)->findAll();

        foreach ($quiz as $q) {
            $i = [
                'id' => $q['id'],
                'telp' => $q['telp'],
                'soal_id' => $q['soal_id'],
                'soal' => $q['soal'],
                'jawaban1' => $q['jawaban1'],
                'jawaban2' => $q['jawaban2'],
                'opsi1' => $q['opsi1'],
                'opsi2' => $q['opsi2'],
                'opsi3' => $q['opsi3'],
                'opsi4' => $q['opsi4'],
                'detik' => $q['detik'],
                'url' => $q['url'],
                'kunci' => $q['kunci'],
                'status' => '1',
                'created_at' => $q['created_at'],
            ];

            $this->quizModel->save($i);

            $soal_id = $q['soal_id'];
            $url = $q['url'];

            $jawabquiz = $this->jawabQuizModel->where('status', '0')->where('soal_id', $soal_id)->where('url', $url)->findAll();

            foreach ($jawabquiz as $j) {
                $a = [
                    'id' => $j['id'],
                    'soal_id' => $j['soal_id'],
                    'nama' => $j['nama'],
                    'telp' => $j['telp'],
                    'jawaban1' => $j['jawaban1'],
                    'jawaban2' => $j['jawaban2'],
                    'jawaban' => $j['jawaban'],
                    'screenshot' => $j['screenshot'],
                    'pembelajaran' => $j['pembelajaran'],
                    'url' => $j['url'],
                    'kunci' => $j['kunci'],
                    'status' => '1',
                    'created_at' => $j['created_at'],
                ];

                $this->jawabQuizModel->save($a);
            }
        }

        $soal = $this->soalModel->where('status', '0')->where('url', $url)->findAll();

        foreach ($soal as $s) {
            $d = [
                'id' => $s['id'],
                'telp' => $s['telp'],
                'soal_id' => $s['soal_id'],
                'soal' => $s['soal'],
                'jawaban' => $s['jawaban'],
                'opsi1' => $s['opsi1'],
                'opsi2' => $s['opsi2'],
                'opsi3' => $s['opsi3'],
                'opsi4' => $s['opsi4'],
                'jam' => $s['jam'],
                'menit' => $s['menit'],
                'detik' => $s['detik'],
                'url' => $s['url'],
                'kunci' => $s['kunci'],
                'status' => '1',
                'created_at' => $s['created_at'],
            ];

            $this->soalModel->save($d);

            $soal_id = $s['soal_id'];
            $url = $s['url'];

            $jawabsoal = $this->jawabSoalModel->where('status', '0')->where('soal_id', $soal_id)->where('url', $url)->findAll();

            foreach ($jawabsoal as $z) {
                $x = [
                    'id' => $z['id'],
                    'soal_id' => $z['soal_id'],
                    'telp' => $z['telp'],
                    'nama' => $z['nama'],
                    'jawaban' => $z['jawaban'],
                    'koreksi' => $z['koreksi'],
                    'url' => $z['url'],
                    'kunci' => $z['kunci'],
                    'status' => '1',
                    'created_at' => $z['created_at'],
                ];

                $this->jawabSoalModel->save($x);

                $url = $z['url'];

                $nilaisoal = $this->nilaiSoalModel->where('status', '0')->where('url', $url)->findAll();

                foreach ($nilaisoal as $c) {
                    $v = [
                        'id' => $c['id'],
                        'telp' => $c['telp'],
                        'nama' => $c['nama'],
                        'jumlah_soal' => $c['jumlah_soal'],
                        'penyelesaian' => $c['penyelesaian'],
                        'benar' => $c['benar'],
                        'salah' => $c['salah'],
                        'skor' => $c['skor'],
                        'pembelajaran' => $c['pembelajaran'],
                        'url' => $c['url'],
                        'kunci' => $c['kunci'],
                        'status' => '1',
                        'created_at' => $c['created_at'],
                    ];

                    $this->nilaiSoalModel->save($v);
                }
            }
        }

        return redirect()->back();
    }

    public function quiz()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $idpembelajaran = $parts[1];

            $item =  $this->quizModel->where('status', '0')->where('telp', $userPhone)->where('url', $idpembelajaran)->findAll();

            $data = [
                'title' => 'Quiz | T-Learning',
                'active' => 'Quiz',
                'item' => $item,
                'user' => $userData,
                'idpembelajaran' => $idpembelajaran,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_quiz.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function createquiz()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $idpembelajaran = $parts[1];

            $data = [
                'title' => 'Tambah Quiz | T-Learning',
                'active' => 'Tambah Quiz',
                'idpembelajaran' => $idpembelajaran,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_quiz_tambah.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function prosescreatequiz()
    {
        $userPhone = session()->get('telp');

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $urltema = $parts[1];

        $pembelajaranData = $this->pembelajaranModel->where('status', '0')->where('url', $urltema)->first();
        $urlkunci = $pembelajaranData['kunci'];
        $pembelajaran = $pembelajaranData['pembelajaran'];

        $item = $this->quizModel->getLastRow($urltema);

        $hours = $this->request->getPost('jam');
        $minutes = $this->request->getPost('menit');
        $seconds = ((int)$hours * 3600) + ((int)$minutes * 60);

        if ($item == null) {
            $data = [
                'telp' => $userPhone,
                'soal_id' => '1',
                'soal' => $this->request->getPost('soal'),
                'jawaban1' => $this->request->getPost('jawaban1'),
                'jawaban2' => $this->request->getPost('jawaban2'),
                'opsi1' => $this->request->getPost('opsi1'),
                'opsi2' => $this->request->getPost('opsi2'),
                'opsi3' => $this->request->getPost('opsi3'),
                'opsi4' => $this->request->getPost('opsi4'),
                'jam' => $hours,
                'menit' => $minutes,
                'detik' => $seconds,
                'pembelajaran' => $pembelajaran,
                'url' => $urltema,
                'kunci' => $urlkunci,
                'created_at' => null,
            ];
        } else {
            $soal_id = $item->soal_id;
            $idsoalbaru = $soal_id + 1;

            $data = [
                'telp' => $userPhone,
                'soal_id' => $idsoalbaru,
                'soal' => $this->request->getPost('soal'),
                'jawaban1' => $this->request->getPost('jawaban1'),
                'jawaban2' => $this->request->getPost('jawaban2'),
                'opsi1' => $this->request->getPost('opsi1'),
                'opsi2' => $this->request->getPost('opsi2'),
                'opsi3' => $this->request->getPost('opsi3'),
                'opsi4' => $this->request->getPost('opsi4'),
                'jam' => $hours,
                'menit' => $minutes,
                'detik' => $seconds,
                'pembelajaran' => $pembelajaran,
                'url' => $urltema,
                'kunci' => $urlkunci,
                'created_at' => null,
            ];
        }

        $this->quizModel->save($data);

        return redirect()->to('/be_quiz&id=' . $urltema);
    }

    public function editquiz()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $idpembelajaran = $parts[1];

            $item = $this->quizModel->where('status', '0')->where('id', $idpembelajaran)->first();

            $data = [
                'title' => 'Edit Quiz | T-Learning',
                'active' => 'Edit Quiz',
                'idpembelajaran' => $idpembelajaran,
                'user' => $userData,
                'item' => $item,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_quiz_edit.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function proseseditquiz()
    {
        $userPhone = session()->get('telp');

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $idpembelajaran = $parts[1];

        $hours = $this->request->getPost('jam');
        $minutes = $this->request->getPost('menit');
        $seconds = ((int)$hours * 3600) + ((int)$minutes * 60);

        $item = $this->quizModel->where('status', '0')->where('id', $idpembelajaran)->first();
        $pembelajaran = $item['pembelajaran'];
        $urltema = $item['url'];
        $urlkunci = $item['kunci'];

        $data = [
            'id' => $item['id'],
            'telp' => $userPhone,
            'soal_id' => $item['soal_id'],
            'soal' => $this->request->getPost('soal'),
            'jawaban1' => $this->request->getPost('jawaban1'),
            'jawaban2' => $this->request->getPost('jawaban2'),
            'opsi1' => $this->request->getPost('opsi1'),
            'opsi2' => $this->request->getPost('opsi2'),
            'opsi3' => $this->request->getPost('opsi3'),
            'opsi4' => $this->request->getPost('opsi4'),
            'jam' => $hours,
            'menit' => $minutes,
            'detik' => $seconds,
            'pembelajaran' => $pembelajaran,
            'url' => $urltema,
            'kunci' => $urlkunci,
            'created_at' => null,
        ];

        $this->quizModel->save($data);

        return redirect()->to('/be_quiz&id=' . $urltema);
    }

    public function hapusquiz()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $tema = $this->quizModel->where('status', '0')->where('id', $id)->first();

        $data = [
            'id' => $id,
            'soal_id' => $tema['soal_id'],
            'soal' => $tema['soal'],
            'jawaban1' => $tema['jawaban1'],
            'jawaban2' => $tema['jawaban2'],
            'opsi1' => $tema['opsi1'],
            'opsi2' => $tema['opsi2'],
            'opsi3' => $tema['opsi3'],
            'opsi4' => $tema['opsi4'],
            'detik' => $tema['detik'],
            'url' => $tema['url'],
            'kunci' => $tema['kunci'],
            'status' => '1',
            'created_at' => $tema['created_at'],
        ];

        $soal_id = $tema['soal_id'];
        $url = $tema['url'];

        $jawabquiz = $this->jawabQuizModel->where('status', '0')->where('soal_id', $soal_id)->where('url', $url)->findAll();

        foreach ($jawabquiz as $j) {
            $a = [
                'id' => $j['id'],
                'soal_id' => $j['soal_id'],
                'nama' => $j['nama'],
                'telp' => $j['telp'],
                'jawaban1' => $j['jawaban1'],
                'jawaban2' => $j['jawaban2'],
                'jawaban' => $j['jawaban'],
                'screenshot' => $j['screenshot'],
                'pembelajaran' => $j['pembelajaran'],
                'url' => $j['url'],
                'kunci' => $j['kunci'],
                'status' => '1',
                'created_at' => $j['created_at'],
            ];

            $this->jawabQuizModel->save($a);
        }

        $this->quizModel->save($data);

        return redirect()->back();
    }

    public function soal()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $id = $parts[1];

            $item =  $this->soalModel->where('status', '0')->where('telp', $userPhone)->where('url', $id)->findAll();

            $data = [
                'title' => 'Soal | T-Learning',
                'active' => 'Soal',
                'item' => $item,
                'user' => $userData,
                'id' => $id,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_soal.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function createsoal()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $id = $parts[1];

            $data = [
                'title' => 'Tambah Soal | T-Learning',
                'active' => 'Tambah Soal',
                'user' => $userData,
                'id' => $id,
                'jam' => '',
                'menit' => '',
                'detik' => '',
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_soal_tambah.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function prosescreatesoal()
    {
        $userPhone = session()->get('telp');

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $urltema = $parts[1];

        $pembelajaranData = $this->pembelajaranModel->where('status', '0')->where('url', $urltema)->first();
        $urlkunci = $pembelajaranData['kunci'];
        $pembelajaran = $pembelajaranData['pembelajaran'];

        $item = $this->soalModel->getLastRow($urltema);

        $hours = $this->request->getPost('jam');
        $minutes = $this->request->getPost('menit');
        $seconds = ((int)$hours * 3600) + ((int)$minutes * 60);

        if ($item == null) {
            $data = [
                'telp' => $userPhone,
                'soal_id' => '1',
                'soal' => $this->request->getPost('soal'),
                'jawaban' => $this->request->getPost('jawaban'),
                'opsi1' => $this->request->getPost('opsi1'),
                'opsi2' => $this->request->getPost('opsi2'),
                'opsi3' => $this->request->getPost('opsi3'),
                'opsi4' => $this->request->getPost('jawaban'),
                'jam' => $hours,
                'menit' => $minutes,
                'detik' => $seconds,
                'pembelajaran' => $pembelajaran,
                'url' => $urltema,
                'kunci' => $urlkunci,
                'created_at' => null,
            ];
        } else {
            $soal_id = $item->soal_id;
            $idsoalbaru = $soal_id + 1;

            $data = [
                'telp' => $userPhone,
                'soal_id' => $idsoalbaru,
                'soal' => $this->request->getPost('soal'),
                'jawaban' => $this->request->getPost('jawaban'),
                'opsi1' => $this->request->getPost('opsi1'),
                'opsi2' => $this->request->getPost('opsi2'),
                'opsi3' => $this->request->getPost('opsi3'),
                'opsi4' => $this->request->getPost('jawaban'),
                'jam' => $hours,
                'menit' => $minutes,
                'detik' => $seconds,
                'pembelajaran' => $pembelajaran,
                'url' => $urltema,
                'kunci' => $urlkunci,
                'created_at' => null,
            ];
        }

        $this->soalModel->save($data);

        return redirect()->to('/be_soal&id=' . $urltema);
    }

    public function editsoal()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $id = $parts[1];

            $item = $this->soalModel->where('status', '0')->where('id', $id)->first();

            $data = [
                'title' => 'Tambah Soal | T-Learning',
                'active' => 'Tambah Soal',
                'user' => $userData,
                'id' => $id,
                'item' => $item,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_soal_edit.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function proseseditsoal()
    {
        $userPhone = session()->get('telp');

        $hours = $this->request->getPost('jam');
        $minutes = $this->request->getPost('menit');
        $seconds = ((int)$hours * 3600) + ((int)$minutes * 60);

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $item = $this->soalModel->where('status', '0')->where('id', $id)->first();
        $pembelajaran = $item['pembelajaran'];
        $urltema = $item['url'];
        $urlkunci = $item['kunci'];

        $data = [
            'id' => $id,
            'telp' => $userPhone,
            'soal_id' => $item['soal_id'],
            'soal' => $this->request->getPost('soal'),
            'jawaban' => $this->request->getPost('jawaban'),
            'opsi1' => $this->request->getPost('opsi1'),
            'opsi2' => $this->request->getPost('opsi2'),
            'opsi3' => $this->request->getPost('opsi3'),
            'opsi4' => $this->request->getPost('jawaban'),
            'jam' => $hours,
            'menit' => $minutes,
            'detik' => $seconds,
            'pembelajaran' => $pembelajaran,
            'url' => $urltema,
            'kunci' => $urlkunci,
            'created_at' => null,
        ];

        $this->soalModel->save($data);

        return redirect()->to('/be_soal&id=' . $urltema);
    }

    public function hapussoal()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $tema = $this->soalModel->where('status', '0')->where('id', $id)->first();

        $data = [
            'id' => $id,
            'soal_id' => $tema['soal_id'],
            'soal' => $tema['soal'],
            'jawaban' => $tema['jawaban'],
            'opsi1' => $tema['opsi1'],
            'opsi2' => $tema['opsi2'],
            'opsi3' => $tema['opsi3'],
            'opsi4' => $tema['opsi4'],
            'jam' => $tema['jam'],
            'menit' => $tema['menit'],
            'detik' => $tema['detik'],
            'url' => $tema['url'],
            'kunci' => $tema['kunci'],
            'status' => '1',
            'created_at' => $tema['created_at'],
        ];

        $soal_id = $tema['soal_id'];
        $url = $tema['url'];

        $jawabsoal = $this->jawabSoalModel->where('status', '0')->where('soal_id', $soal_id)->where('url', $url)->findAll();

        foreach ($jawabsoal as $z) {
            $x = [
                'id' => $z['id'],
                'soal_id' => $z['soal_id'],
                'telp' => $z['telp'],
                'nama' => $z['nama'],
                'jawaban' => $z['jawaban'],
                'koreksi' => $z['koreksi'],
                'url' => $z['url'],
                'kunci' => $z['kunci'],
                'status' => '1',
                'created_at' => $z['created_at'],
            ];

            $this->jawabSoalModel->save($x);

            $url = $z['url'];

            $nilaisoal = $this->nilaiSoalModel->where('status', '0')->where('url', $url)->findAll();

            foreach ($nilaisoal as $c) {
                $v = [
                    'id' => $c['id'],
                    'telp' => $c['telp'],
                    'nama' => $c['nama'],
                    'jumlah_soal' => $c['jumlah_soal'],
                    'penyelesaian' => $c['penyelesaian'],
                    'benar' => $c['benar'],
                    'salah' => $c['salah'],
                    'skor' => $c['skor'],
                    'pembelajaran' => $c['pembelajaran'],
                    'url' => $c['url'],
                    'kunci' => $c['kunci'],
                    'status' => '1',
                    'created_at' => $c['created_at'],
                ];

                $this->nilaiSoalModel->save($v);
            }
        }

        $this->soalModel->save($data);

        return redirect()->back();
    }

    public function nilaisoal()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $item =  $this->soalModel->where('status', '0')->where('telp', $userPhone)->where('soal_id', '1')->findAll();

            $data = [
                'title' => 'Nilai Soal | T-Learning',
                'active' => 'Nilai Soal',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_nilai_soal.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function nilaisoaldata()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $url = $parts[1];

            $item =  $this->nilaiSoalModel->where('status', '0')->where('url', $url)->findAll();

            $data = [
                'title' => 'Nilai Soal | T-Learning',
                'active' => 'Nilai Soal',
                'item' => $item,
                'user' => $userData,
                'url' => $url,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_nilai_soal_data.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function admin()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $item =  $this->adminModel->where('status', '0')->where('role', '1')->findAll();

            $data = [
                'title' => 'Admin | T-Learning',
                'active' => 'Admin',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_admin.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function prosesadmin()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'telp' => $this->request->getPost('telp'),
            'password' => $this->request->getPost('password'),
            'foto' => 'blank.jpg',
            'role' => '1',
        ];

        $this->adminModel->save($data);

        return redirect()->back();
    }

    public function editadmin()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $id = $parts[1];

            $item =  $this->adminModel->where('status', '0')->where('role', '1')->where('id', $id)->first();

            $data = [
                'title' => 'Edit Admin | T-Learning',
                'active' => 'Edit Admin',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_admin_edit.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function proseseditadmin()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $data = [
            'id' => $id,
            'nama' => $this->request->getPost('nama'),
            'telp' => $this->request->getPost('telp'),
            'password' => $this->request->getPost('password'),
        ];

        $this->adminModel->save($data);

        return redirect()->to('/admin');
    }

    public function hapusadmin()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $tema = $this->adminModel->where('status', '0')->where('id', $id)->first();

        $data = [
            'id' => $id,
            'nama' => $tema['nama'],
            'telp' => $tema['telp'],
            'password' => $tema['password'],
            'foto' => $tema['foto'],
            'status' => '1',
            'created_at' => $tema['created_at'],
        ];

        $this->adminModel->save($data);

        return redirect()->back();
    }

    public function guru()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $item =  $this->adminModel->where('status', '0')->where('role', '2')->findAll();

            $data = [
                'title' => 'Guru | T-Learning',
                'active' => 'Guru',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_guru.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function prosesguru()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'telp' => $this->request->getPost('telp'),
            'password' => $this->request->getPost('password'),
            'foto' => 'blank.jpg',
            'role' => '2',
        ];

        $this->adminModel->save($data);

        return redirect()->back();
    }

    public function editguru()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $id = $parts[1];

            $item =  $this->adminModel->where('status', '0')->where('role', '2')->where('id', $id)->first();

            $data = [
                'title' => 'Edit Guru | T-Learning',
                'active' => 'Edit Guru',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_guru_edit.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function proseseditguru()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $data = [
            'id' => $id,
            'nama' => $this->request->getPost('nama'),
            'telp' => $this->request->getPost('telp'),
            'password' => $this->request->getPost('password'),
        ];

        $this->adminModel->save($data);

        return redirect()->to('/guru');
    }

    public function hapusguru()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $tema = $this->adminModel->where('status', '0')->where('id', $id)->first();

        $data = [
            'id' => $id,
            'nama' => $tema['nama'],
            'telp' => $tema['telp'],
            'password' => $tema['password'],
            'foto' => $tema['foto'],
            'status' => '1',
            'created_at' => $tema['created_at'],
        ];

        $this->adminModel->save($data);

        return redirect()->back();
    }

    public function murid()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $item =  $this->loginModel->where('status', '0')->findAll();

            $data = [
                'title' => 'Murid | T-Learning',
                'active' => 'Murid',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_murid.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function prosesmurid()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'telp' => $this->request->getPost('telp'),
            'email' => $this->request->getPost('email'),
            'foto' => 'blank.jpg',
            'role' => '2',
        ];

        $this->loginModel->save($data);

        return redirect()->back();
    }

    public function editmurid()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $id = $parts[1];

            $item =  $this->loginModel->where('status', '0')->where('role', '2')->where('id', $id)->first();

            $data = [
                'title' => 'Edit Murid | T-Learning',
                'active' => 'Edit Murid',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_murid_edit.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function proseseditmurid()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $data = [
            'id' => $id,
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'telp' => $this->request->getPost('telp'),
        ];

        $this->loginModel->save($data);

        return redirect()->to('/murid');
    }

    public function hapusmurid()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $user = $this->loginModel->where('status', '0')->where('id', $id)->first();

        $data = [
            'id' => $id,
            'id_google' => $user['id_google'],
            'id_facebook' => $user['id_facebook'],
            'nama' => $user['nama'],
            'email' => $user['email'],
            'telp' => $user['telp'],
            'foto' => $user['foto'],
            'role' => $user['role'],
            'kode' => $user['kode'],
            'status' => '1',
            'created_at' => $user['created_at'],
        ];

        $this->loginModel->save($data);

        return redirect()->back();
    }

    public function email()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $item =  $this->emailModel->where('status', '0')->getLatestEmail();

            $data = [
                'title' => 'Email | T-Learning',
                'active' => 'Email',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_email.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function editemail()
    {

        $item =  $this->emailModel->where('status', '0')->getLatestEmail();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $server = $this->request->getPost('server');

        if (!empty($item) && $item->server == $server && $item->email == $email && $item->password == $password) {
            $data = [
                'id' => $item->id,
                'server' => $item->server,
                'email' => $item->email,
                'password' => $item->password,
                'status' => $item->status,
                'created_at' => $item->created_at,
            ];
        } else {
            $data = [
                'server' => $this->request->getPost('server'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ];
        }

        $this->emailModel->save($data);

        return redirect()->back();
    }

    public function nilaiquiz()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $item =  $this->quizModel->where('status', '0')->where('telp', $userPhone)->findAll();

            $data = [
                'title' => 'Nilai Quiz | T-Learning',
                'active' => 'Nilai Quiz',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_nilai_quiz.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function daftarnilaiquiz()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $url = $parts[1];

            $item =  $this->jawabQuizModel->where('status', '0')->where('url', $url)->findAll();

            $data = [
                'title' => 'Nilai Quiz | T-Learning',
                'active' => 'Nilai Quiz',
                'item' => $item,
                'user' => $userData,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_daftar_nilai_quiz_data.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function nilaiquizdata()
    {
        $userPhone = session()->get('telp');
        $userData = $this->adminModel->where('status', '0')->where('telp', $userPhone)->first();

        if (!empty($userData) || isset($userData)) {

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $url = $parts[1];

            $item =  $this->jawabQuizModel->where('status', '0')->where('url', $url)->findAll();

            $data = [
                'title' => 'Nilai Quiz | T-Learning',
                'active' => 'Nilai Quiz',
                'item' => $item,
                'user' => $userData,
                'url' => $url,
            ];

            echo view('be/v_header.php', $data);
            echo view('be/v_nilai_quiz_data.php', $data);
            echo view('be/v_footer.php', $data);
        } else {
            echo view("be/v_login.php");
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }

    public function eksporexcelquiz()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $url = $parts[1];

        $columns = ['soal_id', 'soal', 'jawaban1', 'jawaban2', 'opsi1', 'opsi2', 'opsi3', 'opsi4', 'jam', 'menit', 'detik'];

        $data = $this->quizModel->select($columns)->where('status', '0')->where('url', $url)->findAll();

        if (!empty($data)) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $header = $columns;

            $sheet->fromArray([$header], null, 'A1');

            $sheet->fromArray($data, null, 'A2');

            $writer = new Xlsx($spreadsheet);

            $now = date('Ymd_His');
            $filename = $now . '.xlsx';
            $filepath = WRITEPATH . 'uploads/excel/' . $filename;

            // Simpan file Excel
            $writer->save($filepath);

            // Set header response untuk mengunduh file
            return $this->response->download($filepath, null)->setFileName($filename);
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $header = $columns;

            $sheet->fromArray([$header], null, 'A1');

            $writer = new Xlsx($spreadsheet);

            $now = date('Ymd_His');
            $filename = $now . '.xlsx';
            $filepath = WRITEPATH . 'uploads/excel/' . $filename;

            // Simpan file Excel
            $writer->save($filepath);

            // Set header response untuk mengunduh file
            return $this->response->download($filepath, null)->setFileName($filename);
        }
    }

    public function eksporexcelsoal()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $url = $parts[1];

        $columns = ['soal_id', 'soal', 'jawaban', 'opsi1', 'opsi2', 'opsi3', 'opsi4', 'jam', 'menit', 'detik'];

        $data = $this->soalModel->select($columns)->where('status', '0')->where('url', $url)->findAll();

        if (!empty($data)) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $header = $columns;

            $sheet->fromArray([$header], null, 'A1');

            $sheet->fromArray($data, null, 'A2');

            $writer = new Xlsx($spreadsheet);

            $now = date('Ymd_His');
            $filename = $now . '.xlsx';
            $filepath = WRITEPATH . 'uploads/excel/' . $filename;

            // Simpan file Excel
            $writer->save($filepath);

            // Set header response untuk mengunduh file
            return $this->response->download($filepath, null)->setFileName($filename);
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $header = $columns;

            $sheet->fromArray([$header], null, 'A1');

            $writer = new Xlsx($spreadsheet);

            $now = date('Ymd_His');
            $filename = $now . '.xlsx';
            $filepath = WRITEPATH . 'uploads/excel/' . $filename;

            // Simpan file Excel
            $writer->save($filepath);

            // Set header response untuk mengunduh file
            return $this->response->download($filepath, null)->setFileName($filename);
        }
    }

    public function eksporexcelnilaisoal()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $url = $parts[1];

        $data = $this->nilaiSoalModel->where('status', '0')->where('url', $url)->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $header = array_keys((array) $data[0]);

        $sheet->fromArray([$header], null, 'A1');

        $sheet->fromArray($data, null, 'A2');

        $writer = new Xlsx($spreadsheet);

        $now = date('Ymd_His');
        $filename = $now . '.xlsx';
        $filepath = WRITEPATH . 'uploads/excel/' . $filename;

        // Simpan file Excel
        $writer->save($filepath);

        // Set header response untuk mengunduh file
        return $this->response->download($filepath, null)->setFileName($filename);
    }
    public function eksporexcelnilaiquiz()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $url = $parts[1];

        $data = $this->jawabQuizModel->where('status', '0')->where('url', $url)->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $header = array_keys((array) $data[0]);

        $sheet->fromArray([$header], null, 'A1');

        $sheet->fromArray($data, null, 'A2');

        $writer = new Xlsx($spreadsheet);

        $now = date('Ymd_His');
        $filename = $now . '.xlsx';
        $filepath = WRITEPATH . 'uploads/excel/' . $filename;

        // Simpan file Excel
        $writer->save($filepath);

        // Set header response untuk mengunduh file
        return $this->response->download($filepath, null)->setFileName($filename);
    }

    public function importquiz()
    {
        $telp = session()->get('telp');

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $url = $parts[1];

        $item = $this->pembelajaranModel->where('status', '0')->where('url', $url)->first();
        $kunci = $item['kunci'];
        $pembelajaran = $item['pembelajaran'];

        if ($this->request->getMethod() === 'post' && $this->validate(['file' => 'uploaded[file]|ext_in[file,xlsx,xls]'])) {
            $file = $this->request->getFile('file');

            // Load file Excel
            $spreadsheet = IOFactory::load($file->getPathname());

            // Ambil data dari sheet pertama
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, true, true, true);

            $firstRow = true;

            foreach ($data as $row) {
                if ($firstRow) {
                    $firstRow = false;
                    continue; // Melewati array pertama
                }
                $data = [
                    'telp' => $telp,
                    'soal_id' => $row['A'],
                    'soal' => $row['B'],
                    'jawaban1' => $row['C'],
                    'jawaban2' => $row['D'],
                    'opsi1' => $row['E'],
                    'opsi2' => $row['F'],
                    'opsi3' => $row['G'],
                    'opsi4' => $row['H'],
                    'jam' => $row['I'],
                    'menit' => $row['J'],
                    'detik' => $row['K'],
                    'pembelajaran' => $pembelajaran,
                    'url' => $url,
                    'kunci' => $kunci,
                    'status' => '0',
                    'created_at' => null,

                ];
                $this->quizModel->save($data);
            }

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function importsoal()
    {
        $telp = session()->get('telp');

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $url = $parts[1];

        $item = $this->pembelajaranModel->where('status', '0')->where('url', $url)->first();
        $kunci = $item['kunci'];
        $pembelajaran = $item['pembelajaran'];

        if ($this->request->getMethod() === 'post' && $this->validate(['file' => 'uploaded[file]|ext_in[file,xlsx,xls]'])) {
            $file = $this->request->getFile('file');

            // Load file Excel
            $spreadsheet = IOFactory::load($file->getPathname());

            // Ambil data dari sheet pertama
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, true, true, true);

            $firstRow = true;

            foreach ($data as $row) {

                if ($firstRow) {
                    $firstRow = false;
                    continue; // Melewati array pertama
                }


                $data = [
                    'telp' => $telp,
                    'soal_id' => $row['A'],
                    'soal' => $row['B'],
                    'jawaban' => $row['C'],
                    'opsi1' => $row['D'],
                    'opsi2' => $row['E'],
                    'opsi3' => $row['F'],
                    'opsi4' => $row['G'],
                    'jam' => $row['H'],
                    'menit' => $row['I'],
                    'detik' => $row['J'],
                    'pembelajaran' => $pembelajaran,
                    'url' => $url,
                    'kunci' => $kunci,
                    'status' => '0',
                    'created_at' => null,
                ];
                $this->soalModel->save($data);
            }

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function eksporpdfsoal()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $url = $parts[1];

        $data = $this->soalModel->where('status', '0')->where('url', $url)->findAll();

        $options = new Options();
        $options->set('defaultFont', 'Arial');

        // Buat objek Dompdf
        $dompdf = new Dompdf($options);

        // Render template PDF
        $html = view('be/pdf_template/v_pdf_soal', ['data' => $data]); // Ganti 'pdf_template' dengan nama template PDF Anda

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        // Simpan atau kirimkan PDF ke browser
        $now = date('Ymd_His');
        $dompdf->stream($now . '.pdf', ['Attachment' => true]);
    }

    public function eksporpdfquiz()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $url = $parts[1];

        $data = $this->quizModel->where('status', '0')->where('url', $url)->findAll();

        $options = new Options();
        $options->set('defaultFont', 'Arial');

        // Buat objek Dompdf
        $dompdf = new Dompdf($options);

        // Render template PDF
        $html = view('be/pdf_template/v_pdf_quiz', ['data' => $data]); // Ganti 'pdf_template' dengan nama template PDF Anda

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        $now = date('Ymd_His');
        $dompdf->stream($now . '.pdf', ['Attachment' => true]);
    }

    public function eksporpdfnilaisoal()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $url = $parts[1];

        $data = $this->nilaiSoalModel->where('status', '0')->where('url', $url)->findAll();

        $options = new Options();
        $options->set('defaultFont', 'Arial');

        // Buat objek Dompdf
        $dompdf = new Dompdf($options);

        // Render template PDF
        $html = view('be/pdf_template/v_pdf_nilaisoal', ['data' => $data]); // Ganti 'pdf_template' dengan nama template PDF Anda

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        $now = date('Ymd_His');
        $dompdf->stream($now . '.pdf', ['Attachment' => true]);
    }

    public function eksporpdfnilaiquiz()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $url = $parts[1];

        $data = $this->jawabQuizModel->where('status', '0')->where('url', $url)->findAll();

        $options = new Options();
        $options->set('defaultFont', 'Arial');

        // Buat objek Dompdf
        $dompdf = new Dompdf($options);

        // Render template PDF
        $html = view('be/pdf_template/v_pdf_nilaiquiz', ['data' => $data]); // Ganti 'pdf_template' dengan nama template PDF Anda

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        $now = date('Ymd_His');
        $dompdf->stream($now . '.pdf', ['Attachment' => true]);
    }
}
