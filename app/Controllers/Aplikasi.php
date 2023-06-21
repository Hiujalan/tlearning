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

use Google_Client;

class Aplikasi extends BaseController
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
    protected $googleClient;
    protected $session;

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
        $this->googleClient = new Google_Client();
        $this->session = session();
        helper(['session']);

        $this->googleClient->setClientId('541029045705-ll53bfpqsbtmvi2cek8ubr9o2qfufma7.apps.googleusercontent.com');
        $this->googleClient->setClientSecret('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');
        $this->googleClient->setRedirectUri('http://localhost:8080/login/google');
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');
        $this->googleClient->addScope('https://www.googleapis.com/auth/user.phonenumbers.read');
    }

    public function index()
    {
        $data['link'] = $this->googleClient->createAuthUrl();

        echo view('pages/v_login.php', $data);
    }

    public function google()
    {
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if (!isset($token['error'])) {
            $this->googleClient->setAccessToken($token['access_token']);
            $googleService = new \Google_Service_Oauth2($this->googleClient);
            $row = $googleService->userinfo->get();

            $verificationCode = rand(1000, 9999);

            $item = $this->loginModel->where('status', '0')->where('email', $row['email'])->first();
            $email = $row['email'];
            session()->set('email', $email);

            if (isset($item)) {
                $data = [
                    'id' => $item['id'],
                    'id_google' => $item['id_google'],
                    'nama' => $item['nama'],
                    'email' => $item['email'],
                    'telp' => $item['telp'],
                    'foto' => $item['foto'],
                    'role' => $item['role'],
                    'kode' => $item['kode'],
                ];
            } else {
                $data = [
                    'id' => '',
                    'id_google' => $row['id'],
                    'nama' => $row['name'],
                    'email' => $row['email'],
                    'telp' => '',
                    'foto' => $row['picture'],
                    'role' => '2',
                    'kode' => $verificationCode,
                ];
            }

            $this->loginModel->save($data);

            return redirect()->to('/login/google_telp');
        }
    }

    public function googletelp()
    {
        echo view('pages/v_google_telp.php');
    }

    public function prosesgoogletelp()
    {
        $userEmail = session()->get('email');
        $userData = $this->loginModel->where('status', '0')->where('email', $userEmail)->first();

        $data = [
            'id' => $userData['id'],
            'id_google' => $userData['id_google'],
            'nama' => $userData['nama'],
            'email' => $userData['email'],
            'telp' => $this->request->getPost('telp'),
            'foto' => $userData['foto'],
            'role' => $userData['role'],
            'kode' => $userData['kode'],
        ];

        $this->loginModel->save($data);

        $telp = $this->request->getPost('telp');
        session()->set('telp', $telp);

        return redirect()->to('/home');
    }

    public function proseslogin()
    {
        $link = $this->googleClient->createAuthUrl();
        $LoginModel = new LoginModel();

        $telp = $this->request->getPost('telp');
        session()->set('telp', $telp);

        $data = [
            'telp' => $telp,
        ];

        $user = $LoginModel->where('status', '0')->where('telp', $data['telp'])->first();

        if (!empty($user)) {
            $rule['telp'] = 'required|max_length[14]';
            $errors = null;

            if (!$this->validateData($data, $rule)) {
                $errors = $this->validator->getErrors();
                echo view('/pages/v_login.php', [
                    'errors' => $errors,
                    'link' => $link,
                ]);
                // return redirect()->back()->with('errors', $errors);
            } else {
                return redirect()->to('/verifikasi');
            }
        } else {
            $errors = 'Nomor Telepon Tidak Valid';
            echo view('/pages/v_login.php', [
                'errors' => $errors,
                'link' => $link,
            ]);
        }
    }

    public function register()
    {
        echo view('pages/v_register.php');
    }

    public function prosesregister()
    {
        $telp = $this->request->getPost('telp');
        session()->set('telp', $telp);

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'telp' => $this->request->getPost('telp'),
        ];

        $rule = [
            'nama' => 'required|',
            'email' => 'required|',
            'telp' => 'required|max_length[13]',
        ];

        $errors = null;

        if (!$this->validateData($data, $rule)) {
            $errors = $this->validator->getErrors();
            echo view('/pages/v_register.php', [
                'errors' => $errors,
            ]);
        } else {

            $data = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'telp' => $this->request->getPost('telp'),
                'foto' => 'blank.jpg',
                'role' => '2',
                'created_at' => null,
            ];

            $this->loginModel->save($data);

            return redirect()->to('/verifikasi');
        }
    }

    public function verifikasi()
    {
        $telp = session()->get('telp');
        $item = $this->loginModel->where('status', '0')->where('telp', $telp)->first();

        if (empty($item)) {
            $data = [];

            $verificationCode = rand(1000, 9999);

            $latestUser = $this->loginModel->where('status', '0')->where('telp', $telp)->first();
            $id = $latestUser['id'];
            $nama = $latestUser['nama'];
            $emailuser = $latestUser['email'];
            $telp = $latestUser['telp'];
            $role = $latestUser['role'];
            $created_at = $latestUser['created_at'];

            if (!empty($telp)) {
                $data = [
                    'id' => $id,
                    'nama' => $nama,
                    'email' => $emailuser,
                    'telp' => $telp,
                    'role' => $role,
                    'kode' => $verificationCode,
                    'created_at' => $created_at,
                ];

                $this->loginModel->save($data);

                $latestUser = $this->loginModel->where('status', '0')->where('telp', $telp)->first();
                $kode = $latestUser['kode'];

                $email_to = $emailuser;
                $subject = "Kode OTP T-Learning";
                $message = "Kode OTP untuk verifikasi Anda adalah: " . $kode;

                $email = service('email');
                $email->setTo($email_to);
                $email->setFrom('admin@tlearning.com', 'T-learning');
                $email->setSubject($subject);
                $email->setMessage($message);

                if ($email->send()) {
                    echo "";
                } else {
                    $data = $email->printDebugger(['headers']);
                    print_r($data);
                }
            }

            echo view('pages/v_verifikasi_telp.php', $data);
        } else {
            $data = [];

            $verificationCode = rand(1000, 9999);

            $latestUser = $this->loginModel->where('status', '0')->where('telp', $telp)->first();
            $id = $latestUser['id'];
            $nama = $latestUser['nama'];
            $emailuser = $latestUser['email'];
            $telp = $latestUser['telp'];
            $role = $latestUser['role'];
            $created_at = $latestUser['created_at'];

            if (!empty($telp)) {
                $data = [
                    'id' => $id,
                    'nama' => $nama,
                    'email' => $emailuser,
                    'telp' => $telp,
                    'role' => $role,
                    'kode' => $verificationCode,
                    'created_at' => $created_at,
                ];

                $this->loginModel->save($data);

                $latestUser = $this->loginModel->where('status', '0')->where('telp', $telp)->first();
                $kode = $latestUser['kode'];

                $email_to = $emailuser;
                $subject = "Kode OTP T-Learning";
                $message = "Kode OTP untuk verifikasi Anda adalah: " . $kode;

                $email = service('email');
                $email->setTo($email_to);
                $email->setFrom('admin@tlearning.com', 'T-learning');
                $email->setSubject($subject);
                $email->setMessage($message);

                if ($email->send()) {
                    echo "";
                } else {
                    $data = $email->printDebugger(['headers']);
                    print_r($data);
                }
            }

            echo view('pages/v_verifikasi_telp.php', $data);
        }
    }

    public function prosesverifikasi()
    {
        $telp = session()->get('telp');

        $kodeverif = $this->request->getPost('kodeverif');

        $latestUser = $this->loginModel->where('status', '0')->where('telp', $telp)->first();
        $id = $latestUser['id'];
        $nama = $latestUser['nama'];
        $email = $latestUser['email'];
        $telp = $latestUser['telp'];
        $role = $latestUser['role'];
        $created_at = $latestUser['created_at'];
        $kode = $latestUser['kode'];


        if ($kodeverif == $kode) {
            $data = [
                'id' => $id,
                'nama' => $nama,
                'email' => $email,
                'telp' => $telp,
                'role' => $role,
                'kode' => $kodeverif,
                'created_at' => $created_at,
            ];

            $this->loginModel->save($data);

            return redirect()->to('/home');
        } else {
            return redirect()->to('/verifikasi');
        }
    }

    public function home()
    {
        $LoginModel = new LoginModel();
        $userPhone = session()->get('telp');
        $userData = $LoginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];

            if ($userData != null) {
                $tema = $this->temaModel->where('status', '0')->findAll();

                $data = [
                    'title' => 'Home | T-Learning',
                    'active' => 'T-learning',
                    'tema' => $tema,
                    'role' => $userData['role'],
                    'iduser' => $iduser,
                ];

                if (!empty($userData) && is_array($userData)) {
                    echo view('pages/v_header.php', $data);
                    echo view('pages/v_home.php', $data);
                    echo view('pages/v_footer.php', $data);
                } else {
                    echo 'Data Tidak Ditemukan';
                }
            } else {
                echo 'Nomor Telepon Tidak Ditemukan';
            }
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function cari()
    {
        $LoginModel = new LoginModel();
        $userPhone = session()->get('telp');
        $userData = $LoginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];
            $telpuser = $userData['telp'];

            $data = [
                'title' => 'Cari | T-Learning',
                'active' => 'Cari',
                'role' => $userData['role'],
                'iduser' => $iduser,
                'telpuser' => $telpuser,
            ];

            echo view('pages/v_header.php', $data);
            echo view('pages/v_cari.php', $data);
            echo view('pages/v_footer.php', $data);
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function ajaxcari()
    {
        $id = $this->request->getGet('id');

        $data = [
            'dt_hasil' => $this->temaModel->search($id),
        ];

        return view('pages/v_ajax_cari.php', $data);
    }

    public function tema()
    {

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $subparts = explode('&', $parts[1]);
        $temaurl = $subparts[0];
        $tema = $this->temaModel->where('status', '0')->where('url', $temaurl)->first();
        $datatema = $tema['tema'];
        $url = $tema['url'];

        $userPhone = session()->get('telp');
        $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];

            $item =  $this->subTemaModel->where('status', '0')->where('kunci', $url)->findAll();

            $data = [
                'title' => 'Tema | T-Learning',
                'active' => 'Tema',
                'tema' => $datatema,
                'role' => $userData['role'],
                'url' => $url,
                'item' => $item,
                'iduser' => $iduser,
            ];

            echo view('pages/v_header.php', $data);
            echo view('app/v_tema.php', $data);
            echo view('pages/v_footer.php', $data);
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function subtema()
    {
        $userPhone = session()->get('telp');
        $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $subparts = explode('&', $parts[1]);
            $urltema = $parts[2];
            $urlkunci = $subparts[0];

            $tema = $this->subTemaModel->where('status', '0')->where('url', $urltema)->first();
            $datasubtema = $tema['subtema'];
            $url = $tema['url'];

            $pembelajaran = $this->pembelajaranModel->where('status', '0')->where('kunci', $urltema)->findAll();

            $data = [
                'title' => 'Subtema | T-Learning',
                'active' => 'Subtema',
                'role' => $userData['role'],
                'subtema' => $datasubtema,
                'url' => $url,
                'kunci' => $urlkunci,
                'pembelajaran' => $pembelajaran,
                'iduser' => $iduser,
            ];

            echo view('pages/v_header.php', $data);
            echo view('app/v_subtema.php', $data);
            echo view('pages/v_footer.php', $data);
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function pembelajaran()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];

            $this->session->remove('soal_id');

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $subparts = explode('&', $parts[1]);
            $subpartstema = explode('&', $parts[2]);
            $urltema = $parts[3];
            $urlkunci = $subpartstema[0];
            $urltemapembelajaran = $subparts[0];

            $item = $this->pembelajaranModel->where('status', '0')->where('url', $urltema)->first();
            $diskusi = $item['diskusi'];

            $quiz = $this->soalModel->where('status', '0')->where('url', $urltema)->first();

            $soal = $this->nilaiSoalModel->where('status', '0')->where('url', $urltema)->where('telp', $userPhone)->first();

            if ($quiz == null) {
                if (!empty($soal)) {
                    $data = [
                        'title' => 'Pembelajaran | T-Learning',
                        'active' => 'Pembelajaran',
                        'role' => $userData['role'],
                        'item' => $item,
                        'url' => $urltema,
                        'kunci' => $urlkunci,
                        'tema' => $urltemapembelajaran,
                        'diskusi' => $diskusi,
                        'iduser' =>  $iduser,
                        'idsoal' => null,
                        'jawabsoal' => '0',
                    ];
                } else {
                    $data = [
                        'title' => 'Pembelajaran | T-Learning',
                        'active' => 'Pembelajaran',
                        'role' => $userData['role'],
                        'item' => $item,
                        'url' => $urltema,
                        'kunci' => $urlkunci,
                        'tema' => $urltemapembelajaran,
                        'diskusi' => $diskusi,
                        'iduser' =>  $iduser,
                        'idsoal' => null,
                        'jawabsoal' => null,
                    ];
                }
            } else {
                if (!empty($soal)) {
                    $data = [
                        'title' => 'Pembelajaran | T-Learning',
                        'active' => 'Pembelajaran',
                        'role' => $userData['role'],
                        'item' => $item,
                        'url' => $urltema,
                        'kunci' => $urlkunci,
                        'tema' => $urltemapembelajaran,
                        'diskusi' => $diskusi,
                        'iduser' =>  $iduser,
                        'idsoal' => $quiz['soal_id'],
                        'jawabsoal' => '0',
                    ];
                } else {
                    $data = [
                        'title' => 'Pembelajaran | T-Learning',
                        'active' => 'Pembelajaran',
                        'role' => $userData['role'],
                        'item' => $item,
                        'url' => $urltema,
                        'kunci' => $urlkunci,
                        'tema' => $urltemapembelajaran,
                        'diskusi' => $diskusi,
                        'iduser' =>  $iduser,
                        'idsoal' => $quiz['soal_id'],
                        'jawabsoal' => null,
                    ];
                }
            }

            echo view('pages/v_header.php', $data);
            echo view('app/v_pembelajaran.php', $data);
            echo view('pages/v_footer.php', $data);
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function downloadfile()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $urltema = $parts[1];

        $item = $this->pembelajaranModel->where('status', '0')->where('url', $urltema)->first();
        $filename = $item['materi'];

        $file_path = ROOTPATH . 'public/uploads/files/' . $filename;

        // Set header file
        $mime_type = mime_content_type($file_path);
        $response = service('response');
        $response->setHeader('Content-Type', $mime_type);
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $response->setHeader('Cache-Control', 'max-age=0');

        // Tampilkan file
        return $response->download($file_path, null);
    }

    public function quiz()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $subparts = explode('&', $parts[1]);
            $subpartstema = explode('&', $parts[2]);
            $urltema = $parts[3];
            $urlkunci = $subpartstema[0];
            $urltemapembelajaran = $subparts[0];

            $item = $this->quizModel->where('status', '0')->where('url', $urltema)->findAll();

            $quiz = $this->jawabQuizModel->where('status', '0')->where('url', $urltema)->where('telp', $userPhone)->findAll();

            $data = [
                'title' => 'Quiz | T-Learning',
                'active' => 'Quiz',
                'role' => $userData['role'],
                'url' => $urltema,
                'kunci' => $urlkunci,
                'tema' => $urltemapembelajaran,
                'item' => $item,
                'iduser' => $iduser,
                'quiz' => $quiz,
            ];

            echo view('pages/v_header.php', $data);
            echo view('app/v_quiz.php', $data);
            echo view('pages/v_footer.php', $data);
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function quizdata()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];
            $telpuser = $userData['telp'];

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $subparts = explode('&', $parts[1]);
            $subpartstema = explode('&', $parts[2]);
            $subpartsurltema = explode('&', $parts[3]);
            $urltema = $subpartsurltema[0];
            $urlkunci = $subpartstema[0];
            $urltemapembelajaran = $subparts[0];

            $soal_id = $parts[4];

            $quiz = $this->quizModel->where('status', '0')->where('url', $urltema)->where('soal_id', $soal_id)->first();

            $jawaban = $this->jawabQuizModel->where('status', '0')->where('telp', $telpuser)->where('url', $urltema)->where('soal_id', $soal_id)->first();

            $seconds = $quiz['detik'];
            $data = [
                'title' => 'Quiz | T-Learning',
                'active' => 'Quiz',
                'role' => $userData['role'],
                'url' => $urltema,
                'kunci' => $urlkunci,
                'tema' => $urltemapembelajaran,
                'soal' => $quiz,
                'waktu' => $seconds,
                'detik' => $seconds,
                'iduser' => $iduser,
                'idsoal' => $soal_id,
                'jawaban' => $jawaban,
            ];

            echo view('pages/v_header.php', $data);
            echo view('app/v_quiz_data.php', $data);
            echo view('pages/v_footer.php', $data);
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function quizselanjutnya()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];
            $usertelp = $userData['telp'];
            $username = $userData['nama'];

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $subparts = explode('&', $parts[1]);
            $subpartstema = explode('&', $parts[2]);
            $subpartsurltema = explode('&', $parts[3]);
            $urltema = $subpartsurltema[0];
            $urlkunci = $subpartstema[0];
            $urltemapembelajaran = $subparts[0];

            $item = $this->quizModel->where('status', '0')->where('url', $urltema)->where('soal_id', $parts[4])->first();

            $itemquiz = $this->jawabQuizModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

            $pembelajaran = $item['pembelajaran'];
            $jawaban1 = $item['jawaban1'];
            $jawaban2 = $item['jawaban2'];

            if ($itemquiz == null) {
                $data = [
                    'soal_id' => $parts[4],
                    'nama' => $username,
                    'telp' => $usertelp,
                    'jawaban1' => $this->request->getPost('jawaban1'),
                    'jawaban2' => $this->request->getPost('jawaban2'),
                    'pembelajaran' => $pembelajaran,
                    'url' => $urltema,
                    'kunci' => $urlkunci,
                ];

                $this->jawabQuizModel->save($data);

                if ($jawaban1 == $this->request->getPost('jawaban1') && $jawaban2 == $this->request->getPost('jawaban2')) {
                    $itemquiz = $this->jawabQuizModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                    $data = [
                        'id' => $itemquiz['id'],
                        'soal_id' => $itemquiz['soal_id'],
                        'nama' => $itemquiz['nama'],
                        'telp' => $itemquiz['telp'],
                        'jawaban1' => $this->request->getPost('jawaban1'),
                        'jawaban2' => $this->request->getPost('jawaban2'),
                        'jawaban' => 'BENAR',
                        'pembelajaran' => $pembelajaran,
                        'url' => $itemquiz['url'],
                        'kunci' => $itemquiz['kunci'],
                    ];
                    $this->jawabQuizModel->save($data);
                } elseif ($jawaban1 !== $this->request->getPost('jawaban1') || $jawaban2 !== $this->request->getPost('jawaban2')) {
                    $itemquiz = $this->jawabQuizModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                    $data = [
                        'id' => $itemquiz['id'],
                        'soal_id' => $itemquiz['soal_id'],
                        'nama' => $itemquiz['nama'],
                        'telp' => $itemquiz['telp'],
                        'jawaban1' => $this->request->getPost('jawaban1'),
                        'jawaban2' => $this->request->getPost('jawaban2'),
                        'jawaban' => 'SALAH',
                        'pembelajaran' => $pembelajaran,
                        'url' => $itemquiz['url'],
                        'kunci' => $itemquiz['kunci'],
                    ];
                    $this->jawabQuizModel->save($data);
                } elseif ($jawaban1 !== $this->request->getPost('jawaban1') || $jawaban2 == $this->request->getPost('jawaban2')) {
                    $itemquiz = $this->jawabQuizModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                    $data = [
                        'id' => $itemquiz['id'],
                        'soal_id' => $itemquiz['soal_id'],
                        'nama' => $itemquiz['nama'],
                        'telp' => $itemquiz['telp'],
                        'jawaban1' => $this->request->getPost('jawaban1'),
                        'jawaban2' => $this->request->getPost('jawaban2'),
                        'jawaban' => 'SALAH',
                        'pembelajaran' => $pembelajaran,
                        'url' => $itemquiz['url'],
                        'kunci' => $itemquiz['kunci'],
                    ];
                    $this->jawabQuizModel->save($data);
                } elseif ($jawaban1 == $this->request->getPost('jawaban1') || $jawaban2 !== $this->request->getPost('jawaban2')) {
                    $itemquiz = $this->jawabQuizModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                    $data = [
                        'id' => $itemquiz['id'],
                        'soal_id' => $itemquiz['soal_id'],
                        'nama' => $itemquiz['nama'],
                        'telp' => $itemquiz['telp'],
                        'jawaban1' => $this->request->getPost('jawaban1'),
                        'jawaban2' => $this->request->getPost('jawaban2'),
                        'jawaban' => 'SALAH',
                        'pembelajaran' => $pembelajaran,
                        'url' => $itemquiz['url'],
                        'kunci' => $itemquiz['kunci'],
                    ];
                    $this->jawabQuizModel->save($data);
                } else {
                    $data = [
                        'soal_id' => $parts[4],
                        'nama' => $username,
                        'telp' => $usertelp,
                        'jawaban1' => $this->request->getPost('jawaban1'),
                        'jawaban2' => $this->request->getPost('jawaban2'),
                        'pembelajaran' => $pembelajaran,
                        'url' => $urltema,
                        'kunci' => $urlkunci,
                    ];
                    $this->jawabQuizModel->save($data);
                }
                $this->jawabQuizModel->save($data);
            } else {
                if ($jawaban1 == $this->request->getPost('jawaban1') && $jawaban2 == $this->request->getPost('jawaban2')) {
                    $itemquiz = $this->jawabQuizModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                    $data = [
                        'id' => $itemquiz['id'],
                        'soal_id' => $itemquiz['soal_id'],
                        'nama' => $itemquiz['nama'],
                        'telp' => $itemquiz['telp'],
                        'jawaban1' => $this->request->getPost('jawaban1'),
                        'jawaban2' => $this->request->getPost('jawaban2'),
                        'jawaban' => 'BENAR',
                        'pembelajaran' => $pembelajaran,
                        'url' => $itemquiz['url'],
                        'kunci' => $itemquiz['kunci'],
                    ];
                    $this->jawabQuizModel->save($data);
                } elseif ($jawaban1 !== $this->request->getPost('jawaban1') || $jawaban2 !== $this->request->getPost('jawaban2')) {
                    $itemquiz = $this->jawabQuizModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                    $data = [
                        'id' => $itemquiz['id'],
                        'soal_id' => $itemquiz['soal_id'],
                        'nama' => $itemquiz['nama'],
                        'telp' => $itemquiz['telp'],
                        'jawaban1' => $this->request->getPost('jawaban1'),
                        'jawaban2' => $this->request->getPost('jawaban2'),
                        'jawaban' => 'SALAH',
                        'pembelajaran' => $pembelajaran,
                        'url' => $itemquiz['url'],
                        'kunci' => $itemquiz['kunci'],
                    ];
                    $this->jawabQuizModel->save($data);
                } elseif ($jawaban1 !== $this->request->getPost('jawaban1') || $jawaban2 == $this->request->getPost('jawaban2')) {
                    $itemquiz = $this->jawabQuizModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                    $data = [
                        'id' => $itemquiz['id'],
                        'soal_id' => $itemquiz['soal_id'],
                        'nama' => $itemquiz['nama'],
                        'telp' => $itemquiz['telp'],
                        'jawaban1' => $this->request->getPost('jawaban1'),
                        'jawaban2' => $this->request->getPost('jawaban2'),
                        'jawaban' => 'SALAH',
                        'pembelajaran' => $pembelajaran,
                        'url' => $itemquiz['url'],
                        'kunci' => $itemquiz['kunci'],
                    ];
                    $this->jawabQuizModel->save($data);
                } elseif ($jawaban1 == $this->request->getPost('jawaban1') || $jawaban2 !== $this->request->getPost('jawaban2')) {
                    $itemquiz = $this->jawabQuizModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                    $data = [
                        'id' => $itemquiz['id'],
                        'soal_id' => $itemquiz['soal_id'],
                        'nama' => $itemquiz['nama'],
                        'telp' => $itemquiz['telp'],
                        'jawaban1' => $this->request->getPost('jawaban1'),
                        'jawaban2' => $this->request->getPost('jawaban2'),
                        'jawaban' => 'SALAH',
                        'pembelajaran' => $pembelajaran,
                        'url' => $itemquiz['url'],
                        'kunci' => $itemquiz['kunci'],
                    ];
                    $this->jawabQuizModel->save($data);
                } else {
                    $data = [
                        'soal_id' => $parts[4],
                        'nama' => $username,
                        'telp' => $usertelp,
                        'jawaban1' => $this->request->getPost('jawaban1'),
                        'jawaban2' => $this->request->getPost('jawaban2'),
                        'pembelajaran' => $pembelajaran,
                        'url' => $urltema,
                        'kunci' => $urlkunci,
                    ];
                    $this->jawabQuizModel->save($data);
                }
                $this->jawabQuizModel->save($data);
            }

            $this->jawabQuizModel->save($data);

            return redirect()->to('/quiz_end&temapelajaran=' . $urltemapembelajaran . '&subtema=' . $urlkunci . '&bagan=' . $urltema . '&id=' . $item['soal_id']);
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function quizend()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];
            $namauser = $userData['nama'];

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $subparts = explode('&', $parts[1]);
            $subpartstema = explode('&', $parts[2]);
            $subpartsurltema = explode('&', $parts[3]);
            $urltema = $subpartsurltema[0];
            $urlkunci = $subpartstema[0];
            $urltemapembelajaran = $subparts[0];

            $item = $this->jawabQuizModel->where('status', '0')->where('telp', $userPhone)->where('url', $urltema)->where('soal_id', $parts[4])->first();

            $data = [
                'title' => 'Quiz | T-Learning',
                'active' => 'Quiz',
                'role' => $userData['role'],
                'item' => $item,
                'url' => $urltema,
                'kunci' => $urlkunci,
                'tema' => $urltemapembelajaran,
                'iduser' => $iduser,
                'namauser' => $namauser,
            ];

            echo view('pages/v_header.php', $data);
            echo view('app/v_quiz_end.php', $data);
            echo view('pages/v_footer.php', $data);
        } else {
            echo view('pages/v_login.php');
        }
    }


    public function soal()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $subparts = explode('&', $parts[1]);
            $subpartstema = explode('&', $parts[2]);
            $subpartsurltema = explode('&', $parts[3]);
            $urltema = $subpartsurltema[0];
            $urltemapembelajaran = $subparts[0];
            $urlkunci = $subpartstema[0];

            if (isset($parts[4])) {
                if ($parts[4] == '1') {
                    $soal = $this->soalModel->where('status', '0')->where('url', $urltema)->where('soal_id', $parts[4])->first();
                    if (isset($soal)) {
                        $idsoal = $soal['soal_id'];
                        $jawabsoal = $this->jawabSoalModel->where('status', '0')->where('telp', $userPhone)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                        $data = [
                            'title' => 'Soal | T-Learning',
                            'active' => 'Soal',
                            'role' => $userData['role'],
                            'url' => $urltema,
                            'kunci' => $urlkunci,
                            'tema' => $urltemapembelajaran,
                            'soal' => $soal,
                            'waktu' => $soal['detik'],
                            'detik' => $soal['detik'],
                            'iduser' => $iduser,
                            'idsoal' => $idsoal,
                            'jawabsoal' => $jawabsoal,
                        ];
                        echo view('pages/v_header.php', $data);
                        echo view('app/v_soal.php', $data);
                        echo view('pages/v_footer.php', $data);
                    } else {
                        return redirect()->to('/soal_end&temapelajaran=' . $urltemapembelajaran . '&subtema=' . $urlkunci . '&bagan=' . $urltema);
                    }
                } else {
                    $soal = $this->soalModel->where('status', '0')->where('url', $urltema)->where('soal_id', $parts[4])->first();

                    if (isset($soal)) {
                        $idsoal = $soal['soal_id'];

                        $jawabsoal = $this->jawabSoalModel->where('status', '0')->where('telp', $userPhone)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                        $data = [
                            'title' => 'Soal | T-Learning',
                            'active' => 'Soal',
                            'role' => $userData['role'],
                            'url' => $urltema,
                            'kunci' => $urlkunci,
                            'tema' => $urltemapembelajaran,
                            'soal' => $soal,
                            'waktu' => $soal['detik'],
                            'detik' => $soal['detik'],
                            'iduser' => $iduser,
                            'idsoal' => $idsoal,
                            'jawabsoal' => $jawabsoal,
                        ];

                        echo view('pages/v_header.php', $data);
                        echo view('app/v_soal.php', $data);
                        echo view('pages/v_footer.php', $data);
                    } else {
                        return redirect()->to('/soal_end&temapelajaran=' . $urltemapembelajaran . '&subtema=' . $urlkunci . '&bagan=' . $urltema);
                    }
                }
            } else {
                return redirect()->to('/soal_end&temapelajaran=' . $urltemapembelajaran . '&subtema=' . $urlkunci . '&bagan=' . $urltema);
            }
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function savesoal()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $usertelp = $userData['telp'];
            $usernama = $userData['nama'];

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $subparts = explode('&', $parts[1]);
            $subpartstema = explode('&', $parts[2]);
            $subpartsurltema = explode('&', $parts[3]);
            $urltema = $subpartsurltema[0];
            $urltemapembelajaran = $subparts[0];
            $urlkunci = $subpartstema[0];

            $soal_id = $parts[4];

            $soal = $this->soalModel->where('status', '0')->where('url', $urltema)->where('soal_id', $parts[4])->first();

            $itemsoal = $this->jawabSoalModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

            $jawaban = $soal['jawaban'];

            if (isset($parts[4])) {
                if ($itemsoal == null) {
                    if ($this->request->getPost('opsi') == '') {
                        $data = [
                            'soal_id' => $soal_id,
                            'telp' => $usertelp,
                            'nama' => $usernama,
                            'jawaban' => '',
                            'url' => $urltema,
                            'kunci' => $urlkunci,
                        ];
                    } else {
                        $data = [
                            'soal_id' => $soal_id,
                            'telp' => $usertelp,
                            'nama' => $usernama,
                            'jawaban' => $this->request->getPost('opsi'),
                            'url' => $urltema,
                            'kunci' => $urlkunci,
                        ];
                    }

                    $this->jawabSoalModel->save($data);

                    if ($jawaban == $this->request->getPost('opsi')) {
                        $itemsoal = $this->jawabSoalModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                        $data = [
                            'id' => $itemsoal['id'],
                            'soal_id' => $itemsoal['soal_id'],
                            'telp' => $itemsoal['telp'],
                            'nama' => $usernama,
                            'jawaban' => $this->request->getPost('opsi'),
                            'koreksi' => 'BENAR',
                            'url' => $itemsoal['url'],
                            'kunci' => $itemsoal['kunci'],
                        ];
                        $this->jawabSoalModel->save($data);
                    } else {
                        $itemsoal = $this->jawabSoalModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                        $data = [
                            'id' => $itemsoal['id'],
                            'soal_id' => $itemsoal['soal_id'],
                            'telp' => $itemsoal['telp'],
                            'nama' => $usernama,
                            'jawaban' => $this->request->getPost('opsi'),
                            'koreksi' => 'SALAH',
                            'url' => $itemsoal['url'],
                            'kunci' => $itemsoal['kunci'],
                        ];
                        $this->jawabSoalModel->save($data);
                    }
                } else {
                    if ($jawaban == $this->request->getPost('opsi')) {
                        $itemsoal = $this->jawabSoalModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                        $data = [
                            'id' => $itemsoal['id'],
                            'soal_id' => $itemsoal['soal_id'],
                            'telp' => $itemsoal['telp'],
                            'nama' => $usernama,
                            'jawaban' => $this->request->getPost('opsi'),
                            'koreksi' => 'BENAR',
                            'url' => $itemsoal['url'],
                            'kunci' => $itemsoal['kunci'],
                        ];
                        $this->jawabSoalModel->save($data);
                    } else {
                        $itemsoal = $this->jawabSoalModel->where('status', '0')->where('telp', $usertelp)->where('url', $urltema)->where('soal_id', $parts[4])->first();

                        $data = [
                            'id' => $itemsoal['id'],
                            'soal_id' => $itemsoal['soal_id'],
                            'telp' => $itemsoal['telp'],
                            'nama' => $usernama,
                            'jawaban' => $this->request->getPost('opsi'),
                            'koreksi' => 'SALAH',
                            'url' => $itemsoal['url'],
                            'kunci' => $itemsoal['kunci'],
                        ];
                        $this->jawabSoalModel->save($data);
                    }
                }
                $idsoal = $soal['soal_id'] + 1;

                return redirect()->to('/soal&temapelajaran=' . $urltemapembelajaran . '&subtema=' . $urlkunci . '&bagan=' . $urltema . '&id=' . $idsoal);
            } else {
                return redirect()->to('/soal_end&temapelajaran=' . $urltemapembelajaran . '&subtema=' . $urlkunci . '&bagan=' . $urltema);
            }
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function soalend()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];
            $telpuser = $userData['telp'];

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $subparts = explode('&', $parts[1]);
            $subpartstema = explode('&', $parts[2]);
            $subpartsurltema = explode('&', $parts[3]);
            $urltema = $subpartsurltema[0];
            $urltemapembelajaran = $subparts[0];
            $urlkunci = $subpartstema[0];
            $soal = $this->jawabSoalModel->getLastRow($urltema);

            $jumlahsoal = $this->jawabSoalModel->where('status', '0')->where('telp', $telpuser)->where('url', $urltema)->findAll();
            $jumlah_soal_benar = 0;
            $jumlah_soal_salah = 0;
            foreach ($jumlahsoal as $data) {
                if (isset($data['koreksi']) && $data['koreksi'] == "BENAR") {
                    $jumlah_soal_benar++;
                }
                if (isset($data['koreksi']) && $data['koreksi'] == "SALAH") {
                    $jumlah_soal_salah++;
                }
            }

            $jumlah_soal = count($jumlahsoal);

            $persentase_benar = $jumlah_soal_benar / $jumlah_soal * 100;
            $skor = $jumlah_soal_benar / $jumlah_soal * 10;


            $kunci = str_replace("%20", " ", $urlkunci);
            $kunci = str_replace("-", " ", $urlkunci);

            $data = [
                'title' => 'Soal | T-Learning',
                'active' => 'Soal',
                'role' => $userData['role'],
                'item' => $soal,
                'url' => $urltema,
                'kunci' => $kunci,
                'tema' => $urltemapembelajaran,
                'urlkunci' => $urlkunci,
                'iduser' => $iduser,
                'soalbenar' => $jumlah_soal_benar,
                'soalsalah' => $jumlah_soal_salah,
                'penyelesaian' => $persentase_benar,
                'skor' => $skor,
            ];

            echo view('pages/v_header.php', $data);
            echo view('app/v_soal_end.php', $data);
            echo view('pages/v_footer.php', $data);
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function prosessoalend()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        $iduser = $userData['id'];
        $telpuser = $userData['telp'];
        $usernama = $userData['nama'];

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $subparts = explode('&', $parts[1]);
        $subpartstema = explode('&', $parts[2]);
        $subpartsurltema = explode('&', $parts[3]);
        $urltema = $subpartsurltema[0];
        $urltemapembelajaran = $subparts[0];
        $urlkunci = $subpartstema[0];

        $pembelajaranData = $this->pembelajaranModel->where('status', '0')->where('url', $urltema)->first();
        $pembelajaran = $pembelajaranData['pembelajaran'];

        $data = [
            'telp' => $telpuser,
            'nama' => $usernama,
            'jumlah_soal' => $this->request->getPost('jumlah_soal'),
            'penyelesaian' => $this->request->getPost('penyelesaian'),
            'benar' => $this->request->getPost('benar'),
            'salah' => $this->request->getPost('salah'),
            'skor' => $this->request->getPost('skor'),
            'pembelajaran' => $pembelajaran,
            'url' => $urltema,
            'kunci' => $urlkunci,
        ];

        $this->nilaiSoalModel->save($data);

        return redirect()->to('/pembelajaran&temapelajaran=' . $urltemapembelajaran . '&subtema=' . $urlkunci . '&bagan=' . $urltema);
    }

    public function diskusi()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];

            $lastUrl = $this->request->uri->getPath();
            $parts = explode('=', $lastUrl);
            $subparts = explode('&', $parts[1]);
            $subpartstema = explode('&', $parts[2]);
            $subpartsurltema = explode('&', $parts[3]);
            $urltema = $subpartsurltema[0];
            $urltemapembelajaran = $subparts[0];
            $urlkunci = $subpartstema[0];

            $diskusi = $parts[4];
            $tema_diskusi = urldecode($diskusi);

            $item = $this->diskusiModel->where('status', '0')->where('diskusi', $tema_diskusi)->findAll();

            $data = [
                'title' => 'Diskusi | T-Learning',
                'active' => 'Diskusi',
                'role' => $userData['role'],
                'url' => $urltema,
                'kunci' => $urlkunci,
                'tema' => $urltemapembelajaran,
                'diskusi' => $tema_diskusi,
                'item' => $item,
                'iduser' => $iduser,
                'telpuser' => $userPhone,
            ];

            echo view('pages/v_header.php', $data);
            echo view('app/v_diskusi.php', $data);
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function prosesdiskusi()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        $usernama = $userData['nama'];
        $userprofile = $userData['foto'];

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $subparts = explode('&', $parts[1]);
        $urltema = explode('&', $parts[2]);
        $urlkunci = $subparts[0];

        $diskusi = $parts[3];
        $tema_diskusi = urldecode($diskusi);

        if (isset($userData['id_google'])) {
            $data = [
                'id_google' => $userData['id_google'],
                'telp' => $userPhone,
                'nama' => $usernama,
                'pesan' => $this->request->getPost('pesan'),
                'foto' => $userprofile,
                'diskusi' => $tema_diskusi,
                'url' => $urltema[0],
                'kunci' => $urlkunci,
            ];
        } else {
            $data = [
                'id_google' => '',
                'telp' => $userPhone,
                'nama' => $usernama,
                'pesan' => $this->request->getPost('pesan'),
                'foto' => $userprofile,
                'diskusi' => $tema_diskusi,
                'url' => $urltema[0],
                'kunci' => $urlkunci,
            ];
        }

        $this->diskusiModel->save($data);

        return redirect()->back();
    }

    public function user()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();
        if (!empty($userData)) {
            $iduser = $userData['id'];
            $foto = $userData['foto'];

            $data = [
                'title' => 'User | T-Learning',
                'active' => 'User',
                'role' => $userData['role'],
                'item' => $userData,
                'iduser' => $iduser,
                'foto' => $foto,
            ];

            echo view('pages/v_header.php', $data);
            echo view('pages/v_user.php', $data);
            echo view('pages/v_footer.php', $data);
        } else {
            echo view('pages/v_login.php');
        }
    }

    public function updateuser()
    {
        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $id = $parts[1];

        $photo_profile = $this->request->getFile('foto');

        $foto = $this->loginModel->where('status', '0')->where('id', $id)->first();
        $oldfoto = $foto['foto'];

        if ($photo_profile->isValid() && $oldfoto == 'blank.jpg') {
            $new_name = $photo_profile->getRandomName();

            // Mengambil informasi user yang sedang login
            $user = $this->loginModel->where('status', '0')->where('id', $id)->first();

            // Memindahkan file foto profil yang baru ke folder yang ditentukan
            $photo_profile->move(ROOTPATH . 'public/uploads/profile', $new_name);

            // Menyimpan nama file foto profil yang baru ke database
            $data = [
                'id' => $id,
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'telp' => $this->request->getPost('telp'),
                'foto' => $new_name,
                'created_at' => null,
            ];
        } elseif ($photo_profile->isValid() && $oldfoto !== 'blank.jpg') {
            $new_name = $photo_profile->getRandomName();

            // Mengambil informasi user yang sedang login
            $user = $this->loginModel->where('status', '0')->where('id', $id)->first();
            $foto = $user['foto'];

            if (strpos($foto, 'https') !== false) {
                // Memindahkan file foto profil yang baru ke folder yang ditentukan
                $photo_profile->move(ROOTPATH . 'public/uploads/profile', $new_name);

                // Menyimpan nama file foto profil yang baru ke database
                $data = [
                    'id' => $id,
                    'nama' => $this->request->getPost('nama'),
                    'email' => $this->request->getPost('email'),
                    'telp' => $this->request->getPost('telp'),
                    'foto' => $new_name,
                    'created_at' => null,
                ];
            } else {
                // Menghapus file foto profil yang lama
                unlink(FCPATH . 'uploads/profile/' . $user['foto']);

                // Memindahkan file foto profil yang baru ke folder yang ditentukan
                $photo_profile->move(ROOTPATH . 'public/uploads/profile', $new_name);

                // Menyimpan nama file foto profil yang baru ke database
                $data = [
                    'id' => $id,
                    'nama' => $this->request->getPost('nama'),
                    'email' => $this->request->getPost('email'),
                    'telp' => $this->request->getPost('telp'),
                    'foto' => $new_name,
                    'created_at' => null,
                ];
            }
        } else {
            $data = [
                'id' => $id,
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'telp' => $this->request->getPost('telp'),
                'foto' => $oldfoto,
                'created_at' => null,
            ];
        }

        $this->loginModel->save($data);

        return redirect()->back();
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }

    // fungsi ajax screennshot
    public function saveimage()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $subparts = explode('&', $parts[1]);
        $subpartstema = explode('&', $parts[2]);
        $subpartsurltema = explode('&', $parts[3]);
        $soalid = explode('&', $parts[4]);
        $urltema = $subpartsurltema[0];
        $urlkunci = $subpartstema[0];
        $urltemapembelajaran = $subparts[0];

        $item = $this->jawabQuizModel->where('status', '0')->where('telp', $userPhone)->where('url', $urltema)->where('soal_id', $soalid[0])->first();

        $imageData = $this->request->getVar('image');
        $img = str_replace('data:image/png;base64,', '', $imageData);
        $img = str_replace(' ', '+', $img);
        $imgData = base64_decode($img);
        $filename = 'screenshot_' . date('YmdHis') . '.png';
        $filepath = ROOTPATH . 'public/uploads/screenshots/' . $filename;
        file_put_contents($filepath, $imgData);

        // $file_path = ROOTPATH . 'public/uploads/screenshots/' . $filename;

        $oldScreenshot = $item['screenshot'];

        // Hapus gambar yang lama jika ada
        if ($oldScreenshot && file_exists(ROOTPATH . 'public/uploads/screenshots/' . $oldScreenshot)) {
            unlink(ROOTPATH . 'public/uploads/screenshots/' . $oldScreenshot);
        }

        $data = [
            'id' => $item['id'],
            'soal_id' => $item['soal_id'],
            'telp' => $item['telp'],
            'jawaban1' => $item['jawaban1'],
            'jawaban2' => $item['jawaban2'],
            'jawaban' => $item['jawaban'],
            'screenshot' => $filename,
            'url' => $item['url'],
            'kunci' => $item['kunci'],
        ];

        $this->jawabQuizModel->save($data);

        $url = base_url('uploads/' . $filename);
        echo $url;
    }

    public function downloadimage()
    {
        $userPhone = session()->get('telp');
        $userData = $userData = $this->loginModel->where('status', '0')->where('telp', $userPhone)->first();

        $lastUrl = $this->request->uri->getPath();
        $parts = explode('=', $lastUrl);
        $subparts = explode('&', $parts[1]);
        $subpartstema = explode('&', $parts[2]);
        $subpartsurltema = explode('&', $parts[3]);
        $soalid = explode('&', $parts[4]);
        $urltema = $subpartsurltema[0];
        $urlkunci = $subpartstema[0];
        $urltemapembelajaran = $subparts[0];

        $item = $this->jawabQuizModel->where('status', '0')->where('telp', $userPhone)->where('url', $urltema)->where('soal_id', $soalid[0])->first();

        $filename = $item['screenshot'];

        $filepath = ROOTPATH . 'public/uploads/screenshots/' . $filename;

        // Set header file
        $mime_type = mime_content_type($filepath);
        $response = service('response');
        $response->setHeader('Content-Type', $mime_type);
        $response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $response->setHeader('Cache-Control', 'max-age=0');

        // Tampilkan file
        return $response->download($filepath, null);
    }
}
