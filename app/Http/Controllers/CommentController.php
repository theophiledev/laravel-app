<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a new comment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Your comment has been submitted and is pending approval.');
    }

    /**
     * Display comments for the home page (approved only).
     */
    public function index()
    {
        $comments = Comment::with('user')
            ->approved()
            ->latest()
            ->take(10)
            ->get();

        return view('comments.index', compact('comments'));
    }

    /**
     * Display user's own comments.
     */
    public function myComments()
    {
        $comments = Auth::user()->comments()->latest()->get();
        
        return view('comments.my-comments', compact('comments'));
    }

    /**
     * Display all comments for management (managers only).
     */
    public function manage()
    {
        $comments = Comment::with('user')
            ->latest()
            ->paginate(20);
        
        return view('comments.manage', compact('comments'));
    }

    /**
     * Approve a comment.
     */
    public function approve(Comment $comment)
    {
        $comment->update(['status' => 'approved']);
        
        return redirect()->back()->with('success', 'Comment approved successfully.');
    }

    /**
     * Reject a comment.
     */
    public function reject(Comment $comment)
    {
        $comment->update(['status' => 'rejected']);
        
        return redirect()->back()->with('success', 'Comment rejected successfully.');
    }

    /**
     * Add admin response to a comment.
     */
    public function respond(Request $request, Comment $comment)
    {
        $request->validate([
            'admin_response' => 'required|string|max:500',
        ]);

        $comment->update([
            'admin_response' => $request->admin_response,
            'status' => 'approved'
        ]);
        
        return redirect()->back()->with('success', 'Response added and comment approved.');
    }
}
