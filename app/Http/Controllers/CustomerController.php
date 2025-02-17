<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\DataTables\CustomerDataTableService;
use App\Services\DataTables\CustomerProductDataTableService;
use App\Services\Exports\CustomersExportService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CustomerController extends Controller
{
    protected $customerDataTableService;
    protected $customerProductDataTableService;
    protected $customersExportService;

    public function __construct(CustomerDataTableService $customerDataTableService, CustomerProductDataTableService $customerProductDataTableService, CustomersExportService $customersExportService)
    {
        $this->customerDataTableService = $customerDataTableService;
        $this->customerProductDataTableService = $customerProductDataTableService;
        $this->customersExportService = $customersExportService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|JsonResponse|RedirectResponse
    {
        try {
            return $this->customerDataTableService->render('admin.customer.index');
        } catch (Exception $e) {
            Log::error('Error when loading data: ' . $e->getMessage());

            return back()->withErrors('Terjadi kesalahan saat memuat data');
        }
    }

    public function export()
    {
        return $this->customersExportService->download('pelanggan_' . now() . '.xlsx');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return $this->customerProductDataTableService->withCustomerId($customer->id)->render('admin.customer.form', compact('customer'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('admin.customer.index')->with('success', 'Pelanggan berhasil dihapus');
    }
}
