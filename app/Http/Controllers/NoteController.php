<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{

public function createNote(Request $request){
$noteContent = $request->validate(['title'=>'required', 'content'=>'required', 'image'=>'required|image|max:2048']);  //these must match with the name in the field not columns name

$noteContent['title'] = $request->input('title');  ////means Take the current value in $incomingfields['title'] (not savee)       IT SAME AS YOU WRITE // $noteContent['title'] = strip_tags($noteContent['title]); This is to avoid some melicious scripts like someone wriing <script>alert('hi')</script>, it would be cleaned to just alert('hi') (without the tags)

$noteContent['content'] = $request->input('content');// here $noteContent['content']; content is name of column,  BUT input('content') is The name of field name in the form.     // $noteContent['title'] = strip_tags($noteContent['content]); BETTTER COZ remove some melicious HTML codes

$noteContent['image']= $request->file('image')->store('images', 'public');

$noteContent['user_id'] = auth()->id(); //This assigns the current authenticated user's ID (auth()->id()) to the user_id field. (It assigns the current user's ID to the user_id field.)        //means take the current id of this authenticated/login user

Note::create($noteContent); //NOW WE SAVE TO DATABASE
return redirect('/home');

}

public function showEditScreen(Note $note){
    if (auth()->user()->id !== $note->user_id) {
        return redirect('/');
    }
    return view('edit', ['note' => $note]);
}


public function updateNote(Note $note, Request $request){
    if (auth()->user()->id !== $note->user_id) {
        return redirect('/');
    }          

    $incomingFields = $request->validate([
        'title' => 'required',
        'content' => 'required',
        'image' => 'nullable|image|max:2048'  // optional image upload with max size 2MB
    ]);

    $dataToUpdate = [
        'title' => $incomingFields['title'],
        'content' => $incomingFields['content']
    ];
if ($request->hasFile('image')) {
        Storage::disk('public')->delete($note->image);    // this is option If you want to delete the old image file when a new one is uploaded (to avoid unused files accumulating), you can add:

        // Store the new image
        $dataToUpdate['image'] = $request->file('image')->store('images', 'public');
    }

    $note->update($dataToUpdate);

    return redirect('/home');
}


public function deletenote(Note $note){
    if (auth()->user()->id === $note->user_id) {
        $note->delete();
    }

    return redirect('/home');
}

}

