<?php

namespace App\Domain\Entities;

final class Profile
{

    /** @var string */
    protected $username;

    /** @var string */
    protected $bio;

    /** @var string */
    protected $image;

    /** @var bool */
    protected $following = false;

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function follow(): void
    {
        $this->following = true;
    }

    public function unfollow(): void
    {
        $this->following = false;
    }

    public function isFollowing(): bool
    {
        return $this->following;
    }

}