<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class OdooApiController extends Controller
{
    private string $baseUrl = 'http://localhost:8069';
    private string $db = '19-demo';

    public function login(Request $request)
    {
        // Ambil input dari body
        $login = $request->input('login');
        $password = $request->input('password');

        if (!$login || !$password) {
            return response()->json([
                'success' => false,
                'message' => 'Login dan password wajib diisi.'
            ], 400);
        }

        // Kirim ke API Odoo
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/web/session/authenticate", [
            'jsonrpc' => '2.0',
            'method' => 'call',
            'params' => [
                'db' => $this->db,
                'login' => $login,
                'password' => $password,
            ],
            'id' => 1,
        ]);

        $data = $response->json();

        if (isset($data['result']['uid'])) {
            // Ambil session_id dari header response
            $cookie = $response->header('set-cookie');
            return response()->json([
                'success' => true,
                'uid' => $data['result']['uid'],
                'name' => $data['result']['name'] ?? null,
                'session_id' => $this->extractSessionId($cookie),
                'response' => $data['result'],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Login gagal',
            'response' => $data
        ], 401);
    }

    private function extractSessionId($cookieHeader)
    {
        if (!$cookieHeader) return null;
        preg_match('/session_id=([^;]+)/', $cookieHeader, $matches);
        return $matches[1] ?? null;
    }

    public function partners(Request $request)
    {
        $sessionId = $request->input('session_id');

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
                    'fields' => ['id', 'name', 'email'],
                    'limit' => 5,
                ],
            ],
            'id' => 2,
        ]);

        return $response->json();
    }
}
