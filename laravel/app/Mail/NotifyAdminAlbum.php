<?php

namespace LaraCourse\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use LaraCourse\Album;

class NotifyAdminAlbum extends Mailable
{
    use Queueable, SerializesModels;
    public $album;
    public $album_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Album $album)
    {
        $this->album = $album;
        $this->album_name = $album->album_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.notifyadminnewalbum');
    }
}
