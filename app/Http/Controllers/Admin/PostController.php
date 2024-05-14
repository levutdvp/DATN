<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\CategoryPost;
use App\Models\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Tag;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:post-resource', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleted', 'restore', 'permanentlyDelete','changeStatus']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_posts = CategoryPost::all();
        $model = Post::query()->latest()->get();
        return view('admin.post.index', compact('model', 'category_posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryPosts = CategoryPost::query()->where('status', 'active')->latest()->get();;
        return view('admin.post.create', compact('categoryPosts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            $user = auth()->user();
            $model = new Post();

            $model->user_id = $user->id;

            $slug = Str::slug($request->title);
            $model->slug = $slug;
            $model->fill($request->except('image'));

            if ($request->hasFile('image')) {
                $model->image = upload_file(OBJECT_POST, $request->file('image'));
            } else {
                $model->image = asset('no_image.jpg');
            }
            $model->save();

            if ($request->filled('tags')) {
                $tagNames = explode(',', $request->input('tags'));

                foreach ($tagNames as $tagName) {
                    $slug = Str::slug(trim($tagName));

                    $tag = Tag::firstOrCreate(['name' => trim($tagName), 'slug' => $slug]);

                    $model->tags()->syncWithoutDetaching([$tag->id]);
                }
            }
            Toastr::success('Thêm bài viết thành công', 'Thành công');
            return to_route('posts.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoryPosts = CategoryPost::query()->where('status', 'active')->latest()->get();
        $model = Post::query()->findOrFail($id);
        $tags = $model->tags->pluck('name')->implode(',');
        return view('admin.post.edit', compact('model', 'tags', 'categoryPosts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $model = Post::query()->findOrFail($id);
        $slug = Str::slug($request->title);
        $model->slug = $slug;
        try {
            $oldImg = $model->image; // Lưu ảnh cũ

            $model->fill($request->except('image'));

            if ($request->hasFile('image')) {
                $newImg = upload_file(OBJECT_BANNER, $request->file('image')); // Tải lên ảnh mới
                $model->image = $newImg;
            }

            $model->save();

            if ($request->filled('tags')) {
                $tagNames = explode(',', $request->input('tags'));

                $model->tags()->sync([]); // Xóa tất cả các tags hiện tại và cập nhật lại
                foreach ($tagNames as $tagName) {
                    $slug = Str::slug(trim($tagName));
                    $tag = Tag::firstOrCreate(['name' => trim($tagName), 'slug' => $slug]);
                    $tag->status = 'active';
                    $model->tags()->attach($tag->id);
                }
            } else {
                // Nếu trường 'tags' trống, xóa tất cả các tag liên kết với bài viết
                $model->tags()->detach();
            }

            // Kiểm tra nếu có ảnh mới và ảnh cũ tồn tại, thì xóa ảnh cũ
            if ($request->hasFile('image') && $oldImg) {
                delete_file($oldImg);
            }
            Toastr::success('Cập nhật bài viết thành công', 'Thành công');

            return to_route('posts.index')->with('status', Response::HTTP_OK);
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);
            Toastr::error('Thao tác thất bại', 'Thất bại');

            return back()->with('status', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $model = Post::query()->findOrFail($id);
            $model->delete();
            Toastr::success('Bài viết đã chuyển vào thùng rác', 'Thành công');

            return to_route('posts.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Toastr::error('Thao tác thất bại', 'Thất bại');
            return back();
        }
    }

    public function deleted()
    {
        $model = Post::query()->onlyTrashed()->get();
        return view('admin.post.delete', compact('model'));
    }

    public function restore(string $id)
    {
        try {
            $restore = Post::query()->onlyTrashed()->findOrFail($id);
            $restore->restore();
            Toastr::success('Khôi phục bài viết thành công', 'Thành công');
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
            $post = Post::query()->withTrashed()->findOrFail($id);
            $post->tags()->detach();
            $post->forceDelete();
            Toastr::success('Xoá post thành công', 'Thành công');

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
            $post = Post::find($request->post_id);
            $post->status = $request->status;
            $post->save();
            return response()->json(['success' => 'Thay đổi trạng thái thành công']);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['error' => 'Thay đổi trạng thái thất bại']);
        }
    }
}
