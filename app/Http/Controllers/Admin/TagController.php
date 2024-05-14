<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Post;



class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tag-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete','changeStatus']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Tag::query()->latest()->get();
        return view('admin.tag.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        try {
            $data = new Tag();
            $slug = Str::slug($request->name);
            $data->slug = $slug;
            $data->fill($request->all());
            $data->save();
            Toastr::success('Thêm thẻ', 'Thành công');
            return to_route('tags.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Tag::query()->findOrFail($id);
        return view('admin.tag.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, string $id)
    {
        try {
            $data = Tag::query()->findOrFail($id);
            $slug = Str::slug($request->name);
            $data->slug = $slug;
            $data->fill($request->all());
            $data->save();
            Toastr::success('Cập nhật thẻ thành công', 'Thành công');
            return to_route('tags.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Tag::query()->findOrFail($id);
            $data->delete();
            Toastr::success('Thẻ đã chuyển vào thùng rác', 'Thành công');

            return to_route('tags.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function deleted()
    {
        $data = Tag::query()->onlyTrashed()->get();
        return view('admin.tag.delete', compact('data'));
    }

    public function restore(string $id)
    {
        try {
            $restore = Tag::query()->onlyTrashed()->findOrFail($id);
            $restore->restore();
            Toastr::success('Khôi phục thẻ thành công', 'Thành công');
            return redirect()->back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function permanentlyDelete(String $id)
    {
        try {
            $tag = Tag::query()->withTrashed()->findOrFail($id);
            foreach ($tag->posts as $post) {
                $post->tags()->detach($tag->id);
            }

            $tag->forceDelete();
            Toastr::success('Xoá thẻ thành công', 'Thành công');

            return back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }
    public function changeStatus(Request $request)
    {
        try {
            $tag = Tag::find($request->tag_id);
            $tag->status = $request->status;
            $tag->save();
            return response()->json(['success' => 'Thay đổi trạng thái thành công']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => 'Thay đổi trạng thái thất bại']);
        }
    }

    public function searchTagPost($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        if ($tag) {
            $posts = Post::whereHas('tags', function ($query) use ($tag) {
                $query->where('tags.id', $tag->id);
            })->get();

            $totalPosts = $posts->count();
            return view('client.post.search', compact('posts', 'totalPosts'));
        }
    }
}
