<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ColorDataset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewSubmissionMail;

class QuestionnaireController extends Controller
{
    public function welcome()
    {
        $names = [];
        $filePath = public_path('responses.csv');
        if (file_exists($filePath)) {
            if (($handle = fopen($filePath, "r")) !== FALSE) {
                $header = fgetcsv($handle); // Skip header
                while (($data = fgetcsv($handle)) !== FALSE) {
                    if (isset($data[1]) && !empty($data[1])) {
                        $names[] = $data[1];
                    }
                }
                fclose($handle);
            }
        }

        // Reserve data for counts and last respondent details before modifying the array for rendering
        $responseCount = count($names);

        $lastRespondentName = null;
        $lastRespondentTime = null;

        // Find the last respondent details from the CSV
        if (file_exists($filePath)) {
            if (($handle = fopen($filePath, "r")) !== FALSE) {
                fgetcsv($handle); // Skip header
                while (($data = fgetcsv($handle)) !== FALSE) {
                    if (isset($data[1]) && !empty($data[1])) {
                        $lastRespondentName = $data[1];
                        // timestamp is at index 13 based on line 181: id, nama, nowa, kom_1...10, timestamp
                        $lastRespondentTime = isset($data[13]) ? $data[13] : null;
                    }
                }
                fclose($handle);
            }
        }

        // Actually, let's just reverse it to show latest submissions first, looks more dynamic.
        $names = array_reverse($names);

        return view('welcome', compact('names', 'responseCount', 'lastRespondentName', 'lastRespondentTime'));
    }

    public function tutorial()
    {
        return view('tutorial');
    }

    public function ready()
    {
        return view('ready');
    }

    public function identity()
    {
        return view('identity');
    }

    public function storeIdentity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nowa' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check for duplicate submission in CSV
        $filePath = public_path('responses.csv');
        if (file_exists($filePath)) {
            if (($handle = fopen($filePath, "r")) !== FALSE) {
                $header = fgetcsv($handle); // Skip header
                while (($data = fgetcsv($handle)) !== FALSE) {
                    // CSV structure: id, nama, 'nowa, ...
                    // Check if nama and nowa match
                    // Handle potential leading quote in nowa
                    $csvNama = $data[1] ?? '';
                    $csvNowa = $data[2] ?? '';

                    // Remove leading single quote if present
                    if (str_starts_with($csvNowa, "'")) {
                        $csvNowa = substr($csvNowa, 1);
                    }

                    if (strcasecmp($csvNama, $request->nama) === 0 && $csvNowa == $request->nowa) {
                        fclose($handle);
                        return redirect()->back()
                            ->withErrors(['msg' => 'Kamu sudah mengisi kusioner ini.'])
                            ->withInput();
                    }
                }
                fclose($handle);
            }
        }

        session(['respondent_nama' => $request->nama, 'respondent_nowa' => $request->nowa]);

        return redirect()->route('questionnaire.index');
    }

    public function index()
    {
        if (!session()->has('respondent_nama')) {
            return redirect()->route('identity');
        }

        $items = ColorDataset::whereBetween('id', [5005, 5014])->get();
        return view('questionnaire', compact('items'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kom_*' => 'required',
        ]);

        // Specific validation
        $rules = [];
        for ($i = 1; $i <= 10; $i++) {
            $rules["kom_$i"] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nama = session('respondent_nama');
        $nowa = session('respondent_nowa');

        if (!$nama || !$nowa) {
            return redirect()->route('identity')->withErrors(['msg' => 'Session expired.']);
        }

        // Prepare data for CSV
        $data = [
            uniqid(), // ID
            $nama,
            "'" . $nowa,
        ];

        // Ensure order kom_1 to kom_10
        for ($i = 1; $i <= 10; $i++) {
            $val = $request->input("kom_$i");
            // Map 'cocok' to 1, 'tidak_cocok' to 0 (or anything else as 0 for safety, though validation handles it)
            $data[] = ($val === 'cocok') ? 1 : 0;
        }

        // Add timestamp
        $data[] = now()->toDateTimeString();

        // Convert to CSV line
        $csvLine = implode(',', $data) . "\n";

        // Write to PUBLIC path
        $filePath = public_path('responses.csv');

        // Check for duplicate submission in CSV before writing
        if (file_exists($filePath)) {
            if (($handle = fopen($filePath, "r")) !== FALSE) {
                $header = fgetcsv($handle); // Skip header
                while (($row = fgetcsv($handle)) !== FALSE) {
                    $csvNama = $row[1] ?? '';
                    $csvNowa = $row[2] ?? '';

                    // Remove leading single quote if present
                    if (str_starts_with($csvNowa, "'")) {
                        $csvNowa = substr($csvNowa, 1);
                    }

                    if (strcasecmp($csvNama, $nama) === 0 && $csvNowa == $nowa) {
                        fclose($handle);
                        // Redirect to thank you page without saving, effectively ignoring duplicate
                        return redirect()->route('thankyou')->with('last_submitted_name', $nama);
                    }
                }
                fclose($handle);
            }
        }

        try {
            if (!file_exists($filePath)) {
                $header = ['id', 'nama', 'nowa', 'kom_1', 'kom_2', 'kom_3', 'kom_4', 'kom_5', 'kom_6', 'kom_7', 'kom_8', 'kom_9', 'kom_10', 'timestamp'];
                file_put_contents($filePath, implode(',', $header) . "\n");
            }

            file_put_contents($filePath, $csvLine, FILE_APPEND);

            // Send Email Notification
            // Prepare data array for email (associative)
            $emailData = [
                'nama' => $nama,
                'nowa' => $nowa,
                'timestamp' => $data[13] ?? now()->toDateTimeString(),
            ];
            for ($i = 1; $i <= 10; $i++) {
                $compVal = $request->input("kom_$i");
                $emailData["kom_$i"] = ($compVal === 'cocok') ? 1 : 0;
            }

            Mail::to('hamdanerbic@gmail.com')->send(new NewSubmissionMail($emailData));

        } catch (\Exception $e) {
            // Log error but allow process to continue
            \Illuminate\Support\Facades\Log::error('Submission Error: ' . $e->getMessage());
        }

        return redirect()->route('thankyou')->with('last_submitted_name', $nama);
    }

    public function thankyou()
    {
        // Prioritize the name from the immediate submission, fallback to session
        $nama = session('last_submitted_name') ?? session('respondent_nama');
        return view('thankyou', compact('nama'));
    }
}
