<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\DataTables\ProductDataTableService;
use App\Services\Exports\ProductsExportService;
use App\Services\Exports\ProductsTemplateService;
use App\Services\Imports\ProductsImportService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $productDataTableService;
    protected $productsExportService;
    protected $productsTemplateService;
    protected $productsImportService;

    public function __construct(ProductDataTableService $productDataTableService, ProductsExportService $productsExportService, ProductsTemplateService $productsTemplateService, ProductsImportService $productsImportService)
    {
        $this->productDataTableService = $productDataTableService;
        $this->productsExportService = $productsExportService;
        $this->productsTemplateService = $productsTemplateService;
        $this->productsImportService = $productsImportService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|JsonResponse|RedirectResponse
    {
        try {
            return $this->productDataTableService->render('admin.product.index');
        } catch (Exception $e) {
            Log::error('Error when loading data: ' . $e->getMessage());

            return back()->withErrors('Terjadi kesalahan saat memuat data');
        }
    }

    public function export()
    {
        return $this->productsExportService->download('produk_' . now() . '.xlsx');
    }

    public function template()
    {
        return $this->productsTemplateService->download('template_produk.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);
        $this->productsImportService->import($request->file('file'));

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();
        Product::create($validatedData);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**s
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.product.form', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        $product->update($validatedData);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus');
    }
}
