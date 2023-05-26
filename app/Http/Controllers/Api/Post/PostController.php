<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $data = Post::query();
        $data = $data->with(['post_tags.tags', 'createdBy']);
        if ($request->limit) {
            $data = $data->limit($request->limit);
        }
        $data = $data->get();

        $results = [];
        foreach ($data as $key => $item) {
            $resultTags = [];
            foreach ($item->post_tags as $t => $tag) {
                $resultTags[] = [
                    'tag' => $tag->tags->name
                ];
            }
            $likes = Like::query();
            $likes = $likes->where([
                'post_id' => $item->id,
                'status' => Like::LIKE
            ]);
            $likes = $likes->select('id', 'user_id', 'status');
            $likes = $likes->get();

            $results[] = [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'image' => $item->image,
                'caption' => $item->caption,
                'tags' => $resultTags,
                'likes' => count($likes),
                'user_likes' => $likes,
                'users' => [
                    'id' => $item->createdBy->id,
                    'name' => $item->createdBy->name
                ]
            ];
        }

        return response()->json([
            'code' => 200,
            'data' => $results,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg,webp',
            ]);

            $post = new Post();
            DB::transaction(function () use ($post, $request) {
                $this->commonStores($post, $request);
                $post->save();
                if ($request->tags) {
                    $this->commonStoresTags($post, $request);
                }
            });

            return response()->json([
                'code' => 200,
                'message' => 'Success!'
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'code' => 500,
                'message' => 'Ups, something went wrong '
            ]);
        }
    }

    public function show($id)
    {
        $data = Post::with(['post_tags.tags', 'createdBy'])->select('id', 'title', 'slug', 'image', 'caption', 'created_by_id')->find($id);
        $results = null;
        $resultTags = [];
        foreach ($data->post_tags as $t => $tag) {
            $resultTags[] = [
                'tag' => $tag->tags->name
            ];
        }

        $likes = Like::query();
        $likes = $likes->where([
            'post_id' => $id,
            'status' => Like::LIKE
        ]);
        $likes = $likes->select('id', 'user_id', 'status');
        $likes = $likes->get();

        $results = [
            'id' => $data->id,
            'title' => $data->title,
            'slug' => $data->slug,
            'image' => $data->image,
            'caption' => $data->caption,
            'tags' => $resultTags,
            'likes' => count($likes),
            'user_likes' => $likes,
            'users' => [
                'name' => $data->createdBy->name
            ]
        ];
        return response()->json([
            'code' => 200,
            'data' => $results
        ], 200);
    }

    public function update($id, Request $request)
    {
        try {
            $this->validate($request, [
                'image' => 'mimes:png,jpg,jpeg,webp',
            ]);

            $post = Post::find($id);
            if (!$post) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Post not found'
                ], 404);
            }

            DB::transaction(function () use ($post, $request) {
                $this->commonStores($post, $request);
                $post->save();
                $this->commonStoresTags($post, $request);
            });

            return response()->json([
                'code' => 200,
                'message' => 'Post was successfully update'
            ], 200);
        } catch (Exception $err) {
            return response()->json([
                'code' => 500,
                'message' => 'Ups, some thing went wrong:  ' . $err,
            ], 500);
        }
    }

    public function delete($id)
    {
        $data = Post::find($id);
        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Not found'
            ], 404);
        }

        $postTags = $data->post_tags;
        $likes = Like::where('post_id', $id)->get();
        DB::transaction(function () use ($postTags, $data, $likes) {
            if (count($postTags) > 0) {
                foreach ($postTags as $tag) {
                    $tag->delete();
                }
            }

            if (count($likes) > 0) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }
            $data->delete();
        });

        return response()->json([
            'code' => 200,
            'message' => 'Success'
        ], 200);
    }

    public function storeLike($id, Request $request)
    {
        try {
            DB::transaction(function () use ($id, $request) {
                $post = Post::find($id);
                $this->commonStoreLike($post, $request);
            });

            return response()->json([
                'code' => 200,
                'message' => 'Success'
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'code' => 500,
                'message' => 'Ups, something went wrong'
            ], 500);
        }
    }

    public function commonStores($post, Request $request)
    {
        $image = $request->file('image');
        if ($image != null) {
            $image->storeAs('public/posts', $image->hashName());
            $post->image  = $image->hashName();
        }
        $post->title = $request->title ?? $post->title;
        $post->slug = Str::slug($request->title ?? $post->title);
        $post->caption = $request->caption;
        $post->created_by_id = $request->user['id'];
    }

    public function commonStoresTags($post, Request $request)
    {
        $tags = explode(',', $request->tags);
        $tagId = [];
        foreach ($tags as $tag) {
            $findTag = Tag::where('name', $tag)->first();
            if ($findTag == null) {
                if ($tag != "") {
                    $createTag = new Tag();
                    $createTag->name = $tag;
                    $createTag->save();
                    $postTag = new PostTag();
                    $postTag->post_id = $post->id;
                    $postTag->tag_id = $createTag->id;
                    $postTag->save();
                    $tagId[] = $createTag->id;
                }
            } else {
                $tagId[] = $findTag->id;
                $checkPostTag = PostTag::where('tag_id', $findTag->id)->first();
                if ($checkPostTag == null) {
                    $postTag = new PostTag();
                    $postTag->post_id = $post->id;
                    $postTag->tag_id = $findTag->id;
                    $postTag->save();
                }
            }
        }

        $oldTags = $post->post_tags;
        if (count($oldTags) > 0) {
            foreach ($oldTags as $oldId) {
                $postTag = PostTag::find($oldId->id);
                if (!in_array($oldId->tag_id, $tagId)) {
                    $postTag->delete();
                }
            }
        }
        return $tagId;
    }

    public function commonStoreLike($post, Request $request)
    {
        $userId = $request->user['id'];
        $postId = $post->id;
        $like = Like::where([
            'user_id' => $userId,
            'post_id' => $postId
        ])->first();

        if ($like) {
            if (\Request::route()->getName() == 'photos.like') {
                $like->status = Like::LIKE;
            } else if (\Request::route()->getName() == 'photos.unlike') {
                $like->status = Like::UNLIKE;
            }
            $like->save();
        } else {
            $newLike = new Like();
            $newLike->user_id = $userId;
            $newLike->post_id = $postId;
            $newLike->status = Like::LIKE;
            $newLike->save();
        }
    }
}
