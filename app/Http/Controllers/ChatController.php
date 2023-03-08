<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function MongoDB\BSON\toJSON;

class ChatController extends Controller
{

    public function index(): Response
    {

    }


    public function create(): Response
    {
        //
    }


    public function store(Request $request): RedirectResponse
    {

    }
    public function createMessage(Request $request): Response
    {
      $latestMessage =  Chat::create([
        "message" => $request->message,
        "send_user_id" => $request->send_user_id,
        "received_user_id" => $request->received_user_id
      ]);

      event(new NewMessage(\response()->json($latestMessage)));
      return response($latestMessage, 200);
    }


    public function show(): Response
    {
    }
    public function getDataUser(Request $request): Response
    {
      $myMessage = Chat::where("received_user_id", $request->id)->where("send_user_id", auth()->user()->id)->get();
      $youMessage = Chat::where("received_user_id", auth()->user()->id)->where("send_user_id", $request->id)->get();
      $collection = collect(array_merge([...$myMessage, ...$youMessage]));
      $chats = $collection->sortBy("id");
      $user = User::where("id", $request->id)->first();
      return response(view('data_chat', compact("chats", "user")));
    }


    public function edit(Chat $chat): Response
    {
        //
    }


    public function update(Request $request, Chat $chat): RedirectResponse
    {
        //
    }


    public function destroy(Chat $chat): RedirectResponse
    {
        //
    }
}
