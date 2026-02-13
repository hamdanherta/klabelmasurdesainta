<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        $filePath = public_path('responses.csv');
        $responseCount = 0;
        $lastRespondentName = '-';
        $lastRespondentTime = '-';

        if (file_exists($filePath)) {
            // Count lines
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines !== false) {
                $lineCount = count($lines);
                // Subtract 1 for header, ensure non-negative
                $responseCount = max(0, $lineCount - 1);

                if ($responseCount > 0) {
                    $lastLine = $lines[$lineCount - 1];
                    $data = str_getcsv($lastLine);
                    if (count($data) >= 14) {
                        $lastRespondentName = $data[1];
                        $lastRespondentTime = $data[13];
                    }
                }
            }
        }

        return view('admin.dashboard', compact('responseCount', 'lastRespondentName', 'lastRespondentTime'));
    }

    public function downloadCsv()
    {
        $filePath = public_path('responses.csv');

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->download($filePath, 'HASIL-KUISIONER.csv');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function resetCsv()
    {
        $filePath = public_path('responses.csv');
        $header = 'id,nama,nowa,kom_1,kom_2,kom_3,kom_4,kom_5,kom_6,kom_7,kom_8,kom_9,kom_10,timestamp';

        try {
            file_put_contents($filePath, $header . "\n");
            return redirect()->back()->with('success', 'Data hasil kusioner berhasil di-reset.');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mereset data: ' . $e->getMessage());
        }
    }
}
