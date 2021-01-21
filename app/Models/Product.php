<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected $fillable = ['title', 'body'];

    public function getBodyHtmlAttribute()
    {
        return clean($this->bodyhtml());
    }

    public function getExcerptAttribute()
    {
        return $this->excerpt(200);
    }

    public function excerpt($length)
    {
        return Str::limit(strip_tags($this->bodyhtml()), $length);
    }

    public function getImageUrlAttribute()
    {
        return url('files/' . $this->image);
    }

    public function getVideoUrlAttribute()
    {
        if (!$this->video) return null;

        $strTok = explode('/', $this->video);
        return '//www.youtube.com/embed/' . $strTok[3];
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    private function bodyhtml()
    {
        $markdown = new \League\CommonMark\CommonMarkConverter(['allow_unsafe_links' => false]);

        return $markdown->convertToHtml($this->body);
    }
}