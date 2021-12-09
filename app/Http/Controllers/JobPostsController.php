<?php

namespace App\Http\Controllers;

use App\Models\jobPost;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;

class JobPostsController extends Controller
{
    public function index()
    {
        //$paginatedUsers = users::paginate(2);
        return jobPost::all();
    }


    public function store()
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'howLongItLasts' => 'required',
            'creatorId' => 'required',
        ]);
        return jobPost::create(
            [
                'title' => request('title'),
                'description' => request('description'),
                'type' => request('type'),
                'howLongItLasts' => request('howLongItLasts'),
                'creatorId' => request('creatorId')
                ]
        );
    }

    public function update(jobPost $user)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'howLongItLasts' => 'required',
            'creatorId' => request('creatorId')
        ]);

        $success = $user->update([
            'title' => request('title'),
            'description' => request('description'),
            'type' => request('type'),
            'howLongItLasts' => request('howLongItLasts'),
            'creatorId' => request('creatorId')
        ]);

        return [
            'success' => $success
        ];
    }

    public function destroy(jobPost $user)
    {
        $success = $user->delete();

        return [
            'success' => $success,
        ];
    }
    public function getWithID(jobPost $user){
        // return messages::where('id', $message)->firstOrFail();
        return jobPost::query('id', $user)->firstOrFail();
        
    }
}
