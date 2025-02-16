<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadRequest;
use App\Models\Lead;
use App\Services\DataTables\LeadDataTableService;
use App\Services\Exports\LeadsExportService;
use App\Services\Exports\LeadsTemplateService;
use App\Services\Imports\LeadsImportService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class LeadController extends Controller
{
    protected $leadDataTableService;
    protected $leadsExportService;
    protected $leadsTemplateService;
    protected $leadsImportService;

    public function __construct(LeadDataTableService $leadDataTableService, LeadsExportService $leadsExportService, LeadsTemplateService $leadsTemplateService, LeadsImportService $leadsImportService)
    {
        $this->leadDataTableService = $leadDataTableService;
        $this->leadsExportService = $leadsExportService;
        $this->leadsTemplateService = $leadsTemplateService;
        $this->leadsImportService = $leadsImportService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|JsonResponse|RedirectResponse
    {
        try {
            return $this->leadDataTableService->render('admin.lead.index');
        } catch (Exception $e) {
            Log::error('Error when loading data: ' . $e->getMessage());

            return back()->withErrors('Terjadi kesalahan saat memuat data');
        }
    }

    public function export()
    {
        return $this->leadsExportService->download('calon_pelanggan_' . now() . '.xlsx');
    }

    public function template()
    {
        return $this->leadsTemplateService->download('template_calon_pelanggan.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);
        $this->leadsImportService->import($request->file('file'));

        return redirect()->route('admin.lead.index')->with('success', 'Calon Pelanggan berhasil ditambahkan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lead.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeadRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = Lead::STATUS_NEW;
        $validatedData['assigned_to'] = Auth::id();
        Lead::create($validatedData);

        return redirect()->route('admin.lead.index')->with('success', 'Calon Pelanggan berhasil ditambahkan');
    }

    /**s
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        return view('admin.lead.form', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeadRequest $request, Lead $lead)
    {
        $validatedData = $request->validated();
        $lead->update($validatedData);

        return redirect()->route('admin.lead.index')->with('success', 'Calon Pelanggan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('admin.lead.index')->with('success', 'Calon Pelanggan berhasil dihapus');
    }
}
