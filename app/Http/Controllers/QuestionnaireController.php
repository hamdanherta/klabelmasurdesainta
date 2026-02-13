<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ColorDataset;
use Illuminate\Support\Facades\Validator;

class QuestionnaireController extends Controller
{
    public function welcome()
    {
        return view('welcome');
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

        try {
            if (!file_exists($filePath)) {
                $header = ['id', 'nama', 'nowa', 'kom_1', 'kom_2', 'kom_3', 'kom_4', 'kom_5', 'kom_6', 'kom_7', 'kom_8', 'kom_9', 'kom_10', 'timestamp'];
                file_put_contents($filePath, implode(',', $header) . "\n");
            }

            file_put_contents($filePath, $csvLine, FILE_APPEND);
        }
        catch (\Exception $e) {
        // Silently fail or log if possible
        }

        return redirect()->route('thankyou');
    }

    public function thankyou()
    {
        return view('thankyou');
    }
}
