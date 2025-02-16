<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Product;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $assets = ['chart', 'animation'];
        $user = User::find(Auth::id());
        $data['total_products']  = Product::count();
        $data['total_project']   = Project::count();
        $data['total_customers'] = Customer::count();
        $data['total_new_lead']  = Lead::where('status', 0)->count();
        $data['total_revenues']  = Project::where('status', 1)
            ->with('product')
            ->when($user->hasRole('sales'), function ($query) {
                return $query->whereHas('lead', function ($query) {
                    $query->where('assigned_to', Auth::id());
                });
            })
            ->get()
            ->sum(function ($project) {
                return $project->product->sum('price');
            });

        if ($user->hasRole('sales')) {
            $data['total_sales_lead'] = Lead::where('status', 0)
                ->where('assigned_to', Auth::id())
                ->count();
        }


        return view('admin.dashboard', compact('assets', 'data'));
    }
}
