<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentImportController extends Controller
{
    public function import(Request $request)
{
    // Added 'excel' mimes if you decide to use a library,
    // otherwise stick to csv,txt
    $request->validate([
        'file' => 'required|mimes:csv,txt|max:4096',
    ]);

    $file = $request->file('file');
    $schoolId = auth()->user()->id;

    $handle = fopen($file->getRealPath(), 'r');
    fgetcsv($handle); // Skip header row

    $importedCount = 0;
    $errors = [];

    DB::beginTransaction();
    try {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Expected CSV Order:
            // 0:name, 1:email, 2:reg_no, 3:phone, 4:year_of_study, 5:class_year

            $email = $data[1];
            $regNo = $data[2];

            // Validation: Check if email OR registration number exists
            $exists = Students::where('email', $email)
                              ->orWhere('registration_number', $regNo)
                              ->exists();

            if ($exists) {
                $errors[] = "Skip: $email or $regNo already exists.";
                continue;
            }

            Students::create([
                'name'                => $data[0],
                'email'               => $email,
                'registration_number' => $regNo,
                'phone_number'        => $data[3],
                'year_of_study'       => $data[4],
                'class_year'          => $data[5],
                'status'              => 'active', // Default status
                'school_id'           => $schoolId,
                'password'            => Hash::make('welcome123'),
                // 'course_id'        => $data[6], // Add this if you have it in CSV
            ]);

            $importedCount++;
        }

        DB::commit();
        fclose($handle);

        return response()->json([
            'status' => 'success',
            'message' => "Imported $importedCount students.",
            'skipped' => $errors
        ], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        if($handle) fclose($handle);
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
}
}
