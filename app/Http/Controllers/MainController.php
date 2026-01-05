<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    private $captchaSessionKey = 'captcha_text';

    public function index(Request $request)
    {
        // Default: bulan ini
        $defaultStart = Carbon::now()->startOfMonth()->format('Y-m-d');
        $defaultEnd = Carbon::now()->endOfMonth()->format('Y-m-d');
        // === FILTER LAYANAN PUBLIK (independen) ===
        $layananStart = $request->query('layanan_start', $defaultStart);
        $layananEnd = $request->query('layanan_end', $defaultEnd);
        if ($layananStart > $layananEnd) {
            [$layananStart, $layananEnd] = [$layananEnd, $layananStart];
        }
        $data = DB::table('layanan_publik')
            ->selectRaw("tanggal,
                SUM(penyidikan_penyelidikan) as penyidikan_penyelidikan,
                SUM(patroli_kapal) as patroli_kapal,
                SUM(sar) as sar,
                SUM(snbp) as snbp,
                SUM(pengawasan_salvage) as pengawasan_salvage,
                SUM(marpol) as marpol,
                SUM(tamu_kantor) as tamu_kantor")
            ->whereBetween('tanggal', [$layananStart, $layananEnd])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $labels = $data->pluck('tanggal')->map(fn($d) => Carbon::parse($d)->format('d/m'))->toArray();
        $datasets = [
            'Penyidikan & Penyelidikan' => $data->pluck('penyidikan_penyelidikan')->toArray(),
            'Patroli Kapal' => $data->pluck('patroli_kapal')->toArray(),
            'SAR' => $data->pluck('sar')->toArray(),
            'SNBP' => $data->pluck('snbp')->toArray(),
            'Pengawasan Salvage' => $data->pluck('pengawasan_salvage')->toArray(),
            'Marpol' => $data->pluck('marpol')->toArray(),
            'Tamu Kantor' => $data->pluck('tamu_kantor')->toArray(),
        ];
        // === FILTER PPID (independen juga) ===
        $ppidStart = $request->query('ppid_start', $defaultStart);
        $ppidEnd = $request->query('ppid_end', $defaultEnd);
        if ($ppidStart > $ppidEnd) {
            [$ppidStart, $ppidEnd] = [$ppidEnd, $ppidStart];
        }
        $ppidData = DB::table('laporan_ppid')
            ->selectRaw('tanggal, SUM(jumlah_pemohon) as total_pemohon')
            ->whereBetween('tanggal', [$ppidStart, $ppidEnd])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $ppidLabels = $ppidData->pluck('tanggal')->map(fn($d) => Carbon::parse($d)->format('d/m'))->toArray();
        $ppidValues = $ppidData->pluck('total_pemohon')->toArray();
        // === FILTER SKM (independen juga) ===
        $skmStart = $request->query('skm_start', $defaultStart);
        $skmEnd = $request->query('skm_end', $defaultEnd);
        if ($skmStart > $skmEnd) {
            [$skmStart, $skmEnd] = [$skmEnd, $skmStart];
        }
        $skmData = DB::table('laporan_skm')
            ->selectRaw('tanggal, responden, ipk, ikm')
            ->whereBetween('tanggal', [$skmStart, $skmEnd])
            ->orderBy('tanggal')
            ->get();
        $skmLabels = $skmData->pluck('tanggal')
            ->map(fn($d) => Carbon::parse($d)->format('d/m'))
            ->toArray();
        $skmResponden = $skmData->pluck('responden')->toArray();
        $skmIpk = $skmData->pluck('ipk')->toArray();
        $skmIkm = $skmData->pluck('ikm')->toArray();
        // === FILTER MEDIA VISUAL (independen juga) ===
        $mediaStart = $request->query('media_start', $defaultStart);
        $mediaEnd = $request->query('media_end', $defaultEnd);
        if ($mediaStart > $mediaEnd) {
            [$mediaStart, $mediaEnd] = [$mediaEnd, $mediaStart];
        }
        $mediaData = DB::table('laporan_media_visual')
            ->selectRaw('tanggal, SUM(tayangan_postingan) as tayangan, SUM(pengikut) as pengikut')
            ->whereBetween('tanggal', [$mediaStart, $mediaEnd])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $mediaLabels = $mediaData->pluck('tanggal')->map(fn($d) => Carbon::parse($d)->format('d/m'))->toArray();
        $mediaTayangan = $mediaData->pluck('tayangan')->toArray();
        $mediaPengikut = $mediaData->pluck('pengikut')->toArray();
        // === FILTER BERITA KPLP (independen juga) ===
        $beritaStart = $request->query('berita_start', $defaultStart);
        $beritaEnd = $request->query('berita_end', $defaultEnd);
        if ($beritaStart > $beritaEnd) {
            [$beritaStart, $beritaEnd] = [$beritaEnd, $beritaStart];
        }
        $beritaData = DB::table('laporan_berita_kplp')
            ->selectRaw('tanggal, SUM(jumlah_berita_positif) as positif, SUM(jumlah_berita_negatif) as negatif')
            ->whereBetween('tanggal', [$beritaStart, $beritaEnd])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $beritaLabels = $beritaData->pluck('tanggal')->map(fn($d) => Carbon::parse($d)->format('d/m'))->toArray();
        $beritaPositif = $beritaData->pluck('positif')->toArray();
        $beritaNegatif = $beritaData->pluck('negatif')->toArray();
        // === FILTER SIARAN PERS (independen juga) ===
        $siaranStart = $request->query('siaran_start', $defaultStart);
        $siaranEnd = $request->query('siaran_end', $defaultEnd);
        if ($siaranStart > $siaranEnd) {
            [$siaranStart, $siaranEnd] = [$siaranEnd, $siaranStart];
        }
        $siaranData = DB::table('laporan_siaran_pers')
            ->selectRaw('tanggal, SUM(jumlah_siaran_pers) as total_siaran')
            ->whereBetween('tanggal', [$siaranStart, $siaranEnd])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $siaranLabels = $siaranData->pluck('tanggal')->map(fn($d) => Carbon::parse($d)->format('d/m'))->toArray();
        $siaranValues = $siaranData->pluck('total_siaran')->toArray();
        // === FILTER PENGELOLAAN LAPORAN MASUK (independen juga) ===
        $pengelolaanStart = $request->query('pengelolaan_start', $defaultStart);
        $pengelolaanEnd = $request->query('pengelolaan_end', $defaultEnd);
        if ($pengelolaanStart > $pengelolaanEnd) {
            [$pengelolaanStart, $pengelolaanEnd] = [$pengelolaanEnd, $pengelolaanStart];
        }
        $pengelolaanData = DB::table('pengelolaan_laporan_masuk')
            ->selectRaw("tanggal,
                SUM(belum_terverifikasi) as belum_terverifikasi,
                SUM(terdisposisi_belum_tindak_lanjut) as terdisposisi_belum_tindak_lanjut,
                SUM(terdisposisi_sedang_proses) as terdisposisi_sedang_proses,
                SUM(terdisposisi_selesai) as terdisposisi_selesai,
                SUM(tertunda) as tertunda")
            ->whereBetween('tanggal', [$pengelolaanStart, $pengelolaanEnd])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $pengelolaanLabels = $pengelolaanData->pluck('tanggal')->map(fn($d) => Carbon::parse($d)->format('d/m'))->toArray();
        $belumTerverifikasi = $pengelolaanData->pluck('belum_terverifikasi')->toArray();
        $terdisposisiBelumTindakLanjut = $pengelolaanData->pluck('terdisposisi_belum_tindak_lanjut')->toArray();
        $terdisposisiSedangProses = $pengelolaanData->pluck('terdisposisi_sedang_proses')->toArray();
        $terdisposisiSelesai = $pengelolaanData->pluck('terdisposisi_selesai')->toArray();
        $tertunda = $pengelolaanData->pluck('tertunda')->toArray();
        // Kirim semua data ke view
        return view('index', compact(
            'layananStart',
            'layananEnd',
            'ppidStart',
            'ppidEnd',
            'skmStart',
            'skmEnd',
            'mediaStart',
            'mediaEnd',
            'beritaStart',
            'beritaEnd',
            'siaranStart',
            'siaranEnd',
            'pengelolaanStart',
            'pengelolaanEnd',
            'labels',
            'datasets',
            'ppidLabels',
            'ppidValues',
            'skmLabels',
            'skmResponden',
            'skmIpk',
            'skmIkm',
            'mediaLabels',
            'mediaTayangan',
            'mediaPengikut',
            'beritaLabels',
            'beritaPositif',
            'beritaNegatif',
            'siaranLabels',
            'siaranValues',
            'pengelolaanLabels',
            'belumTerverifikasi',
            'terdisposisiBelumTindakLanjut',
            'terdisposisiSedangProses',
            'terdisposisiSelesai',
            'tertunda'
        ));
    }
    public function shipping()
    {
        return view('shipping');
    }
    public function register()
    {
        return view('register');
    }
    public function login()
    {
        // Generate initial captcha if not exists
        if (!session()->has($this->captchaSessionKey)) {
            $this->generateCaptcha();
        }
        return view('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    private function generateCaptcha()
    {
        // Generate numeric-only captcha (6 digits) and avoid trivial patterns
        $length = 6;

        do {
            $digits = '';
            for ($i = 0; $i < $length; $i++) {
                $digits .= (string) random_int(0, 9);
            }
            // Reject if all digits are identical or strictly sequential (ascending or descending)
        } while ($this->isAllSame($digits) || $this->isSequential($digits));

        session([$this->captchaSessionKey => $digits]);
    }

    private function isAllSame(string $s): bool
    {
        return count(array_unique(str_split($s))) === 1;
    }

    private function isSequential(string $s): bool
    {
        $chars = array_map('intval', str_split($s));
        $asc = true;
        $desc = true;
        for ($i = 1, $len = count($chars); $i < $len; $i++) {
            if ($chars[$i] !== ($chars[$i - 1] + 1)) {
                $asc = false;
            }
            if ($chars[$i] !== ($chars[$i - 1] - 1)) {
                $desc = false;
            }
        }
        return $asc || $desc;
    }

    public function refreshCaptcha()
    {
        $this->generateCaptcha();
        return response()->json([
            'success' => true,
            'captcha_text' => session($this->captchaSessionKey)
        ]);
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'captcha'  => 'required|size:6',
        ]);

        // 1. Cek captcha
        if (strtoupper($request->captcha) !== session('captcha_text')) {
            return back()->withErrors(['captcha' => 'Captcha salah!'])->withInput();
        }

        // 2. INI YANG BARU — PAKSA LARAVEL PAKAI USERNAME (bypass bug cache)
        \Illuminate\Support\Facades\Config::set('auth.providers.users.model', \App\Models\User::class);
        Auth::shouldUse('web');

        // 3. Periksa apakah akun aktif sebelum mencoba login
        $user = \App\Models\User::where('username', $request->username)->first();
        if ($user && !$user->is_active) {
            return back()->withErrors(['username' => 'Akun Anda telah dinonaktifkan. Hubungi administrator.'])->withInput();
        }

        // 4. Login — PAKAI CREDENTIALS DENGAN CARA INI (pasti masuk)
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        // Kalau masih gagal, tampilkan pesan debug (hapus nanti)
        return back()->withErrors([
            'username' => 'Username atau password salah! (debug: coba lagi atau clear cache)'
        ])->withInput();
    }

    /**
     * Show forgot password form
     */
    public function forgotPassword()
    {
        return view('forgot_password');
    }

    /**
     * Process forgot password - verify email and generate reset token
     */
    public function processForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem.'])->withInput();
        }

        // Check if user is active
        if (!$user->is_active) {
            return back()->withErrors(['email' => 'Akun dengan email ini telah dinonaktifkan. Hubungi administrator.'])->withInput();
        }

        // Generate reset token
        $token = Str::random(64);

        // Save token and expiration (valid for 1 hour)
        $user->update([
            'reset_token' => $token,
            'reset_token_expires_at' => Carbon::now()->addHour(),
        ]);

        // Redirect to reset password page with token
        return redirect()->route('password.reset', ['token' => $token])
            ->with('success', 'Verifikasi berhasil! Silakan buat password baru.');
    }

    /**
     * Show reset password form
     */
    public function resetPassword($token)
    {
        // Validate token
        $user = User::where('reset_token', $token)
            ->where('reset_token_expires_at', '>', Carbon::now())
            ->first();

        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Link reset password tidak valid atau sudah kadaluarsa. Silakan ulangi proses.']);
        }

        return view('reset_password', [
            'token' => $token,
            'email' => $user->email
        ]);
    }

    /**
     * Process reset password - update user's password
     */
    public function processResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Find user by token
        $user = User::where('reset_token', $request->token)
            ->where('reset_token_expires_at', '>', Carbon::now())
            ->first();

        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Link reset password tidak valid atau sudah kadaluarsa. Silakan ulangi proses.']);
        }

        // Update password and clear reset token
        $user->update([
            'password' => Hash::make($request->password),
            'reset_token' => null,
            'reset_token_expires_at' => null,
        ]);

        return redirect()->route('login')
            ->with('success', 'Password berhasil direset! Silakan login dengan password baru Anda.');
    }
}
