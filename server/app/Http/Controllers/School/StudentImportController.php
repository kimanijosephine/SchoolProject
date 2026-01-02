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
        // 1. Validate that a file was actually uploaded
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $schoolId = auth()->user()->id; //  School is logged in via JWT

        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle, 1000, ","); // Read the first row (headers)

        $importedCount = 0;
        $errors = [];

        // 2. Wrap in a transaction for safety
        DB::beginTransaction();

        try {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Map CSV columns: 0=name, 1=email, 2=year_of_study, 3=class_year
                $email = $data[1];

                // Check for duplicates before importing
                if (Students::where('email', $email)->exists()) {
                    $errors[] = "Skip: $email already exists.";
                    continue;
                }

                Students::create([
                    'name'          => $data[0],
                    'email'         => $email,
                    'year_of_study' => $data[2],
                    'class_year'    => $data[3],
                    'school_id'     => $schoolId,
                    'password'      => Hash::make('welcome123'), // Default password
                ]);

                $importedCount++;
            }

            DB::commit();
            fclose($handle);

            return response()->json([
                'status' => 'success',
                'message' => "Successfully imported $importedCount students.",
                'skipped' => $errors
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            fclose($handle);
            return response()->json([
                'status' => 'error',
                'message' => 'Import failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
