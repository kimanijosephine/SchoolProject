<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentImportController extends Controller
{
    /**
     * Main route handler for /school/upload/{type}
     */
    public function import(Request $request, $type)
    {
        // 1. Validate file
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:4096',
        ]);

        $file = $request->file('file');
        $schoolId = auth()->user()->id;
        $handle = fopen($file->getRealPath(), 'r');

        // Skip header row
        fgetcsv($handle);

        DB::beginTransaction();
        try {
            if ($type === 'students') {
                $result = $this->importStudents($handle, $schoolId);
            } elseif ($type === 'marks') {
                $result = $this->importMarks($handle, $schoolId);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Invalid upload type'], 400);
            }

            DB::commit();
            fclose($handle);
            return $result;

        } catch (\Exception $e) {
            DB::rollBack();
            if ($handle) fclose($handle);
            return response()->json([
                'status' => 'error',
                'message' => 'Line ' . ($importedCount ?? 0 + 2) . ': ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Logic for Student Import
     */
    private function importStudents($handle, $schoolId)
    {
        $importedCount = 0;
        $errors = [];

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Mapping: 0:Name, 1:Email, 2:RegNo, 3:Phone, 4:YearOfStudy, 5:ClassYear
            $email = trim($data[1]);
            $regNo = trim($data[2]);

            // Skip if empty
            if (empty($email) || empty($regNo)) continue;

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
                'phone_number'        => $data[3] ?? null,
                'year_of_study'       => $data[4],
                'class_year'          => $data[5],
                'status'              => 'active',
                'school_id'           => $schoolId,
                'password'            => Hash::make('welcome123'),
            ]);

            $importedCount++;
        }

        return response()->json([
            'status' => 'success',
            'message' => "Successfully imported $importedCount students.",
            'skipped' => $errors
        ], 200);
    }

    /**
     * Logic for Marks Import
     * CSV Expected: RegNo, SubjectCode, Mark
     */
    private function importMarks($handle, $schoolId)
    {
        $updatedCount = 0;
        $notFound = [];

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $regNo = trim($data[0]);
            $subject = trim($data[1]);
            $score = trim($data[2]);

            // Find student belonging to this school
            $student = Students::where('registration_number', $regNo)
                               ->where('school_id', $schoolId)
                               ->first();

            if (!$student) {
                $notFound[] = "RegNo $regNo not found in your school.";
                continue;
            }

            // Replace 'Mark' with your actual Model for grades/marks
            // Example:
            // Mark::updateOrCreate(
            //    ['student_id' => $student->id, 'subject' => $subject],
            //    ['score' => $score]
            // );

            $updatedCount++;
        }

        return response()->json([
            'status' => 'success',
            'message' => "Processed $updatedCount marks.",
            'skipped' => $notFound
        ], 200);
    }
}
