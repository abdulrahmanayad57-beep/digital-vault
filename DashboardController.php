<?php
namespace App\Http\Controllers;
use App\Models\Asset;
use App\Models\Deputy;
use App\Models\AssetCategory;
use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', '2fa']);
    }

    public function index()
    {
        $user = Auth::user();
        $stats = [
            'total_assets' => $user->assets()->count(),
            'completed_assets' => $user->assets()->completed()->count(),
            'total_value' => $user->assets()->sum('value_estimate'),
            'deputies_count' => $user->deputies()->accepted()->count(),
            'completion_rate' => $user->completion_rate,
        ];
        return view('dashboard.index', compact('stats'));
    }
}
