<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use App\Http\Resources\ClassesResource;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\Cache;

class StudentController extends Controller
{
    // Membuat fungsi index untuk menampilkan data student dengan menggunakan cache
    public function index(Request $request)
    {
        // Menggunakan cache untuk data mahasiswa
        $students = Cache::remember('students.index.' . md5($request->search . '.' . $request->page), now()->addMinutes(2), function () use ($request) {
    
            $studentsQuery = Student::query();
            $this->applySearch($studentsQuery, $request->search);
            return $studentsQuery->paginate(10);
        });

        $studentsResource = StudentResource::collection($students);

        // Mengembalikan view dengan data mahasiswa dan pagination
        return inertia('Students/Index', [
            'students' => $studentsResource,
            'search' => $request->search ?? '',
            'pagination' => [
                'current_page' => $students->currentPage(),
                'per_page' => $students->perPage(),
                'last_page' => $students->lastPage(),
                'total' => $students->total(),
            ]
        ]);
    }

    // Fungsi untuk menambahkan pencarian berdasarkan nama atau email
    protected function applySearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        });
    }

    // Fungsi create untuk menampilkan form create student
    public function create()
    {
        // Cache untuk kelas
        $classes = Cache::remember('classes.all', now()->addMinutes(2), function () {
            return ClassesResource::collection(Classes::all());
        });

        return inertia('Students/Create', [
            'classes' => $classes,
        ]);
    }

    // Fungsi store untuk menyimpan data student
    public function store(StoreStudentRequest $request)
    {
        Student::create($request->validated());

        // Menghapus cache terkait mahasiswa agar data yang baru ditambahkan muncul di index
        Cache::forget('students.index.' . md5($request->search . '.' . request('page')));

        return redirect()->route('students.index');
    }

    // Fungsi edit untuk menampilkan form edit student
    public function edit(Student $student)
    {
        // Cache untuk kelas agar data kelas tidak perlu diambil ulang
        $classes = Cache::remember('classes.all', now()->addMinutes(2), function () {
            return ClassesResource::collection(Classes::all());
        });

        return inertia('Students/Edit', [
            'classes' => $classes,
            'student' => StudentResource::make($student),
        ]);
    }

    // Fungsi update untuk memperbarui data student
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        // Menghapus cache yang relevan setelah update
        Cache::forget('students.index.' . md5($request->search . '.' . request('page')));
        return redirect()->route('students.index');
    }

    // Fungsi destroy untuk menghapus data student
    public function destroy(Student $student)
    {

        $student->delete();

        // Menghapus cache yang relevan setelah penghapusan
        Cache::forget('students.index.' . md5(request('search') . '.' . request('page')));
        return redirect()->route('students.index');
    }
}