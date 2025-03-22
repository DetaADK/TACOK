<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('student.classes')->latest()->get();
        return view('attendance.index', compact('attendances'));
    }

    public function create(Request $request)
    {
        $kelasList = classes::all();
        $students = [];

        if ($request->has('kelas') && $request->kelas != '') {
            $students = Student::where('id_kelas', $request->kelas)->get();
        }

        return view('attendance.create', [
            'kelasList' => $kelasList,
            'students' => $students,
        ]);
    }

    public function getStudentsByClass($id_kelas)
    {
        $students = Student::where('id_kelas', $id_kelas)->get();
        return response()->json($students);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'attendance.*.date' => 'required|date',
            'attendance.*.keterangan' => 'required|in:present,absent',
            'attendance.*.foto_izin' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        foreach ($request->attendance as $studentId => $attendanceData) {
            $fotoIzinPath = 'noimage.png'; // Default jika tidak ada gambar

            // Jika ada file yang diupload, ganti "noimage.png" dengan file baru
            if ($request->hasFile("attendance.$studentId.foto_izin")) {
                $fotoIzinPath = $attendanceData['foto_izin']->storeAs(
                    'attendance_photos',
                    time() . '_' . $attendanceData['foto_izin']->getClientOriginalName(),
                    'public'
                );
            }

            // Simpan atau update absensi siswa
            Attendance::updateOrCreate(
                [
                    'id_siswa' => $studentId,
                    'date' => $attendanceData['date'],
                ],
                [
                    'keterangan' => $attendanceData['keterangan'],
                    'foto_izin' => $fotoIzinPath, // Akan tetap "noimage.png" jika tidak ada file
                ]
            );
        }

        return redirect()->route('attendance.index')->with('success', 'Absensi berhasil disimpan!');
    }
}
