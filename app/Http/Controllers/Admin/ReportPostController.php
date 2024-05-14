<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ReportPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:report-resource', ['only' => ['index']]);
    }

   public function index(){
      $post = Post::query()->count();
      $post_today = Post::query()->whereDate('created_at', today())->count();
      $total_post= Post::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total_posts'))->groupBy('date')->orderBy('date')->get();
      $total_views = Post::sum('view');
   
      return view('admin.report.post.index', compact('post', 'post_today', 'total_post', 'total_views'));
   }
   public function fillterPost(Request $request){
      $date_start = $request->input('date_start');
      if ($date_start === null) {
          $date_start = 0;
      }
      $date_end = $request->input('date_end');
      if ($date_end === null) {
          $date_end = Carbon::now();
      }
      $query = Post::query();
      if ($date_end != null) {
          $query->where('created_at', '<=', $date_end);
      }
      if ($date_start == null && $date_end == null) {
          $query->where('created_at', '<=', Carbon::now());
      }
      if ($date_start != null) {
          $query->where('created_at', '>=', $date_start);
      }
      $post = $query->count(); 
      $post_today = Post::query()->whereDate('created_at', today())->count(); //
      $total_post= Post::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total_posts'))->groupBy('date')->orderBy('date')->get();
      
      // dd($revenue_service,$bill,$bill_false);
      $total_views = $query->sum('view');
      // dd($total_views);
      return view('admin.report.post.index', compact('post', 'post_today', 'total_post', 'total_views','date_start','date_end'));
   }
}
