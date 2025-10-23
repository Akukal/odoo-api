<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class OdooController extends Controller
{
    private string $baseUrl = 'http://localhost:8069';
    private string $db = '19-demo';

    public function showLoginForm()
    {
        return view('odoo.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/web/session/authenticate", [
            'jsonrpc' => '2.0',
            'method' => 'call',
            'params' => [
                'db' => $this->db,
                'login' => $request->login,
                'password' => $request->password,
            ],
            'id' => 1,
        ]);

        $data = $response->json();

        if (isset($data['result']['uid'])) {
            // Ambil session_id dari header
            $cookie = $response->header('set-cookie');
            $sessionId = $this->extractSessionId($cookie);

            // Simpan ke Laravel session
            session([
                'odoo_session_id' => $sessionId,
                'odoo_user' => $data['result']['name'] ?? 'User',
            ]);

            return redirect()->route('odoo.partners');
        }

        return back()->withErrors(['login' => 'Login gagal. Coba lagi.']);
    }

    public function partners()
    {
        $sessionId = session('odoo_session_id');

        if (!$sessionId) {
            return redirect()->route('odoo.login.form')->withErrors(['login' => 'Silakan login dulu.']);
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Cookie' => "session_id={$sessionId}",
        ])->post("{$this->baseUrl}/web/dataset/call_kw", [
            'jsonrpc' => '2.0',
            'method' => 'call',
            'params' => [
                'model' => 'res.partner',
                'method' => 'search_read',
                'args' => [],
                'kwargs' => [
                    'fields' => ['id', 'name', 'email', 'phone'],
                    'limit' => 10,
                ],
            ],
            'id' => 2,
        ]);

        $partners = $response->json()['result'] ?? [];

        return view('odoo.partners', compact('partners'));
    }

    private function extractSessionId($cookieHeader)
    {
        if (!$cookieHeader) return null;
        preg_match('/session_id=([^;]+)/', $cookieHeader, $matches);
        return $matches[1] ?? null;
    }
}
