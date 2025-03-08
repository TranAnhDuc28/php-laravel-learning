<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Show all application users.
     */
    public function index(): View
    {
//        $posts = DB::table('users')->paginate();
//        $posts = DB::table('users')->paginate(2, ['*'], 'pageUser');
        $posts = DB::table('posts')->paginate(2)->withQueryString();

        return view('post.index', compact('posts'));
    }


    /**
     * Show the form to create a new blog post.
     */
    public function create(Request $request): View
    {
//        $query = DB::table((new Post())->getTable())
//            ->where('title', 'like', '%a%')
//            ->where('body', 'like', '%a%')
//            ->orWhere('body', 'like', '%1%');

        /*
         * subquery
         */
//        $activeUsers = DB::table('users')->select('id')->where('is_active', 1);
//        $query = DB::table('posts')->whereIn('user_id', $activeUsers);

        /*
         * The when method only executes the given closure when the first argument is true.
         * If the first argument is false, the closure will not be executed.
         */
        $keyword = $request->get('keyword', 'ok');
        $query = DB::table('users')
            ->when($keyword, function (Builder $query, string $keyword) {
                $query->where('email', $keyword);
            });

        $query->get();

        Log::info('View Create Post');
        return view('post.create');
    }

    /**
     * Store a new blog post.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        Log::info('Start Store Post');
        // Validate and store the blog post...
//        $validatedData = $request->validate(
//            [
//                // rules
////                'title' => 'required|unique:posts|max:255',
////                'body' => 'required',
//                'title' => ['required', Rule::unique(Post::class), 'max:255'],
//                'body' => ['required'],
//            ],
//            [
//                // message
//                'required' => ':attribute is required (test).',
//            ],
//            [
//                // attribute
//                'title' => 'Title (test)',
//            ]
//        );

//        $validator = Validator::make($request->all(), [
//            'title' => ['required', Rule::unique(Post::class), 'max:255'],
//            'body' => ['required'],
//        ]);
//
//        if ($validator->fails()) {
//            return redirect()->route('post.create')
//                ->withErrors($validator)
//                ->withInput();
//        }
//
//        // Retrieve the validated input...
//        $validatedData = $validator->validated();

//        $post = Post::query()->create($validatedData);
        $post = Post::query()->create($request->all());
        Log::info('Store Post', $post->toArray());

        return to_route('post.show', ['id' => $post->id]);
    }

    public function show($id)
    {
        return Post::query()->find($id);
    }

    /**
     * Update a blog post.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validate and store the blog post...
        $validator = Validator::make($request->all(), [
            'title' => ['required', Rule::unique(Post::class)->ignore($id), 'max:255'],
            'body' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('post.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Retrieve the validated input...
        $validatedData = $validator->validated();

//        try {
//            $post = null;
//            DB::transaction(function () use ($validatedData, &$post) {
//                $post = Post::query()->create($validatedData);
//            });
//        } catch (\Throwable $e) {
//
//        }

        try {
            DB::beginTransaction();
            $post = Post::query()->create($validatedData);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
        }

        return to_route('post.show', ['id' => $post->id]);
    }
}
