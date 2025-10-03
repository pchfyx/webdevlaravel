<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $firebase;
    protected $db;

    public function __construct()
    {
        $this->firebase = (new Factory)
            ->withServiceAccount(base_path('firebase-credentials.json'))
            ->createFirestore();
        $this->db = $this->firebase->database();
    }

    public function getCollection($collection)
    {
        return $this->db->collection($collection)->documents();
    }

    public function getUserWishlist($userId)
    {
        return $this->db->collection('wishlists')
            ->where('userId', '=', $userId)
            ->documents();
    }
}
