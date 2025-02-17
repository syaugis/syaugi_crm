<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\Product;
use App\Models\Project;
use App\Models\User;
use App\Services\DataTables\ProjectDataTableService;
use App\Services\Exports\ProjectsExportService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProjectController extends Controller
{
    protected $projectDataTableService;
    protected $projectsExportService;

    public function __construct(ProjectDataTableService $projectDataTableService, ProjectsExportService $projectsExportService)
    {
        $this->projectDataTableService = $projectDataTableService;
        $this->projectsExportService = $projectsExportService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|JsonResponse|RedirectResponse
    {
        try {
            return $this->projectDataTableService->render('admin.project.index');
        } catch (Exception $e) {
            Log::error('Error when loading data: ' . $e->getMessage());

            return back()->withErrors('Terjadi kesalahan saat memuat data');
        }
    }

    public function export()
    {
        return $this->projectsExportService->download('proyek_' . now() . '.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leads = Lead::pluck('name', 'id');
        $products = Product::pluck('name', 'id');

        return view('admin.project.form', compact('leads', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = Project::STATUS_PENDING;
        Project::create($validatedData);

        return redirect()->route('admin.project.index')->with('success', 'Proyek berhasil ditambahkan');
    }

    /**s
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $leads = Lead::pluck('name', 'id');
        $products = Product::pluck('name', 'id');
        $statuses = Project::STATUSES;

        return view('admin.project.form', compact('project', 'leads', 'products', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $validatedData = $request->validated();
        $user = User::find(Auth::id());

        if ($validatedData['status'] < $project->status) {
            return back()->withErrors('Status tidak dapat diubah ke status sebelumnya');
        }

        if (!$user->hasRole('manager') && $validatedData['status'] == Project::STATUS_APPROVED) {
            return back()->withErrors('Anda tidak memiliki izin untuk menyetujui proyek');
        }

        if ($validatedData['status'] == Project::STATUS_APPROVED) {
            $validatedData['approved_by'] = $user->id;

            Customer::create([
                'name' => $project->lead->name,
                'email' => $project->lead->email,
                'phone_number' => $project->lead->phone_number
            ]);
        }

        $project->update($validatedData);

        return redirect()->route('admin.project.index')->with('success', 'Proyek berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.project.index')->with('success', 'Proyek berhasil dihapus');
    }
}
