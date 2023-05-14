<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function searchUsers(Request $request)
    {
        // Define pagination parameters
        $perPage    = $request->input('per_page', 10);
        $page       = $request->input('page', 1);

        // Fetch data from the database
        $searchQuery = $request->input('q');
        $query = DB::table('users')
            ->where('email', 'LIKE', '%' . $searchQuery . '%')
            ->orWhere('first_name', 'LIKE', '%' . $searchQuery . '%')
            ->orWhere('last_name', 'LIKE', '%' . $searchQuery . '%')
            ->select('uuid', 'first_name', 'last_name');
        $items = $query->paginate($perPage, ['*'], 'page', $page);

        // Create response data
        $data = [
            'items' => UserResource::collection($items),
            'metadata' => [
                'current_url' => url()->current(),
                'next_url' => $items->nextPageUrl(),
                'total_pages' => $items->lastPage()
            ]
        ];
        return response()->json($data);
    }
}
