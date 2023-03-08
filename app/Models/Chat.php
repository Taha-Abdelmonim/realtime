<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
  protected $fillable = [
    'message',
    'send_user_id',
    'received_user_id',
  ];
  public function user()
  {
    return $this->belongsTo(User::class, "received_user_id");
  }
  public function getUser()
  {
    $user = User::where("id", $this->received_user_id)->groupBy("id")->first();
    return $user;
  }
}
